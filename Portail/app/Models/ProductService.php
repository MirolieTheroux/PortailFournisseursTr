<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductService extends Model
{
    protected $table = 'products_services';

    public function suppliers(){
        return $this->belongsToMany(Supplier::class, 'supplier_products_services', 'products_services_code', 'supplier_id', 'code', 'id');
    }

    
}
