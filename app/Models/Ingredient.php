<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'suitable_for',
        'benefits',
        'cautions'
    ];

    protected $casts = [
        'suitable_for' => 'array',
        'benefits' => 'array',
        'cautions' => 'array'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function skinRecommendations() {
        return $this->hasMany(SkinTypeIngredientRecommendation::class);
    }
}
