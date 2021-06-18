<?php
declare(strict_types=1);

namespace App\Models;

use App\Casts\JSON;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'id',
        'volume',
        'weight',
        'truck',
    ];

    protected $casts = [
        'truck' => JSON::class,
    ];

    const STATUSES = [
        'DELETED' => 0,
        'ACTIVE' => 1,
    ];
}
