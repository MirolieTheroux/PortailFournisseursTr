<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'approbation_email', 
        'finance_email', 
        'max_size_files',
        'file_max_size'
      ];
  
}
