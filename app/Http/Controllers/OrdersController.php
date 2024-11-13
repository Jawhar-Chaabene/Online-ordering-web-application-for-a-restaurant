<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Orders::all();
        return response()->json($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $order = new Orders([
            'amount' => 'required|numeric',
            'delivery_date' => 'required|date',
            'status' => 'in:ongoing,completed',
            // Add other validation rules for additional fields
        ]);
        $order->save();
        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Orders::find($id);
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $order = Orders::find($id);
        $order->update($request->all());

        return response()->json($order, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Orders::find($id);
        $order->delete();

        return response()->json('Order deleted!');
    }

}
