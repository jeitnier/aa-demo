<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CrawledUrl
 *
 * @property int $id
 * @property string $uuid
 * @property string $url
 * @property int|null $unique_images
 * @property int|null $unique_internal_links
 * @property int|null $unique_external_links
 * @property int|null $page_load
 * @property int|null $word_count
 * @property int|null $title_length
 * @property int|null $status_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CrawledUrlFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|CrawledUrl newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrawledUrl newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrawledUrl query()
 * @method static \Illuminate\Database\Eloquent\Builder|CrawledUrl whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrawledUrl whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrawledUrl whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrawledUrl wherePageLoad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrawledUrl whereStatusCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrawledUrl whereTitleLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrawledUrl whereUniqueExternalLinks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrawledUrl whereUniqueImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrawledUrl whereUniqueInternalLinks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrawledUrl whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrawledUrl whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrawledUrl whereWordCount($value)
 */
class CrawledUrl extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'url',
        'unique_images',
        'unique_internal_links',
        'unique_external_links',
        'page_load',
        'word_count',
        'title_length',
        'status_code',
    ];
}
