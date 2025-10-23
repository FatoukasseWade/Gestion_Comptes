<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Transaction;

/**
 * @OA\Schema(
 *     schema="Compte",
 *     title="Compte",
 *     description="Modèle représentant un compte bancaire",
 *     @OA\Property(property="id", type="string", example="b4c2e123-67f2-4a21-9a0b-71f14e0193c3"),
 *     @OA\Property(property="user_id", type="string", example="9c95f123-02c9-4894-9d87-8e68e7b2cc29"),
 *     @OA\Property(property="numero", type="string", example="CNT20251023000123"),
 *     @OA\Property(property="solde", type="number", format="float", example=150000.75),
 *     @OA\Property(property="type", type="string", example="courant"),
 *     @OA\Property(property="status", type="string", example="actif"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-23T10:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-10-23T10:00:00Z")
 * )
 */
class Compte extends Model
{
    use HasFactory;

    /**
     * The primary key type and incrementing settings for UUID.
     */
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'numero',
        'solde',
        'type',
        'status',
    ];

    protected $casts = [
        'id' => 'string',
        'solde' => 'decimal:2',
    ];

    protected static function booted()
    {
        static::creating(function ($compte) {
            // Ensure UUID primary key
            if (empty($compte->id)) {
                $compte->id = (string) Str::uuid();
            }

            // Auto-generate numero if not provided
            if (empty($compte->numero)) {
                // Format: CNT + YYYYMMDD + 6 random digits
                $date = now()->format('Ymd');
                $compte->numero = 'CNT'.$date.str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            }
        });

        // After the compte is created, add an initial transaction representing the opening balance
        static::created(function ($compte) {
            try {
                Transaction::create([
                    'id' => (string) Str::uuid(),
                    'compte_id' => $compte->id,
                    'montant' => $compte->solde ?? 0,
                    'type' => 'initial',
                    'date' => now(),
                    'description' => 'Transaction initiale (solde d ouverture)'
                ]);
            } catch (\Throwable $e) {
                // Don't break account creation if transaction creation fails; log if needed
                // logger()->error('Failed to create initial transaction for compte: '.$e->getMessage());
            }
        });
    }

    /**
     * Relation: Compte belongs to a User (client)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
