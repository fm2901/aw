<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'created_by',
    ];

    public $table = 'files';

    public function purchases()
    {
        return $this->morphToMany(Purchase::class, 'fileble', 'fileble');
    }

}
