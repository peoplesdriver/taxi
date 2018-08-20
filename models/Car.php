<?php

class Car extends CustomModel
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'core_cars';
    protected $primaryKey = 'car_id';
    protected $checkbox = ['car_patriot', 'car_arenda', 'car_free', 'car_license', 'car_brand',
        'car_box_free',	'car_universal', 'car_tabl'];

    public function region()
    {
        return $this->hasOne('Region', 'sec_reg_id', 'sec_reg');
    }

    public function cartype()
    {
        return $this->hasOne('CarType', 'ct_id', 'car_type');
    }

}