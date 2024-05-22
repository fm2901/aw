<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasePurpose extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function users()
    {
        return $this->morphToMany(User::class, 'purchasable', 'purchasable');
    }
}
