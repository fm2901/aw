<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function makeInfo()
    {
        return $this->belongsTo(Make::class,'make');
    }

    public function clientInfo()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function photos()
    {
        return $this->morphToMany(Files::class, 'fileble', 'fileble', 'fileble_id', 'file_id');
    }
}
