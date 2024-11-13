<?php

namespace App\Http\Controllers;

use App\Models\menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = menu::with('category')->get();
        return $menus;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $menu = new menu([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'images' => $request->input('images'),
            'categorie_id' => $request->input('categorie_id'),
            'price' => $request->input('price'),
            'availability' => $request->input('availability'),
        ]);
        $menu->save();
        return response()->json($menu, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $menu = menu::find($id);
        return response()->json($menu);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $menu = menu::find($id);
        $menu->update($request->all());
        return response()->json($menu, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $menu = menu::find($id);
        $menu->delete();
        return response()->json('Menu supprimé !');
    }
}
