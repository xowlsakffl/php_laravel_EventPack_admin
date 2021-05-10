<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackPage extends Model
{
    protected $table = 'pack_page';

    protected $fillable = [
        'stdx', 'title', 'content', 'files', 'udx', 'name', 'ip', 'show_this', 'state'
    ];
}
