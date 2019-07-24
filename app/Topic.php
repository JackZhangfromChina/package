<?php

namespace App;

use App\Transformers\UserTransformer;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }









}
