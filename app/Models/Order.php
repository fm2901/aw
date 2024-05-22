<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function stateInfo()
    {
        return $this->belongsTo(OrderState::class,'state');
    }

    public function makeInfo()
    {
        return $this->belongsTo(Make::class,'make');
    }

    public function damageLevelInfo()
    {
        return $this->belongsTo(DamageLevel::class,'damage_level');
    }
}
