<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountModification extends Model
{
    protected $table = 'account_modifications';

    protected $fillable = [
        'changed_attribute',
        'category_id',
        'status_id',
    ];
  
    public function category(){
        return $this->belongsTo(ModificationCategory::class, 'category_id');
    }
  
    public function statusHistory(){
        return $this->belongsTo(StatusHistory::class, 'status_id');
    }

    public function additions(){
      return $this->hasMany(ModificationAddition::class, 'modification_id');
    }

    public function deletions(){
      return $this->hasMany(ModificationDeletion::class, 'modification_id');
    }
}
