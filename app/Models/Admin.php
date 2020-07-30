<?php

namespace App\Models;

use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\File;


class Admin extends Authenticatable implements HasMedia
{
    use Notifiable, HasRoles, HasMediaTrait;

    protected $guarded = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send the password reset notification.
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }


    public function registerMediaCollections()
    {
        $this->addMediaCollection('avatar')
            ->acceptsMimeTypes(['image/png', 'image/jpeg', 'image/bmp', 'image/gif', 'image/svg', 'image/webp',])
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('card')
                    ->width(400)
                    ->height(300);

                $this->addMediaConversion('thumb')
                    ->width(100)
                    ->height(100);

                $this->addMediaConversion('origin');
            });

    }

    public function avatar()
    {
        return $this->hasOne(Media::class, 'id', 'avatar_id');
    }

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar != null) {
            return $this->avatar->getUrl('thumb');
        } else {
            return 'https://via.placeholder.com/150';
        }
    }
}
