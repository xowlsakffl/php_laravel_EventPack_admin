<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserActionLog extends Model
{
    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }

    protected $fillable = [
        'udx', 'action', 'content', 'ip', 'ua', 'state'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'udx');
    }
}
