<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'neq',
        'name',
        'email',
        'password',
        'site',
        'product_service_detail',
        'tps_number',
        'tvq_number',
        'payment_condition',
        'currency',
        'communication_mode',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
      'password',
    ];

    public function contacts(){
      return $this->hasMany(Contact::class);
    }

    public function phoneNumbers(){
      return $this->hasMany(PhoneNumber::class);
    }

    public function rbqLicence(){
      return $this->hasOne(RbqLicence::class);
    }

    public function workSubcategories(){
      return $this->belongsToMany(WorkSubcategory::class, 'supplier_work_subcategory');
    }

    public function address(){
      return $this->hasOne(Address::class);
    }
}
