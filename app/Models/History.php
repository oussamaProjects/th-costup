<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'histories';

    public function sag_resource()
    {
        $this->belongsTo(SagResource::class, 'sag_resources_id', 'id', 'sag_resources');
    }

    public function histories(){
        $this->hasOne(History_statue::class);
    }

}
