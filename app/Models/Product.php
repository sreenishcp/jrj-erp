<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function supplier()
    {
      return $this->belongsTo('App\Models\Supplier');
    }
    public function category()
    {
      return $this->belongsTo('App\Models\Category');
    }
    public function unit()
    {
      return $this->belongsTo('App\Models\Unit');
    }
    public function branch()
    {
      return $this->belongsTo('App\Models\Branch');
    }
}
