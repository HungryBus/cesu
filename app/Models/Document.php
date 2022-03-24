<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property-read int $id
 * @property int $document_identifier
 * @property Carbon $document_date
 * @property int $partner_id
 * @property int $created_by
 * @property float $amount
 * @property string $comments
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property Image $image
 * @property Partner $partner
 * @property Report $report
 */
class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_identifier',
        'document_date',
        'partner_id',
        'amount',
        'comments',
    ];

    protected $dates = [
        'document_date',
        'created_at',
        'updated_at',
    ];

    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }

    /*
     * Also, due to scalability: MorphMany case, image can be assigned to any
     * other entity, i.e. UserPhoto, etc.
     */
    public function image(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /*
     * This is done in order to assign each document to some other entity
     * in the future, thus enabling the scalability
     */
    public function report(): BelongsToMany
    {
        return $this->belongsToMany(Report::class, 'reports_documents');
    }
}
