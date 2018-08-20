<?php
use Cartalyst\Sentinel\Users\EloquentUser;
class Role extends Illuminate\Database\Eloquent\Model
{
    public $timestamps = false;
    protected $guarded = [];
}
