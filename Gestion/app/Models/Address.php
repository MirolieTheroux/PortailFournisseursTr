<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'civic_no',
        'street',
        'office',
        'postal_code',
        'city',
        'region',
    ];

    public function supplier(){
      return $this->belongsTo(Supplier::class);
    }

    /*public function province(){
      return $this->belongsTo(Province::class);
    }*/
}
