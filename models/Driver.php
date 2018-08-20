<?php

class Driver extends CustomModel
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'core_drivers';
    protected $primaryKey = 'did';
    protected $checkbox = ['dsmoke', 'dproveren', 'danimals', 'dkvitok', 'dindpredpr',
        'dbezlimit', 'dcorp_balance', 'ddostavka'];

    public function region()
    {
        return $this->hasOne('Region', 'sec_reg_id', 'sec_reg');
    }

    public function filial()
    {
        return $this->hasOne('Filial', 'fid', 'dfilial');
    }

    public function kurator()
    {
        return $this->hasOne('Kurator', 'curid', 'dkurator');
    }

    public function sex()
    {
        return $this->hasOne('Sex', 'sex_id', 'dpol');
    }
}