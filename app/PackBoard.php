<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackBoard extends Model
{
    protected $table = 'pack_board';

    protected $fillable = [
        'stdx', 'title', 'content', 'files', 'udx', 'name', 'password', 'ip', 'show_this', 'secret', 'notice', 'state'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'udx');
    }
}
