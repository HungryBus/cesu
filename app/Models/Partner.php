<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 * @property string $registration_code
 * @property string $comments
 * @property-read Carbon
 * @property-read Carbon
 * @property Document[] $documents
 */
class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'registration_code',
        'comments',
    ];

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'partner_id');
    }
}
