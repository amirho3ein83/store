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

    const SUGGESTION_YES = 'yes';
    const SUGGESTION_NO = 'no';

    protected $fillable = [
        'author_id',
        'product_id',
        'body',
        'suggestion',
    ];

    protected $appends = [
        'j_created_at',
        'j_updated_at',
        'j_deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->toFormattedDateString();
    }

    protected $dates = ['created_at'];

    protected $with = ['author'];

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function getJCreatedAtAttribute()
    {
        return \is_null($this->created_at) ? null : CalendarUtils::convertNumbers(
            Jalalian::fromCarbon($this->created_at)->format('Y/m/d')
        );
    }

    public function getJUpdatedAtAttribute()
    {
        return \is_null($this->updated_at) ? null : CalendarUtils::convertNumbers(
            Jalalian::fromCarbon($this->updated_at)->format('Y/m/d')
        );
    }

    public function getJDeletedAtAttribute()
    {
        return \is_null($this->deleted_at) ? null : CalendarUtils::convertNumbers(
            Jalalian::fromCarbon($this->deleted_at)->format('Y/m/d')
        );
    }
}
