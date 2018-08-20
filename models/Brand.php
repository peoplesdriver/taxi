<?php

class Brand extends CustomModel
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'core_brands';
    protected $primaryKey = 'brand_id';
    protected $checkbox = ['brand_auto_driver', 'brand_auto_predv', 'brand_nepodtv_razd'];

    public function filial()
    {
        return $this->hasOne('Filial', 'fid', 'brand_filial');
    }

    public function region()
    {
        return $this->hasOne('Region', 'sec_reg_id', 'brand_sec_reg');
    }

    public function brandGroup()
    {
        return $this->hasOne('BrandGroup', 'brcl_id', 'brand_group');
    }

}
