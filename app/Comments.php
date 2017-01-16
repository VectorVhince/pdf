<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
    use SoftDeletes;
    
    public function commentsPost() {
    	return $this->belongsTo('\App\Posts', 'post_id');
    }
}
