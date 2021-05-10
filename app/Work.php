<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    use SoftDeletes;
    
    protected $primaryKey = 'wdx';

    protected $fillable = [
        'udx', 'name', 'participant', 'duration', 'state',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'udx');
    }

    public function sites()
    {
        return $this->hasMany('App\Site', 'wdx');
    }
}
