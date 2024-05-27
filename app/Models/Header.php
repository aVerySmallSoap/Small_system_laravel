<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    use HasFactory;

    protected $table = 'headers';
    protected $primaryKey = 'header_id';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'user_id',
        'created_At'
    ];
}
