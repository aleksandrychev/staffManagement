<?php
/**
 * Created by PhpStorm.
 * User: Ігор
 * Date: 09.10.2016
 * Time: 12:21
 */

namespace App\Helpers;


class SearchHelper
{

    public static function prepareLikeValue($v){
       return '%' . str_replace(' ', '%', $v) . '%';
    }

}