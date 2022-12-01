<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'author_id',
        'body',
    ];

    protected $appends = [
        'j_created_at',
        'j_updated_at',
        'j_deleted_at',
    ];

    protected $dates = ['created_at'];


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


    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

}
