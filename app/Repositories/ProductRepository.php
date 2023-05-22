<?php namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{
    CONST SEARCHEABLES_COLUMNS = [
        'name',
        'description',
        'brand',
        'category'
    ];
    public function __construct(Product $product){
        parent::__construct($product,[], searchable_columns: self::SEARCHEABLES_COLUMNS);
    }
}