<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LayoutBottom extends Model
{
    protected $primaryKey = 'lobdx';
    protected $fillable = [
        'category', 'name_ko', 'name_en', 'code', 'html', 'css', 'state',
    ];

    public function layouts()
    {
        return $this->hasMany('App\Layout', 'lobdx');
    }
}
