<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ingredient;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'category',
        'description',
        'price',
        'image',
        'ingredients',
        'stock',
        'seller_id'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getRatingAttribute()
    {
        return $this->reviews()->avg('rating');
    }

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function getSoldCountAttribute()
    {
        return $this->transactionItems()
            ->whereHas('transaction', function($query) {
                $query->whereIn('status', ['paid', 'shipped', 'success']);
            })
            ->sum('quantity');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function getIngredientsListAttribute()
    {
        // kalo pake relasi ingredients
        if ($this->ingredients()->exists()) {
            return $this->ingredients->pluck('name')->toArray();
        }
        
        // kalo pake string ingredients jadiin array
        if (!empty($this->ingredients) && is_string($this->ingredients)) {
            return array_map('trim', explode(',', $this->ingredients));
        }
        
        return [];
    }



}
