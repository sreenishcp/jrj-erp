<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryExecutive extends Model
{
    use HasFactory;
    public function employ()
    {
      return $this->belongsTo('App\Models\Employees','delivery_person','id');
    }
    public function vehicle()
    {
      return $this->belongsTo('App\Models\DeliveryVehicle','delivery_vehicle_id','id');
    }
    public function branch()
    {
      return $this->belongsTo('App\Models\Branch');
    }
}
