<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LayoutEtc extends Model
{
    protected $primaryKey = 'loedx';
    protected $fillable = [
        'category', 'name_ko', 'name_en', 'code', 'display_type', 'display_duration', 'font_default', 'font_resource', 'state',
    ];

    public function layouts()
    {
        return $this->hasMany('App\Layout', 'lodx');
    }
}
