<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModificationDeletion extends Model
{
    protected $table = 'modification_deletions';

    protected $fillable = [
        'deletion',
        'modification_id',
    ];
  
    public function accountModification(){
        return $this->belongsTo(AccountModification::class, 'modification_id');
    }
}
