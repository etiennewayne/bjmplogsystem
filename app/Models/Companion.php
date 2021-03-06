<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companion extends Model
{
    use HasFactory;

    protected $table = 'companions';
    protected $primaryKey = 'companion_id';
    protected $fillable = ['appointment_id', 'fullname', 'inmate_relationship'];
}
