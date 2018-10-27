<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The relationships to always eager-load.
     *
     * @var array
     */
    protected $with = ['user'];

    /**
     * Get a string path for the thread.
     *
     * @return string
     */
    public function path()
    {
        return "/{$this->username}";
    }

    /**
     * Fetch the path to the thread as a property.
     */
    public function getPathAttribute()
    {
        if (!$this->user) {
            return '';
        }
        return $this->path();
    }

    /**
     * A thread belongs to a creator.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
