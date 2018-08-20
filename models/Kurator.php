<?php
class Kurator extends CustomModel
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'core_kurators';
    protected $primaryKey = 'curid';
    protected $checkbox = [];
}