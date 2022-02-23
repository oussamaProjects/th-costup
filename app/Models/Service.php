<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'unit_measure',
        'qty',
        'occup_hour',
        'price',
        'profit_margin_p_c',
        'category_id'
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
