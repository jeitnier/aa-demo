<?php

namespace App\Jobs;

use App\Events\CrawlProcessed;
use App\Models\CrawledUrl;
use App\Services\CrawlService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

/**
 * A simple job that triggers a service that will process the crawling requirements
 */
class CrawlWebsite implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public CrawledUrl $crawled_url)
    {
    }

    /**
     * Execute the job.
     *
     * @param CrawlService $service
     * @return void
     */
    public function handle(CrawlService $service): void
    {
        try {
            $contents = $service->process($this->crawled_url->url);
        } catch (Throwable $e) {
            // Do some kind of logging, notification, or queue retry handling
            return;
        }

        // Update the model with the crawl service results
        $this->crawled_url->unique_images         = $contents->get('unique_images');
        $this->crawled_url->unique_internal_links = $contents->get('unique_links')['internal'];
        $this->crawled_url->unique_external_links = $contents->get('unique_links')['external'];
        $this->crawled_url->page_load             = $contents->get('page_load_time');
        $this->crawled_url->word_count            = $contents->get('word_count');
        $this->crawled_url->title_length          = $contents->get('title_length');
        $this->crawled_url->status_code           = $contents->get('status_code');
        $this->crawled_url->save();

        // Dispatch an event that lets a listener know this job is done
        CrawlProcessed::dispatch($this->crawled_url);
    }
}
