<?php

class BrandGroup extends CustomModel
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'core_brand_groups';
    protected $primaryKey = 'brcl_id';
    protected $checkbox = [];
}