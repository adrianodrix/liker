<?php

namespace Liker\Domains\Posts\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Liker\Domains\Users\Models\User;

/**
 * Class Post
 *
 * @property int $id
 * @property string $body
 * @property int $likeCount
 * @property bool $likedByCurrentUser
 * @property bool $canBeLike
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 *
 * @package Liker\Domains\Posts\Models
 */
class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['body'];

    protected $appends = ['likeCount', 'likedByCurrentUser', 'canBeLike'];

    /**
     * Get User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function getLikeCountAttribute()
    {
        return $this->likes->count();
    }

    public function getLikedByCurrentUserAttribute()
    {
        if (!app('auth')->check()) {
            return false;
        }

        return $this->likes->where('user_id', app('auth')->user()->id)->count() === 1;
    }

    public function getCanBeLikeAttribute()
    {
        if (!app('auth')->check()) {
            return false;
        }

        return $this->user_id !== app('auth')->user()->id;
    }
}