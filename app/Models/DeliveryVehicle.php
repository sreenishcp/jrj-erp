<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryVehicle extends Model
{
    use HasFactory;
    public function branch()
    {
      return $this->belongsTo('App\Models\Branch');
    }
    public function getFullNameAttribute()
    {
        return $this->vehicle_type . '-' . $this->reg_number;
    }
}
