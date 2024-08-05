<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fileble extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_id',
        'fileble_id',
        'fileble_type',
    ];

    public $table = 'fileble';
    public $timestamps  = false;

    public function purchases()
    {
        return $this->morphToMany(Purchase::class, 'fileble', 'fileble');
    }
}
