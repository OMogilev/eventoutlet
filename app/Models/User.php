<?php

namespace App\Models;

use App\Filters\UserFilter;
use Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    public const NEW_STATUS = 0;

    public const ACTIVE_STATUS = 1;

    public const WAITING_STATUS = 2;

    public const REJECTED_STATUS = 3;

    public const BANED_STATUS = 4;

    /**
     * @var array
     */
    public $statuses = [
        self::NEW_STATUS => [
            'name' => 'Новый',
            'public_name' => 'Новый'
        ],

        self::WAITING_STATUS => [
            'name' => 'Ожидает модерации',
            'public_name' => 'Ваш аккаунт на модерации'
        ],
        self::ACTIVE_STATUS => [
            'name' => 'Активен',
            'public_name' => 'Активен'
        ],
        self::REJECTED_STATUS => [
            'name' => 'Отклонен',
            'public_name' => 'Ваша заявка отклонена, проверте свою почту'
        ],
        self::BANED_STATUS => [
            'name' => 'Заблокирован',
            'public_name' => 'Ваш аккаунт заблокирован'
        ]
    ];

    /**
     * @var array
     */
    protected $guarded = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_verified_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function services()
    {
        return $this->hasMany(Service::class,'user_id', 'id');
    }

    public function offers()
    {
        return $this->hasManyThrough(
            Offer::class,
            Service::class,
            'user_id',
            'service_id',
            'id',
            'id'
        );
    }

    public function maxOfferPrice()
    {
        return $this->hasManyThrough(
            Offer::class,
            Service::class,
            'user_id',
            'service_id',
            'id',
            'id'
        )->selectRaw('max(offers.discount_price) as max_price, user_id')
            ->groupBy('laravel_through_key');
    }

    public function speciality()
    {
        return $this->hasOneThrough(
            Specialty::class,
            UserInfo::class,
            'user_id',
            'id',
            'id',
            'speciality_id'
        );

    }

    public function city()
    {
        return $this->hasOneThrough(
            City::class,
            UserInfo::class,
            'user_id',
            'id',
            'id',
            'city_id'
        );
    }

    public function checkPassword($password)
    {
        return Hash::check($password, $this->password);
    }

    public function gallery()
    {
        return $this->hasMany(Media::class,'user_id', 'id')
                    ->where(['type' => 'image', 'type_content' => 'gallery']);
    }

    public function videos()
    {
        return $this->hasMany(Media::class,'user_id', 'id')
            ->where(['type' => 'video', 'type_content' => 'video']);
    }

    public function info()
    {
        return $this->hasOne(UserInfo::class, 'user_id', 'id');
    }

    public function viewed()
    {
        $this->info()->increment('views');
    }

    public function getStatus($name = 'name')
    {
        return $this->statuses[$this->status][$name];
    }

    public function scopeFilter($query, UserFilter $filter)
    {
        return $filter->apply($query);
    }
}
