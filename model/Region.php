<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/3/15
 * Time: 6:28 AM
 */

namespace model;
use Illuminate\Database\Eloquent\Model;

class Region extends Model{
    protected $table = 'regions';

    public function cities(){

        return   $this->hasMany('\model\City','regions_id','id');
    }
}