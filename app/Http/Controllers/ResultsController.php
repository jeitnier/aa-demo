<?php

namespace App\Http\Controllers;

use App\Models\CrawledUrl;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    /**
     * Display the specified job details.
     *
     * @param Request $request
     * @param string  $job_id
     * @return View
     */
    public function show(Request $request, string $job_id)
    {
        $job = CrawledUrl::whereUuid($job_id)->get();

        // Create a key/value pair of the urls and their status codes
        $urls = $job->mapWithKeys(static function ($item) {
            return [$item['url'] => $item['status_code']];
        });

        return view('results.job', [
            'started_at'                => $job->first()->created_at->format('m/d/Y - h:i:sa'),
            'urls'                      => $urls->all(),
            'uuid'                      => $job_id,
            'num_pages_crawled'         => $job->count(),
            'num_unique_images'         => $job->sum('unique_images'),
            'num_unique_internal_links' => $job->sum('unique_internal_links'),
            'num_unique_external_links' => $job->sum('unique_external_links'),
            'avg_page_load'             => number_format($job->avg('page_load'), 4),
            'avg_word_count'            => round($job->avg('word_count')),
            'avg_title_length'          => round($job->avg('title_length')),
        ]);
    }
}
