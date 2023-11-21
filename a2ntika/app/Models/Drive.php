<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drive extends Model
{
    use HasFactory;
    protected $table='drives';
    protected $fillable=['title','desc','file','user_id','status'];
}
