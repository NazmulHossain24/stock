<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banks extends Model
{
    protected $table = 'banks';
    protected $primaryKey = 'bankID';
    protected $fillable = [
        'name', 'AccountNumber', 'userID'
    ];
}
