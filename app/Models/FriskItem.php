<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FriskItem extends Model
{
    use HasFactory;

    protected $table = 'frisk_items';
    protected $primaryKey = 'frisk_item_id';
    protected $fillable = ['appointment_id', 'item_name'];
}
