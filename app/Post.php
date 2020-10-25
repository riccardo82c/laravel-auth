<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    /* protected $guarded = ['role']; */

    /* public $guarded = []; */

    public $fillable = ['id', 'title', 'img', 'body', 'slug', 'created_at', 'updated_at', 'user_id'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag');
    }
}
