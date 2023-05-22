<?php namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ProductCategory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'description',
        'image',
        'brand',
        'price',
        'price_sale',
        'category',
        'stock'
    ];
    protected $hidden = ['created_at', 'updated_at'];
    protected $casts = [
        'category' => ProductCategory::class
    ];



}
