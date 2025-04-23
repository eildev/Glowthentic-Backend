<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 20px;">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); overflow: hidden;">
                    <!-- Header -->
                    <tr>
                        <td style="background-color: #4CAF50; color: #ffffff; padding: 20px 30px; text-align: center;">
                            <h1 style="margin: 0; font-size: 24px;">Thank You for Your Order!</h1>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 30px;">
                            <p style="font-size: 16px;">Hi {{ $order->user->userDetails->full_name ?? 'Customer' }},</p>

                            <p style="font-size: 16px;">
                                We're happy to let you know that we've received your order Invoice No: <strong>#{{ $order->invoice_number }}</strong>.
                            </p>

                            <table width="100%" style="margin-top: 20px; border-collapse: collapse;">
                                <tr>
                                    <td style="padding: 10px 0; font-weight: bold;">Order Date:</td>
                                    <td style="padding: 10px 0;">{{ \Carbon\Carbon::parse($order->created_at)->format('F j, Y') }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; font-weight: bold;">Total Amount:</td>
                                    <td style="padding: 10px 0;">৳{{ number_format($order->total_amount, 2) }}</td>
                                </tr>

                                <tr>
                                    <td style="padding: 10px 0; font-weight: bold;">Shipping Charge:</td>
                                    <td style="padding: 10px 0;">৳{{ number_format($order->shipping_charge, 2) }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; font-weight: bold;">Grand Total:</td>
                                    <td style="padding: 10px 0;">৳{{ number_format($order->grand_total, 2) }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; font-weight: bold;">Payment Method:</td>
                                    <td style="padding: 10px 0;">{{ ucfirst($order->payment_method) }}</td>
                                </tr>

                            </table>

                            {{-- <h3 style="margin-top: 30px;">Shipping Details</h3>
                            <p style="margin: 0;">{{ $order-> }}</p> --}}

                            <hr style="margin: 30px 0; border: 0; border-top: 1px solid #ddd;">

                            <h3 style="margin-bottom: 20px;">🛒 Your Order Summary</h3>

                            <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
                                <thead>
                                    <tr style="background-color: #f8f8f8; text-align: left;">
                                        <th style="padding: 12px; border-bottom: 2px solid #ddd;">Item</th>
                                        <th style="padding: 12px; border-bottom: 2px solid #ddd;">Unit Price</th>
                                        <th style="padding: 12px; border-bottom: 2px solid #ddd;">Quantity</th>
                                        <th style="padding: 12px; border-bottom: 2px solid #ddd;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $subtotal = 0;
                                    @endphp
                                    @foreach($order->orderDetails as $item)
                                        @php
                                            $item_total = $item->unit_price * $item->product_quantity;
                                            $subtotal += $item_total;
                                        @endphp
                                        <tr>
                                            <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $item->product->product_name }}</td>
                                            <td style="padding: 10px; border-bottom: 1px solid #eee;">৳{{ number_format($item->unit_price, 2) }}</td>
                                            <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $item->product_quantity }}</td>
                                            <td style="padding: 10px; border-bottom: 1px solid #eee;">৳{{ number_format($item_total, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    @php
                                        $shipping = $order->shipping_charge ?? 0;
                                        // $grand_total = $subtotal + $shipping;
                                    @endphp
                                    <tr>
                                        <td colspan="3" style="padding: 10px; text-align: right; font-weight: bold;">Subtotal:</td>
                                        <td style="padding: 10px;">৳{{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="padding: 10px; text-align: right; font-weight: bold;">Shipping:</td>
                                        <td style="padding: 10px;">৳{{ number_format($shipping, 2) }}</td>
                                    </tr>

                                    <tr style="background-color: #f0f0f0;">
                                        <td colspan="3" style="padding: 12px; text-align: right; font-weight: bold; font-size: 16px;">Grand Total (with tax):</td>
                                        <td style="padding: 12px; font-weight: bold; font-size: 16px;">৳{{ number_format($order->grand_total, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>

                            <p style="margin-top: 30px;">We'll notify you when your items are shipped. You can track your order from your dashboard.</p>

                            <p style="margin-top: 20px;">Thanks again for shopping with us!</p>

                            <p style="font-weight: bold;">– The {{ config('app.name') }} Team</p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f9f9f9; text-align: center; padding: 20px; font-size: 12px; color: #888;">
                            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.<br>
                            If you have questions, contact us at <a href="mailto:noreply@glowthentic.store">noreply@glowthentic.store</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
