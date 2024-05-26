<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $table = 'notes';
    public $timestamps = false;

    protected $fillable = [
        'header_id',
        'note_sequence',
        'message',
        'note_isFinished'
    ];
}
