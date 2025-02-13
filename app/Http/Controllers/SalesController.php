<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Sales;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function index()
    {
        $sales = Sales::all();
        return response()->json($sales);
    }

    public function getLastAutoIncrementValue()
    {
        $lastSalesID = Sales::max('id');

        return response()->json(['lastSalesID' => $lastSalesID]);
    }

    public function salesReport()
    {
        $salesDetReport = Sales::join('sales_det', 'sales.id', '=', 'sales_det.sales_id')
            ->join('customer', 'sales.cust_id', '=', 'customer.id')
            ->select(
                'customer.name',
                'sales.id',
                'sales.kode',
                'sales.tgl',
                'sales.cust_id',
                'sales.subtotal',
                'sales.diskon',
                'sales.ongkir',
                'sales.total_bayar',
                Sales::raw('COALESCE(SUM(sales_det.qty), 0) AS total_qty')
            )
            ->groupBy('sales.id',  'customer.name')
            ->get();
        return response()->json($salesDetReport);
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

        try {
            DB::beginTransaction();

            $sales = Sales::find($id);
            if (!$sales) {
                return response()->json(['error' => 'Sales not found'], 404);
            }

            DB::table('sales_det')->where('sales_id', $id)->delete();

            $sales->delete();

            DB::commit();

            return response()->json(['message' => 'Sales and related sales_det deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to delete sales', 'message' => $e->getMessage()], 500);
        }
    }
}
