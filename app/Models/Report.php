<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property bool $is_approved
 * @property int $approved_by
 * @property string $approval_comments
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read User $approvalUser
 * @property-read Document[] $documents
 */
class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_approved',
        'approved_by',
        'approval_comments',
    ];

    public function approvalUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /*
     * See comment on App\Models\Document::report()
     */
    public function documents(): BelongsToMany
    {
        return $this->belongsToMany(Document::class, 'reports_documents');
    }
}
