<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens;
    use InteractsWithMedia;
    use HasRoles;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
    ];

    protected $appends = [
        'j_created_at',
        'j_updated_at',
        'j_deleted_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
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
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJCreatedAtAttribute()
    {
        return \is_null($this->created_at) ? null : CalendarUtils::convertNumbers(
            Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i')
        );
    }

    public function getJUpdatedAtAttribute()
    {
        return \is_null($this->updated_at) ? null : CalendarUtils::convertNumbers(
            Jalalian::fromCarbon($this->updated_at)->format('Y/m/d H:i')
        );
    }

    public function getJDeletedAtAttribute()
    {
        return \is_null($this->deleted_at) ? null : CalendarUtils::convertNumbers(
            Jalalian::fromCarbon($this->deleted_at)->format('Y/m/d H:i')
        );
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function likedProducts()
    {
        return $this->belongsToMany(Product::class, 'liked_products', 'liked_by', 'product_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'buyer_id', 'id');
    }
}
