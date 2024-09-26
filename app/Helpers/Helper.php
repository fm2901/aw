<?php

namespace App\Helpers;

use App\Models\OrderState;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Helper
{
    public static function getRandomString(int $length, $pattern="123456789"): string
    {
        $result = "";
        for($i = 1; $i <= $length; $i++)
        {
            $result .= $pattern[mt_rand(0, strlen($pattern) - 1)];
        }

        return $result;
    }
    public static function getRandomIdWithCheck(Model $model, $column, $length=9): int
    {
        $pattern = "123456789";
        do {
            $number = self::getRandomString($length, $pattern);
            $found = $model::where($column, $number);
        } while(!$found);

        return $number;
    }

    public static function getOptions(Collection $data, Array|String $selected=null): string
    {
        $options = "";
        if(is_array($selected)) {
            foreach ($data as $d)
            {
                $sel = in_array($d->id, $selected) ? "selected" : "";
                $options .= "<option ".$sel." value='".$d->id."'>".$d->name."</option>";
            }
        } else {
            foreach ($data as $d)
            {
                $sel = $d->id == $selected ? "selected" : "";
                $options .= "<option ".$sel." value='".$d->id."'>".$d->name."</option>";
            }
        }

        return $options;
    }

    public static function checkKeyValInCollection($collection, $key, $value)
    {
        if (!is_a($collection, 'Illuminate\Database\Eloquent\Collection')) {
            return false;
        }

        foreach ($collection as $item) {
            if ($item->{$key} == $value) {
                return true;
            }
        }

        return false;
    }

    public static function setChecked($collection, $key, $value) {
        if(!is_a($collection, 'Illuminate\Database\Eloquent\Collection') && $collection == $value) {
            echo "checked";
            return;
        }
        if (self::checkKeyValInCollection($collection, $key, $value)) {
            echo "checked";
        }
    }

    public static function printOrdersMenu($query=array()) {
        $current = $query["state"] ?? 0;
        $query["state"] = 0;


        $currentState = OrderState::find($current);
        $selected = $current > 0 ? $currentState->name : "All";
        $selected = $current == 0 && isset($query["sort"]) && $query["sort"] == 'desc' ? "Newest" : $selected;
        unset($query["sort"]);
        $menu = '<div class="dropdown menu-dropdown col-md-6 col-sm-6 w-50" style="text-align:end">
                        <a class="btn dropdown-toggle font-black" style="color: black; font-size: 1.3em" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            '.$selected.'
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="' . route('orders.index') . '?'.http_build_query($query).'">All</a>
                            <a class="dropdown-item" href="' . route('orders.index') . '?'.http_build_query($query).'&sort=desc">Newest</a>';
        foreach (OrderState::all() as $state) {
            $query["state"] = $state->id;
            $menu .= '<a class="dropdown-item order-menu-item" href="' . route('orders.index') . '?'.http_build_query($query).'">'.$state->name.'</a>';
        }

        $menu .=      '</div>
                    </div>';

        return $menu;
    }
    public static function printPurchasesMenu($current='') {
        $sortDirArr = [
            "award_date&sort=asc" => "Award Date (Newest First)",
            "award_date&sort=desc" => "Award Date (Oldest First)",
            "year&sort=asc" => "Year (Newest First)",
            "year&sort=desc" => "Year (Oldest First)",
            "balance&sort=asc" => "With Unpaid Balance",
            "balance&sort=desc" => "Without Unpaid Balance",
        ];

        $menu = '<div class="dropdown col-md-6 col-sm-7 w-50" style="text-align:end">
                        <a class="btn dropdown-toggle font-black" style="color: black; font-size: 1.3em" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            '.$sortDirArr[$current].'
        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">';
        foreach ($sortDirArr as $k => $v)
            $menu .= '<a class="dropdown-item" href="'. route('purchases.index') . '?sortBy='.$k.'">'.$v.'</a>';
        $menu .= '</div>
                    </div>';

        return $menu;
    }
}
