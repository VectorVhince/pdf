<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mood extends Model
{
    public function moodPost() {
    	return $this->belongsTo('\App\Posts','post_id');
    }
}
