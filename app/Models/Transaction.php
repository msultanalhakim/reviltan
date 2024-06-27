<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'reference_number';
    // Set the type of the primary key to string
    protected $keyType = 'string';

    // Disable auto-incrementing
    public $incrementing = false;
}
