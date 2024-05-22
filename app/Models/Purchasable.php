<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchasable extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'purchasable_id',
        'purchasable_type',
    ];

    public $table = 'purchasable';
    public $timestamps = false;

    public function purchasable()
    {
        return $this->morphToMany();
    }
}
