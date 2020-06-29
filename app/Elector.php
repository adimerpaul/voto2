<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elector extends Model
{
    protected $fillable=['ci','nombres','mesa','votacion'];
    protected $table = 'electores';
}
