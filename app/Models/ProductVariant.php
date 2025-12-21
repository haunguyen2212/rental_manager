<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariant extends Model
{
    use SoftDeletes;

    protected $table = 'product_variants';

    protected $primaryKey = 'id';

    protected $fillable = [
        'product_id',
        'sku',
        'thumbnail',
        'price',
        'sale_price',
        'stock_quantity',
        'status',
        'created_by',
        'updated_by',
    ];
}
