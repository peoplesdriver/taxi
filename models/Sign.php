<?php

class Sign extends CustomModel
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'core_csigns';
    protected $primaryKey = 'csign';
    protected $checkbox = [];

    public function region()
    {
        return $this->hasOne('Region', 'sec_reg_id', 'sec_reg');
    }

    public function car()
    {
        return $this->hasOne('Car', 'car_id', 'ccar');
    }

    public function driver()
    {
        return $this->hasOne('Driver', 'did', 'cdriver');
    }
}