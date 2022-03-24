<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $imageable_type
 * @property int $imageable_id
 * @property string $filename
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property MorphTo $imageable
 */
class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'imageable',
        'filename',
    ];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
