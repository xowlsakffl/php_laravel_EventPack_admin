<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LayoutMiddle extends Model
{
    protected $primaryKey = 'lomdx';
    protected $fillable = [
        'category', 'name_ko', 'name_en', 'code', 'html', 'css', 'state',
    ];

    public function layouts()
    {
        return $this->hasMany('App\Layout', 'lomdx');
    }
}
