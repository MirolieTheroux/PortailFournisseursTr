<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductService extends Model
{
    use HasFactory;

    protected $table = 'products_services';

    public function suppliers(){
        return $this->belongsToMany(Supplier::class, 'supplier_products_services', 'products_services_code', 'supplier_id', 'code', 'id');
    }

    public function categories(){
        return $this->belongsTo(ProductServiceCategory::class);
    }
}
