<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleTo extends Model
{
    use HasFactory;

    protected $table = 'vehicle_to';

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;




}
