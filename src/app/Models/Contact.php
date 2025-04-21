<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural of the model name
    protected $table = 'contacts';

    // Specify the fillable fields
    protected $fillable = ['user_id', 'first_name', 'last_name', 'email', 'phone'];
}