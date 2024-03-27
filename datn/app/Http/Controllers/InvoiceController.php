<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Models\invoice;
use App\Models\invoice_detail;

class InvoiceController extends Controller
{
    public function index($id = null)
    {
        if ($id === null) {
            $invoice = invoice::with('details', 'customer')->paginate(10);
            return response()->json($invoice);
        } else {
            $invoice = invoice::find($id);
            if ($invoice) {
                return response(['data' => $invoice]);
            } else {
                return response(['error' => 'Not found data']);
            }
        }
    }
    public function create(InvoiceRequest $request)
    {

        try {
            $data = $request->validated();
            $invoice = invoice::create([
                'receiver_address' => $data['receiver_address'],
                'receiver_phone' => $data['receiver_phone'],
                'total_amount' => $data['total_amount'],
                'customer_id' => $data['customer_id']
            ]);
            $invoiceId = $invoice->id;
            foreach ($data['details'] as $detail) {
                invoice_detail::create([
                    'quantity' => $detail['quantity'],
                    'unit_price' => $detail['unit_price'],
                    'total_price' => $detail['quantity'] * $detail['unit_price'],
                    'product_id' => $detail['product_id'],
                    'invoice_id' => $invoiceId
                ]);
            }
            $invoice = invoice::with('details', 'customer')->find($invoice->id);
            return response()->json(['data' => $invoice], 201);
        } catch (\Exception $err) {
            return response()->json(['error' => $err->getMessage()], 500);
        }
    }
}
