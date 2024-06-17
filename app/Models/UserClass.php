<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserClass extends Model
{
    use HasFactory;

    protected $table = 'classes';

    /**
     * Get the users for the class.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'class_id');
    }
}
