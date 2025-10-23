<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="API Gestion Compte",
 *     version="1.0.0",
 *     description="Documentation de l'API Laravel Gestion Compte"
 * )
 *
 * @OA\Server(
 *     url="http://localhost:8000/api",
 *     description="Serveur local de développement"
 * )
 */
class CompteController extends Controller
{
    /**
     * @OA\Get(
     *     path="/comptes",
     *     tags={"Comptes"},
     *     summary="Récupérer la liste des comptes",
     *     @OA\Response(
     *         response=200,
     *         description="Liste des comptes récupérée avec succès"
     *     )
     * )
     */
    public function index()
    {
        return response()->json(['message' => 'Liste des comptes'], 200);
    }

    /**
     * @OA\Post(
     *     path="/comptes",
     *     tags={"Comptes"},
     *     summary="Créer un nouveau compte",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"client_id", "type", "solde"},
     *             @OA\Property(property="client_id", type="string"),
     *             @OA\Property(property="type", type="string"),
     *             @OA\Property(property="solde", type="number", format="float")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Compte créé avec succès"
     *     )
     * )
     */
    public function store(Request $request)
    {
        return response()->json(['message' => 'Compte créé'], 201);
    }
}
