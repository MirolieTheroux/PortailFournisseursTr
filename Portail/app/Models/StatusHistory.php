<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusHistory extends Model
{
    protected $table = 'status_histories';

    public function supplier(){
      return $this->belongsTo(Supplier::class);
    }

    public function accountModifications(){
      return $this->hasMany(AccountModification::class, 'status_id');
    }
}
