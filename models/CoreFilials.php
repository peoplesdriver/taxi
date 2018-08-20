<?php
use Cartalyst\Sentinel\Users\Eloquent;
class CoreFilials extends CustomModel
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'core_filials';
    protected $primaryKey = 'fid';
    protected $checkbox = [];

}