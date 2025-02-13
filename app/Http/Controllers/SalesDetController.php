<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesDet;

class SalesDetController extends Controller
{
    public function index()
    {
        $salesDet = SalesDet::all();
        return response()->json($salesDet);
    }

    public function store(Request $request)
    {
        $request->validate([
            'sales_id' => 'required|integer',
            'barang_id' => 'required|integer',
            'harga_bandrol' => 'required|numeric',
            'qty' => 'required|integer',
            'diskon_pct' => 'required|numeric',
            'diskon_nilai' => 'required|numeric',
            'harga_diskon' => 'nullable|numeric',
            'total' => 'nullable|numeric',
        ]);

        $salesDet = SalesDet::create($request->all());

        // foreach ($request->details as $salesDet) {
        //     SalesDet::create($salesDet);
        // }

        return response()->json($salesDet, 201);
    }

    public function show($id)
    {
        $salesDet = SalesDet::find($id);

        if (!$salesDet) {
            return response()->json(['error' => 'SalesDet not found'], 404);
        }

        return response()->json($salesDet);
    }

    public function update(Request $request, $id)
    {
        $salesDet = SalesDet::find($id);

        if (!$salesDet) {
            return response()->json(['error' => 'SalesDet not found'], 404);
        }

        $request->validate([
            'sales_id' => 'required|integer',
            'barang_id' => 'required|integer',
            'harga_bandrol' => 'required|numeric',
            'qty' => 'required|integer',
            'diskon_pct' => 'required|numeric',
            'diskon_nilai' => 'required|numeric',
            'harga_diskon' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        $salesDet->update($request->all());

        return response()->json($salesDet, 200);
    }

    public function destroy($id)
    {
        $salesDet = SalesDet::find($id);

        if (!$salesDet) {
            return response()->json(['error' => 'SalesDet not found'], 404);
        }

        $salesDet->delete();

        return response()->json(['message' => 'SalesDet deleted successfully']);
    }
}
