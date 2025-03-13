<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;
class PDFController extends Controller
{

    public function generateIvoicePDF($orderId,$invoice)
    {
        $order = Order::findOrFail($orderId);

        $data = [
            'order' => $order,
            'invoice' => $invoice
        ];
        // $pdf = PDF::loadView('frontend/pdf/invoicepdf', $data);
        // Create an instance of Dompdf
        $pdf = new Dompdf();
        $pdf->getOptions()->setIsRemoteEnabled(true);
        // Load the HTML from the view
        $html = View::make('frontend/pdf/invoicepdf', $data,compact('data'))->render();

        // Load HTML to Dompdf
        $pdf->loadHtml($html);

        // (Optional) Set the paper size and orientation
        $pdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $pdf->render();

        // Output the generated PDF (optional: you can save it to a file instead)
        return $pdf->stream('invoice.pdf');

        // return $pdf->download('invoice.pdf');
    }
}
