<?php

namespace App;

use App\Task;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    // 其它的 Eloquent 属性...

    /**
     * 获取该用户的所有任务。
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
