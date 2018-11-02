<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'email', 'password', 'robot', 'avatar_path', 'biography', 'confirmation_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'isAdmin',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'confirmed' => 'boolean',
        'robot' => 'boolean',
        'reputation' => 'integer',
    ];

    /**
     * Get the route key name for Laravel.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    /**
     * Mark the user's account as confirmed.
     */
    public function confirm()
    {
        $this->confirmed = true;
        $this->confirmation_token = null;

        $this->save();
    }

    /**
     * Determine if the user is an administrator.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return in_array(
            strtolower($this->email),
            array_map('strtolower', config('penpals.administrators'))
        );
    }

    /**
     * Determine if the user is an administrator.
     *
     * @return bool
     */
    public function getIsAdminAttribute()
    {
        return $this->isAdmin();
    }

    /**
     * Get the path to the user's avatar.
     *
     * @param  string $avatar
     * @return string
     */
    public function getAvatarPathAttribute($avatar)
    {
        return asset($avatar ?: 'images/avatars/default.jpg');
    }

    /**
     * Update that the user passed Google's reCaptcha simulation.
     */
    public function confirmHumanlyness()
    {
        $this->robot = false;
        $this->save();
    }

    /**
     * A user knows or speaks many languages.
     */
    public function languages()
    {
        return $this->hasMany(Languages::class);
    }

    public function addLanguage($language, $fluency, $type)
    {
        request()->validate([
            'level' => 'required',
            'type' => 'required|in:learning,speaks',
            'user_id' => 'required',
        ]);

        $added = Languages::create([
            'language' => $language,
            'fluency' => $fluency,
            'type' => $type,
            'user_id' => $this->id,
        ]);

        return $added;
    }
}
