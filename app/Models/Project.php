<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function services(){
        return $this->belongsToMany(Service::class, 'projects_services', 'project_id', 'service_id'); 
    }
    
    public function factors(){
        return $this->belongsToMany(Factor::class, 'projects_factors', 'project_id', 'factor_id');
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'projects_categories', 'project_id', 'category_id');
    }

}
