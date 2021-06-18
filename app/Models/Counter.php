<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use HasFactory;

    protected $fillable = [
        'table',
        'quantity',
    ];

    const TABLES = [
        'CARGO' => 'cargos',
    ];
}
