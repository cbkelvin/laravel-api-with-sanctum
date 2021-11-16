<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Worker extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = "Workers";

    protected $fillable = ["name", "email", "password", "phone_no"];

    public $timestamps = false;
}
