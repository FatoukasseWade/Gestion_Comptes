<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'compte_id',
        'montant',
        'type',
        'date',
        'description',
    ];

    protected $casts = [
        'id' => 'string',
        'montant' => 'decimal:2',
        'date' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($t) {
            if (empty($t->id)) {
                $t->id = (string) Str::uuid();
            }
        });
    }

    public function compte()
    {
        return $this->belongsTo(Compte::class);
    }
}
