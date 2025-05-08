<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;

    protected $table = 'role';
    
    protected $fillable = [
        'name',
        'description',
        'access_level'
    ];

    public function getTable()
    {
        return 'role'; // Force this exact table name
    }


    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}