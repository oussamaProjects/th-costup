<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History_statue extends Model
{
    use HasFactory;

    public function histories(){
        $this->belongsToMany(History::class);
    }
}
