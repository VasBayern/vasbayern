<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    
    protected $guard = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // User

    public function customer() {
        return $this->hasMany('App\Models\CustomerModel', 'user_id', 'id');
    }

    public function order() {
        return $this->hasMany('App\Models\ShopOrderModel', 'user_id', 'id');
    }

    public function comment() {
        return $this->hasMany('App\Models\CommentModel', 'user_id', 'id');
    }

    public function comment_blog() {
        return $this->hasMany('App\Models\BlogCommentModel', 'user_id', 'id');
    }
    public function wishlist() {
        return $this->hasMany('App\Models\WishListModel', 'user_id', 'id');
    }

    // Admin
    
    public function post() {
        return $this->hasMany('App\Models\BlogPostModel', 'author_id', 'id');
    }
}
