<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Sales;

class SalesController extends Controller
{
    public function index()
    {
        $sales = Sales::all();
        return response()->json($sales);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:15',
            'tgl' => 'required|date',
            'cust_id' => 'required|integer',
            'subtotal' => 'nullable|numeric',
            'diskon' => 'nullable|numeric',
            'ongkir' => 'required|numeric',
            'total_bayar' => 'nullable|numeric',
        ]);

        $customer = Customer::find($request->cust_id);
        if (!$customer) {
            return response()->json(['error' => 'Customer ID not found'], 404);
        }

        $sales = Sales::create($request->all());

        return response()->json($sales, 201);
    }

    public function show($id)
    {
        $sales = Sales::find($id);

        if (!$sales) {
            return response()->json(['error' => 'Sales not found'], 404);
        }

        return response()->json($sales);
    }

    public function update(Request $request, $id)
    {
        $sales = Sales::find($id);

        if (!$sales) {
            return response()->json(['error' => 'Sales not found'], 404);
        }

        $request->validate([
            'kode' => 'required|string|max:15',
            'tgl' => 'required|date',
            'cust_id' => 'required|integer',
            'subtotal' => 'nullable|numeric',
            'diskon' => 'nullable|numeric',
            'ongkir' => 'required|numeric',
            'total_bayar' => 'nullable|numeric',
        ]);

        $customer = Customer::find($request->cust_id);

        if (!$customer) {
            return response()->json(['error' => 'Customer ID not found'], 404);
        }

        $sales->update($request->all());

        return response()->json($sales, 200);
    }

    public function destroy($id)
    {
        $sales = Sales::find($id);

        if (!$sales) {
            return response()->json(['error' => 'Sales not found'], 404);
        }

        $sales->delete();

        return response()->json(['message' => 'Sales deleted successfully']);
    }
}
