<?php

class Config
{
    public $confs;


    private static $instance;

    private function __construct()
    {
        require_once(__DIR__ . '/../config.php');
        $this->confs = $confs;
    }

    public static function getInstance()
    {
        if (empty(self::$instance)){
            self::$instance = new Config();
        }
        return self::$instance;
    }

    public function getPrefix()
    {
        return array_keys($this->confs)[0];
    }

}