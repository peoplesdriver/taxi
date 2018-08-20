<?php

class CarType extends CustomModel
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'core_cartypes';
    protected $primaryKey = 'ct_id';
    protected $checkbox = [];
}