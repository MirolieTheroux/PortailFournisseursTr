<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Supplier extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'confirmPassword',
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
      'confirmPassword',
      'remember_token',
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

    public function productsServices(){
      return $this->belongsToMany(ProductService::class, 'supplier_products_services', 'supplier_id', 'products_services_code', 'id', 'code');
    }

    public function address(){
      return $this->hasOne(Address::class);
    }

    public function attachments(){
      return $this->hasMany(Attachment::class);
    }

    public function statusHistories(){
      return $this->hasMany(StatusHistory::class);
    }

    public function latestNonModifiedStatus()
    {
      return $this->statusHistories()
        ->where('status', '!=', 'modified')
        ->orderBy('created_at', 'desc')
        ->first();
    }

    public function latestModifiedDate()
    {
      return $this->statusHistories()
        ->where('status', '=', 'modified')
        ->orderBy('created_at', 'desc')
        ->first();
    }

    public function latestActivableStatus()
    {
        return $this->statusHistories()
            ->where('status', '!=', 'modified')
            ->where('status', '!=', 'deactivated')
            ->orderBy('created_at', 'desc')
            ->first();
    }
}
