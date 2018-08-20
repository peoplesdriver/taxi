<?php

class Sex extends CustomModel
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'core_sex';
    protected $primaryKey = 'sex_id';
    protected $checkbox = [];
}