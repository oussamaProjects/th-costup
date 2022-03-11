<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function services()
    {
        return $this->belongsToMany(Service::class, 'projects_services', 'project_id', 'service_id')->withTimestamps();
    }

    public function factors()
    {
        return $this->belongsToMany(Factor::class, 'projects_factors', 'project_id', 'factor_id')->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'projects_categories', 'project_id', 'category_id')->withTimestamps();
    }

    public function sags()
    {
        return $this->hasMany(Sag::class);
    }

    public function sag_resources()
    {
        return $this->belongsToMany(Service::class, 'sag_resources', 'project_id', 'resource_id')->withTimestamps();
    }

    public function sag_categories()
    {
        return $this->belongsToMany(Service::class, 'sag_categories', 'project_id', 'category_id')->withTimestamps();
    }
}
