<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table = 'posts';

    public function userPost() {
    	return $this->belongsTo('\App\User', 'user_id');
    }

    public function comments() {
    	return $this->hasMany('\App\Comments', 'post_id')->withTrashed();
    }

    public function postMoods() {
        return $this->hasMany('\App\Mood','post_id');
    }
}
