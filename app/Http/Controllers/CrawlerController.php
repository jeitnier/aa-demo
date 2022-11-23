<?php

namespace App\Http\Controllers;

use App\Jobs\CrawlWebsite;
use App\Models\CrawledUrl;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CrawlerController extends Controller
{
    /**
     * Initiate crawling of a website.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function crawl(Request $request): RedirectResponse
    {
        // Under normal circumstances, this would probably be a POST request
        // triggered by an API call and would be subject to validation rules:
        // $request->validate([
        //     'urls' => 'required|array|between:4,6'
        // ]);
        //
        // And you would retrieve them simply by:
        // $request->get('urls')

        // And these would obviously be passed as JSON in the request body or by some other means
        $urls = [
            "https://agencyanalytics.com",
            "https://agencyanalytics.com/feature/automated-marketing-reports",
            "https://agencyanalytics.com/blog/black-friday-cyber-monday-2022",
            "https://agencyanalytics.com/feature/instagram-analytics-dashboard",
            "https://agencyanalytics.com/pricing",
            "https://agencyanalytics.com/dashboards",
            "https://agencyanalytics.com/help-center",
        ];

        $uuid = Str::uuid();
        // Adding a little random fun
        foreach (Arr::random($urls, rand(4, 6)) as $url) {
            $crawled_url = CrawledUrl::create([
                'uuid' => $uuid,
                'url'  => $url,
            ]);

            // Crawling could take a while, so let's send it off to the queue!
            // For demo purposes, we're just firing this synchronously, but we all know this needs to be queued async
            CrawlWebsite::dispatchSync($crawled_url);
        }

        return redirect()->route('results', ['job_id' => $uuid]);
    }
}
