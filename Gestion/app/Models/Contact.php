<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'job',
    ];

    public function supplier(){
      return $this->belongsTo(Supplier::class);
    }

    public function phoneNumbers(){
      return $this->hasMany(PhoneNumber::class);
    }
}
