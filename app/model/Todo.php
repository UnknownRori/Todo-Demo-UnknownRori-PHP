<?php

namespace App\Models;

use App\Model\Users;
use Core\BaseModel;

class Todo extends BaseModel
{
    protected $table = 'todo';

    protected $belongsTo = [Users::class, 'user_id'];
}

