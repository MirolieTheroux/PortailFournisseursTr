<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkSubcategory extends Model
{
    protected $table = 'work_subcategories';

    public function suppliers(){
      return $this->belongsToMany(Supplier::class, 'supplier_work_subcategory');
    }

  //   public function categories(){
  //     return $this->belongsTo(WorkSubcategory::class);
  // }
}
