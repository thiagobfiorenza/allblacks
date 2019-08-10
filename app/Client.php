<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'document', 'postcode', 'address', 'district', 'city', 'state', 'telephone', 'email', 'active'
    ];
}
