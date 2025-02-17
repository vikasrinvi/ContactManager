<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['first_name', 'last_name', 'phone_number'];

    public function setNameAttribute($value)
    {
        $nameParts = explode(' ', $value, 2);
        $this->attributes['first_name'] = $nameParts[0] ?? '';
        $this->attributes['last_name'] = $nameParts[1] ?? '';
    }

    public function getNameAttribute()
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }
}
