<?php

class User extends CustomModel
{

    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'core_users';
    protected $primaryKey = 'uid';

    static function check()
    {

        if ($id = $_COOKIE['id']){
            $redis = new Redis();
            if ($redis->cmd('HGET', 'user__'.$id, 'id')->get() == $id){
                return User::find($id);
            }
        }
        return false;


    }

    public function login($data, $redis)
    {
        $token = sha1($this->pasawd . time());
        //TODO сделать учет галочки запомнить меня
        setcookie('id', $this->uid, time()+360000, '/');
        setcookie('token', $token, time()+360000, '/');
        $config = Config::getInstance();
        $redis->cmd('HSET', $config->getPrefix().'_user__'.$this->uid, 'id', $this->uid)->
                cmd('HSET', $config->getPrefix().'_user__'.$this->uid, 'token', $token)->set();
        return true;
    }

    static function logout()
    {
        setcookie('id', 0, time()-360000, '/');
        setcookie('token', 0, time()-360000, '/');
        setcookie('city', 0, time()-360000000,'/');
        return true;
    }

    public function getSecRegsAttribute($value)
    {
        return explode(',', $value);
    }

    public function setSecRegsAttribute($value)
    {
        $this->attributes['sec_regs'] = implode(',', $value);
    }
}
