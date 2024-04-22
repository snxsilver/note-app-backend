<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $table = "note";

    protected $primaryKey='uuid';
    public $incrementing = false;
    protected $keyType='string';

    protected $fillable = [
        'uuid',
        'category',
        'title',
        'reminder',
        'user_id',
    ];
}
