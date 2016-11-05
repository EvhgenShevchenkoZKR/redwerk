<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscriptions';

    protected $fillable = [
        'email',
        'budget',
        'message',
        'callback',
        'subscribe',
    ];

    public static function getSubscribedMails(){
        return self::select('email')->where('subscribe', true)->get()->all();
    }
}
