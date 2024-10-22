<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    protected $table = 'phone_numbers';

    protected $fillable = [
        'number',
        'type',
        'extension',
        'contact_id',
        'supplier_id',
    ];

    // public function contact(){
    //   return $this->belongsTo(Contact::class, 'contact_id');
    // }

    public function supplier(){
      return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
