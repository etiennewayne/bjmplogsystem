<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    protected $primaryKey = 'appointment_id';

    protected $fillable = ['appointment_date', 'meridian', 'inmate', 'is_approved', 'is_cancel', 'inmate_relationship', 'user_id', 'purpose', 'is_scanned', 'frisking_items'];



    public function companions(){
        return $this->hasMany(Companion::class, 'appointment_id', 'appointment_id');
    }

    public function user(){
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }



}
