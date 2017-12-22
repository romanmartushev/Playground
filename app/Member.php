<?php
/**
 * Created by PhpStorm.
 * User: Roman
 * Date: 12/22/17
 * Time: 1:16 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name','age','birthday','phone_number','email'
    ];
}