<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusHistory extends Model
{
    protected $table = 'status_histories';

    protected $fillable = [ 
      'status', 
      'updated_by', 
      'supplier_id'
    ];

    public function supplier(){
      return $this->belongsTo(Supplier::class);
    }
}
