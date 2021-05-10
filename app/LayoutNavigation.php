<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LayoutNavigation extends Model
{
    protected $primaryKey = 'londx';
    protected $fillable = [
        'category', 'name_ko', 'name_en', 'code', 'html', 'css', 'state',
    ];

    public function layouts()
    {
        return $this->hasMany('App\Layout', 'londx');
    }
}
