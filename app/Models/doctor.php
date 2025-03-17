<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class doctor extends Model
{
    protected $fillable = [
        'name', 'email',
        //  'phonenumber', 'address', 'department',
        // 'post', 'gender', 'password', 'image'
    ]; 
}
