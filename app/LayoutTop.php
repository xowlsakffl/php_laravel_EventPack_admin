<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LayoutTop extends Model
{
    protected $primaryKey = 'lotdx';
    protected $fillable = [
        'category', 'name_ko', 'name_en', 'code', 'html', 'css', 'state',
    ];

    public function layouts()
    {
        return $this->hasMany('App\Layout', 'lotdx');
    }
}
