<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Video
 * @package App
 *
 * @property int $id
 * @property string $user_id;
 * @property string $slug
 * @property string $name
 */
class Video extends Model
{
    protected $table = 'video';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
