<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;
    protected $table = "Workers";

    protected $fillable = ["name", "email", "password", "phone_no"];

    public $timestamps = false;
}
