<?php
/**
 * Created by PhpStorm.
 * User: Ігор
 * Date: 09.10.2016
 * Time: 10:41
 */

namespace App\Http\Controllers;


class BaseApiController extends Controller
{
    protected $perPage = 10;

    public function setPerPage($v){
        $this->perPage = $v;
    }

    public function getPerPage(){
       return $this->perPage;
    }

}