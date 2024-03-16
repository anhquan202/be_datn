<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Models\invoice;
use App\Models\invoice_detail;

class InvoiceController extends Controller
{
    public function create(InvoiceRequest $request)
    {

        try {
            // Lấy dữ liệu từ request dưới dạng JSON
            $data = $request->json()->all();
            // Tạo một phiếu bán hàng mới
            $invoice = invoice::create([
                'receiver_address' => $data['receiver_address'],
                'receiver_phone' => $data['receiver_phone'],
                'total_amount' => $data['total_amount'],
                'customer_id' => $data['customer_id']
            ]);
            // // Loop through each detail and associate it with the invoice
            foreach ($data['details'] as $detail) {
                invoice_detail::create([
                    'quantity' => $detail['quantity'],
                    'unit_price' => $detail['unit_price'],
                    'total_price' => $detail['quantity'] * $detail['unit_price'],
                    'product_id' => $detail['product_id'],
                    'invoice_id' => $invoice->id
                ]);
            }
            $invoice = invoice::with('details', 'customer')->find($invoice->id);
            return response()->json(['invoice' => $invoice], 201);
        } catch (\Exception $err) {
            // Trả về lỗi nếu có bất kỳ lỗi nào xảy ra
            return response()->json(['error' => $err->getMessage()], 500);
        }
    }
}
