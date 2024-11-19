<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountModification extends Model
{
    protected $table = 'account_modifications';

    protected $fillable = [
        'changed_attribute',
        'modification_type',
        'modification',
        'category_id',
        'status_id',
    ];
  
    public function category(){
        return $this->belongsTo(ModificationCategory::class, 'category_id');
    }
  
    public function statusHistory(){
        return $this->belongsTo(StatusHistory::class, 'status_id');
    }
}
