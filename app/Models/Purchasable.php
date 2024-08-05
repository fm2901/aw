<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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

    public static function updateList(Request $request, int $userId) {
        $fields = [
            'purchase_purposes' => PurchasePurpose::class,
            'car_states' => CarState::class,
            'to_export' => ToExport::class,
            'price_ranges' => PriceRange::class,
        ];


        foreach ($fields as $field => $modelName) {

            Purchasable::where('user_id', $userId)->where('purchasable_type', $modelName)->delete();

            if (!is_array($request->{$field})) {
                Purchasable::updateOrCreate([
                    'user_id' => $userId,
                    'purchasable_id' => $request->{$field},
                    'purchasable_type' => $modelName
                ]);
                continue;
            }

            foreach ($request->{$field} as $purchasable_id) {
                Purchasable::updateOrCreate([
                    'user_id' => $userId,
                    'purchasable_id' => $purchasable_id,
                    'purchasable_type' => $modelName
                ]);
            }
        }
    }
}
