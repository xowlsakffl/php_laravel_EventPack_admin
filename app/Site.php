<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'sdx';

    protected $fillable = [
       'wdx' ,'name', 'domain', 'email_name', 'email_address', 'phone_name', 'phone_address', 'title', 'description', 'keyword', 'favicon_fdx', 'og_title', 'og_url', 'og_description', 'og_images', 'meta', 'saving_events_pack', 'use_email_auth', 'main_user_policy', 'seperate_user_policy', 'state'
    ];

    public function work()
    {
        return $this->belongsTo('App\Work', 'wdx');
    }
}
