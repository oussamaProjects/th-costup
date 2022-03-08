<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sag extends Model
{
    use HasFactory;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function resources()
    {
        return $this->belongsToMany(Service::class, 'sag_resources', 'sag_id', 'resource_id');
    }
    
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'sag_categories', 'sag_id', 'category_id');
    }
}
