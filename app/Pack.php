<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    protected $primaryKey = 'pdx';
    protected $fillable = [
        'code', 'name_ko', 'name_en', 'explain_ko', 'explain_en', 'default_path', 'state',
    ];
}
