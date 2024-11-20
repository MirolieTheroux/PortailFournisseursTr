<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModificationAddition extends Model
{
    protected $table = 'modification_additions';

    protected $fillable = [
        'addition',
        'modification_id',
    ];
  
    public function accountModification(){
        return $this->belongsTo(AccountModification::class, 'modification_id');
    }
}
