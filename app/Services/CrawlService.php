<?php

namespace App\Services;

use DOMDocument;
use DOMXPath;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\TransferStats;
use http\Exception\RuntimeException;
use Illuminate\Support\Collection;

/**
 * The service that performs a crawl for a given url
 */
class CrawlService
{
    private string $url;

    private ?float $page_load_time;

    private DOMXPath $xpath;

    private bool|DOMDocument $doc;

    /**
     * Initiate processing of the URL.
     *
     * @throws GuzzleException
     * @throws RuntimeException
     */
    public function process(string $url): Collection
    {
        $this->url = $url;

        $http_client = new Client();
        $response    = $http_client->get($url, [
            'on_stats' => function (TransferStats $stats) {
                $this->page_load_time = $stats->getTransferTime();
            }
        ]);
        $body        = $response->getBody()->getContents();
        $status_code = $response->getStatusCode();

        if ($status_code > 399) {
            throw new RuntimeException("Retrieval failed. Status code $status_code exceeds acceptable range.");
        }

        $this->doc   = $this->parseHtml($body);
        $this->xpath = $this->createXPath();

        return collect([
            'unique_images'  => $this->extractImagesCount(),
            'unique_links'   => $this->extractLinks(),
            'page_load_time' => $this->page_load_time,
            'word_count'     => $this->parseWordCount(),
            'title_length'   => $this->parseTitleLength(),
            'status_code'    => $status_code,
        ]);
    }

    /**
     * Parse string into HTML.
     *
     * @param string $body
     * @return DOMDocument|bool
     */
    private function parseHtml(string $body): DOMDocument|bool
    {
        libxml_use_internal_errors(true);
        $doc = new DOMDocument();
        $doc->loadHTML($body);

        return $doc;
    }

    /**
     * Return a xpath object.
     *
     * @return DOMXPath
     */
    private function createXPath(): DOMXPath
    {
        return new DOMXPath($this->doc);
    }

    /**
     * Return count of all images found in the DOM.
     *
     * @return int
     */
    private function extractImagesCount(): int
    {
        return $this->xpath->evaluate('//img')->count();
    }

    /**
     * Parse all links in the DOM and split into internal/external lists.
     *
     * @return array
     */
    private function extractLinks(): array
    {
        $host  = parse_url($this->url, PHP_URL_HOST);
        $links = $this->xpath->evaluate('//a/@href');

        $internal = $external = [];
        foreach ($links as $link) {
            if (preg_match('!(http|https)!', $link->nodeValue) && !str_contains($link->nodeValue, $host)) {
                $external[$link->nodeValue] = 1;
            } else {
                $internal[$link->nodeValue] = 1;
            }
        }

        return ['internal' => count($internal), 'external' => count($external)];
    }

    /**
     * Parse all visible text from the DOM and return the word count.
     *
     * @return int
     */
    private function parseWordCount(): int
    {
        $text = '';
        foreach ($this->xpath->query('//text()') as $node) {
            $text .= $node->nodeValue;
        }

        return str_word_count($text);
    }

    /**
     * Parse the title from the DOM.
     *
     * @return int
     */
    private function parseTitleLength(): int
    {
        return strlen($this->xpath->query('//title')->item(0)->nodeValue);
    }
}
