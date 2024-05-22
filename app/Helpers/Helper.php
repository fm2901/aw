<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Helper
{
    public static function getRandomString(int $length, $pattern="123456789"): string
    {
        $result = "";
        for($i = 0; $i <= $length; $i++)
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

    public static function getOptions(Collection $data, Array|String $selected=""): string
    {
        $options = "";
        if(is_array($selected)) {
            foreach ($data as $d)
            {
                $selected = in_array($d->id, $selected) ? "selected" : "";
                $options .= "<option ".$selected." value='".$d->id."'>".$d->name."</option>";
            }
        } else {
            foreach ($data as $d)
            {
                $selected = $d->id == $selected ? "selected" : "";
                $options .= "<option ".$selected." value='".$d->id."'>".$d->name."</option>";
            }
        }

        return $options;
    }
}
