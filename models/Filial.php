<?php
class Filial extends CustomModel
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'core_filials';
    protected $primaryKey = 'fid';
    protected $checkbox = [];
}