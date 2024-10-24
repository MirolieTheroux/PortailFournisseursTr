<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductServiceCategory extends Model
{
    protected $table = 'products_services_categories';
  
    public function productsServices(){
        return $this->hasMany(ProductService::class);
    }
}
