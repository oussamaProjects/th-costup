<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SagResource extends Model
{
    use HasFactory;

    protected $table = 'sag_resources';

    public function histories()
    {
        $this->hasMany(History::class, 'sag_resources_id', 'id');
    }
}
