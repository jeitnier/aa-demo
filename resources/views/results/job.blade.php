<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 4px;
    }
    h4 {
        text-transform: uppercase;
        margin-bottom: 0;
    }
</style>

<div class="container">
    <h1>Job: {{ $uuid }}</h1>
    <h3>Started at: {{ $started_at }}</h3>

    <h4>Stats</h4>
    <table>
        <thead>
            <tr>
                <th># Pages Crawled</th>
                <th># Unique Images</th>
                <th># Unique Internal Links</th>
                <th># Unique External Links</th>
                <th>Avg. Page Load (s)</th>
                <th>Avg. Word Count</th>
                <th>Avg. Title Length</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $num_pages_crawled }}</td>
                <td>{{ $num_unique_images }}</td>
                <td>{{ $num_unique_internal_links }}</td>
                <td>{{ $num_unique_external_links }}</td>
                <td>{{ $avg_page_load }}s</td>
                <td>{{ $avg_word_count }}</td>
                <td>{{ $avg_title_length }}</td>
            </tr>
        </tbody>
    </table>

    <h4>URL's Crawled</h4>
    <table>
        <thead>
            <tr>
                <th>URL</th>
                <th>Status Code</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($urls as $url => $status_code)
            <tr>
                <td>{{ $loop->iteration }}. <a href="{{ url($url) }}" target="_blank">{{ $url }}</a></td>
                <td>{{ $status_code }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <br/>
    <button type="button" onclick="window.location='{{ route('crawl') }}'">Start another crawl job</button>
</div>
