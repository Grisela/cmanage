<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    
    protected $fillable = [
        'title', 'body'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
