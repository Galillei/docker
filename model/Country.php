<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/3/15
 * Time: 6:12 AM
 */

namespace model;
use Illuminate\Database\Eloquent\Model;

class Country extends Model{
    protected $table = 'countries';

    public function regions()
    {
        return   $this->hasMany('\model\Region','countries_id','id');
    }

}