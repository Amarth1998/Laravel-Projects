<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Mutator to format the name attribute
    public function setNameAttribute($val)
    {
        $this->attributes['name'] = "Mr. " . $val;
    }

    // Mutator to format the phone attribute
    public function setPhoneAttribute($val)
    {
        $this->attributes['phone'] = "+91-" . $val;
    }
}
