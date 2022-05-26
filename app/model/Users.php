<?php

namespace App\Model;

use App\Models\Todo;
use Core\BaseModel;

class Users extends BaseModel
{
    protected $table = "users";

    protected $hasMany = [Todo::class, 'user_id'];
}
