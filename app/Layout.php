<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    protected $primaryKey = 'lodx';
    protected $fillable = [
        'category', 'name_ko', 'name_en', 'descript_ko', 'descript_en', 'lotdx', 'londx', 'lomdx', 'lobdx', 'loedx', 'default', 'state'
    ];

    public function layoutTops()
    {
        return $this->belongsTo('App\LayoutTop', 'lotdx');
    }

    public function layoutNavigations()
    {
        return $this->belongsTo('App\LayoutNavigation', 'londx');
    }

    public function layoutMiddles()
    {
        return $this->belongsTo('App\LayoutMiddle', 'lomdx');
    }

    public function layoutBottoms()
    {
        return $this->belongsTo('App\LayoutBottom', 'lobdx');
    }

    public function layoutEtcs()
    {
        return $this->belongsTo('App\LayoutEtc', 'loedx');
    }
}
