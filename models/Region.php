<?php

class Region extends CustomModel
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'core_sec_regs';
    protected $primaryKey = 'sec_reg_id';
    protected $checkbox = [];

    public function cars()
    {
        return $this->hasMany('Car', 'sec_reg', 'sec_reg_id');
    }

    public function drivers()
    {
        return $this->hasMany('Driver', 'sec_reg', 'sec_reg_id');
    }

    public function signs()
    {
        return $this->hasMany('Sign','sec_reg', 'sec_reg_id');
    }

}