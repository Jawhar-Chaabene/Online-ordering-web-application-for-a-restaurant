<?php

namespace App\Http\Controllers;

use App\Models\utilisateur;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve and return a listing of utilisateurs
        $utilisateurs = utilisateur::all();
        return response()->json($utilisateurs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:utilisateurs,email',
            'role' => 'string',
            // Add other validation rules as needed
        ]);

        // Create a new utilisateur using the validated data
        $utilisateur = utilisateur::create($data);

        return response()->json($utilisateur, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(utilisateur $utilisateur)
    {
        // Return the details of a specific utilisateur
        return response()->json($utilisateur);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, utilisateur $utilisateur)
    {
        // Validate the incoming request data
        $data = $request->validate([
            'name' => 'string',
            'email' => 'email|unique:utilisateurs,email,' . $utilisateur->id,
            'role' => 'string',
            // Add other validation rules as needed
        ]);

        // Update the utilisateur with the validated data
        $utilisateur->update($data);

        return response()->json($utilisateur, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(utilisateur $utilisateur)
    {
        // Delete the utilisateur
        $utilisateur->delete();

        return response()->json(null, 204);
    }
}
