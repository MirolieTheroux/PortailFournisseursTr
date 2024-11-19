<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModificationCategory extends Model
{
    protected $table = 'modification_categories';

    public function accountModifications(){
      return $this->hasMany(AccountModification::class);
    }
}
