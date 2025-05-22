<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation Email</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@100..900&family=Outfit:wght@100..900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Encode Sans", sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
        }

        .header {
            background-color: #0F1228;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }

        .header img {
            max-width: 150px;
        }

        .content {
            padding: 20px;
            background: #F3F3F3;
        }

        .content h1 {
            color: #5B5B5B;
            font-size: 24px;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .content h1 span {
            color: #0F1228;
        }

        .content .badge {
            background: #0F1228;
            border-radius: 10px;
            box-sizing: border-box;
            display: inline-block;
            /* width: fit-content; */
        }

        .content .badge h2 {
            color: #ffffff;
            font-size: 18px;
            margin: 0;
            padding: 8px 16px;
            font-family: "Outfit", sans-serif;
            font-weight: 400;
        }

        .content p {
            color: #666666;
            font-size: 14px;
            line-height: 1.5;
        }

        .order-details {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .order-details th,
        .order-details td {
            padding: 10px;
            text-align: left;
            font-size: 14px;
            border-bottom: 1px solid #e0e0e0;
        }

        .order-details th {
            color: #333333;
            font-weight: bold;
        }

        .order-details td {
            color: #666666;
        }

        .product-list {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .product-list th,
        .product-list td {
            padding: 10px;
            text-align: left;
            font-size: 14px;
            border-bottom: 1px solid #e0e0e0;
        }

        .product-list th {
            color: #333333;
            font-weight: bold;
            text-transform: uppercase;
        }

        .product-list td {
            color: #666666;
        }

        .product-item {
            display: flex;
            align-items: center;
        }

        .product-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 15px;
        }

        .product-info {
            display: flex;
            flex-direction: column;
        }

        .product-name {
            font-weight: bold;
            color: #333333;
            font-size: 14px;
            text-transform: uppercase;
        }

        .product-description {
            color: #666666;
            font-size: 12px;
        }

        .total-section {
            padding: 10px;
            text-align: right;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-section .left {
            width: 50%;
        }

        .total-section .right {
            width: 50%;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: #A3A3A3;
            margin-bottom: 5px;
            padding: 0 10px;
            font-weight: 600;
        }

        .final-total {
            width: 100%;
            font-weight: 600;
            font-size: 18px;
            border-top: 1px solid #0F1228;
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
        }

        .final-total span:first-child {
            text-transform: uppercase;
            line-height: 20px;
            padding: 10px;
        }

        .final-total .final-value {
            background: #0F1228;
            text-align: right;
            color: #ffffff;
            padding: 10px 10px 10px 60px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .trending {
            padding: 20px;
            background-color: #f9f9f9;
            text-align: center;
        }

        .trending h2 {
            color: #333333;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .trending-products {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .trending-product {
            width: 30%;
            text-align: center;
            margin-bottom: 20px;
        }

        .trending-product img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }

        .trending-product p {
            color: #666666;
            font-size: 12px;
            margin: 5px 0;
        }

        .track-order {
            margin: 30px 10px;
            background: #F3F3F3;
            color: #A3A3A3;
            text-align: center;
            padding: 30px 10px;
            border-radius: 10px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0F1228;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            margin-top: 10px;
        }

        .footer {
            background-color: #0F1228;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            font-size: 12px;
        }



        .footer .footer-top a {
            font-size: 18px;
            font-weight: 600;
            color: #ffffff;
            text-decoration: none;
            margin: 0 5px;
        }

        .footer a {
            color: #ffffff;
            text-decoration: none;
            margin: 0 5px;
        }

        .footer .social-link {
            margin: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .footer .social-link a {
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('/backend/assets/images/glowthentic-logo.svg') }}" alt="EcoStride Logo">
        </div>
        <div class="content">
            <div class="badge">
                <h2>Order Summary</h2>
            </div>
            <h1>Thank You for Choosing <span>Glowthentic</span></h1>
            <p>Hello {{ $order?->userDetails?->full_name ?? 'Customer' }},</p>
            <p>We’re thrilled to confirm your order with Glowthentic. Your commitment to sustainability helps us make a
                positive impact on the planet. Below are the details of your purchase.</p>
        </div>
        <table class="order-details">
            <tr>
                <th>Invoice Number</th>
                <td>#{{ $order?->invoice_number ?? '000000' }}</td>
            </tr>
            <tr>
                <th>Order Date</th>
                <td> {{ \Carbon\Carbon::parse($order?->created_at)->format('F j, Y') }}</td>
            </tr>
            <tr>
                <th>Shipping Address</th>
                <td>{{ $order?->userDetails?->address ?? '' }}</td>
            </tr>
            <tr>
                <th>Payment Method</th>
                <td>{{ $order->payment_method === 'COD' ? 'Cash On Delivery' : $order->payment_method }}</td>
            </tr>
            <tr>
                <th>Payement Status</th>
                <td>{{ $order?->payment_status ?? '' }}</td>
            </tr>
        </table>
        <table class="product-list">
            <tr>
                <th>PRODUCT/ITEM'S</th>
                <th>UNIT PRICE</th>
                <th>QTY</th>
                <!-- Conditionally include Discount header -->
                @php
                    $hasDiscount = $order->orderDetails->contains(function ($item) {
                        return !is_null($item->variant->productVariantPromotion);
                    });
                @endphp
                @if ($hasDiscount)
                    <th>Discount</th>
                @endif
                <th>PRICE</th>
            </tr>
            @php
                $subtotal = 0;
            @endphp
            @forelse ($order->orderDetails as $item)
                <tr>
                    <td>
                        <div class="product-item">
                            <img src="{{ $item->variant->variantImage->isNotEmpty() ? asset($item->variant->variantImage[0]->image) : asset('backend/assets/images/dummy/image.jpg') }}"
                                alt="{{ $item->variant->product->product_name ?? 'image' }}">
                            <div class="product-info">
                                <div class="product-name">{{ $item->variant->product->product_name ?? 'N/A' }}</div>
                                <div class="product-description">({{ $item->variant->variant_name ?? 'N/A' }})</div>
                            </div>
                        </div>
                    </td>
                    <td>৳ {{ number_format($item->variant->regular_price, 2) ?? 0 }}</td>
                    <td>{{ $item->product_quantity ?? 0 }}</td>
                    <!-- Conditionally include Discount cell -->
                    @if ($hasDiscount)
                        <td>
                            @if ($item->variant->productVariantPromotion)
                                @if ($item->variant->productVariantPromotion->coupon->discount_type === 'percentage')
                                    @php
                                        $discountValue =
                                            ($item->total_price *
                                                $item->variant->productVariantPromotion->coupon->discount_value) /
                                            100;
                                    @endphp
                                    ৳ {{ number_format($discountValue, 2) ?? 0 }}
                                @else
                                    ৳
                                    {{ number_format($item->variant->productVariantPromotion->coupon->discount_value, 2) ?? 0 }}
                                @endif
                            @else
                                ৳ 0.00
                            @endif
                        </td>
                    @endif
                    <td>৳ {{ number_format($item->total_price, 2) ?? 0 }}</td>
                    @php
                        $subtotal += $item->total_price;
                    @endphp
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $hasDiscount ? 5 : 4 }}">No Items Found</td>
                </tr>
            @endforelse
        </table>
        {{-- <div class="total-section">
            <div class="left"></div>
            <div class="right">
                <div class="total-row">
                    <span>SUBTOTAL</span>
                    <span>৳ {{ number_format($subtotal, 2) ?? 0 }}</span>
                </div>
                <div class="total-row">
                    <span>SHIPPING</span>
                    <span>৳ {{ number_format($order->shipping_charge, 2) ?? 0 }}</span>
                </div>
                @if ($order->discount_amount > 0)
                    <div class="total-row">
                        <span>Discount</span>
                        <span>৳ {{ number_format($order->discount_amount, 2) ?? 0 }}</span>
                    </div>
                @endif
                <div class="total-row">
                    <span>TAX</span>
                    <span>৳ 0</span>
                </div>
            </div>
        </div> --}}
        <div class="total-section">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="50%"></td> <!-- Left empty for spacing -->
                    <td width="50%">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td
                                    style="color: #A3A3A3; font-size: 14px; font-weight: 600; padding: 5px 10px; text-align: left;">
                                    SUBTOTAL</td>
                                <td
                                    style="color: #A3A3A3; font-size: 14px; font-weight: 600; padding: 5px 10px; text-align: right;">
                                    ৳ {{ number_format($subtotal, 2) ?? 0 }}</td>
                            </tr>
                            <tr>
                                <td
                                    style="color: #A3A3A3; font-size: 14px; font-weight: 600; padding: 5px 10px; text-align: left;">
                                    SHIPPING</td>
                                <td
                                    style="color: #A3A3A3; font-size: 14px; font-weight: 600; padding: 5px 10px; text-align: right;">
                                    ৳ {{ number_format($order->shipping_charge, 2) ?? 0 }}</td>
                            </tr>
                            @if ($order->discount_amount > 0)
                                <tr>
                                    <td
                                        style="color: #A3A3A3; font-size: 14px; font-weight: 600; padding: 5px 10px; text-align: left;">
                                        DISCOUNT</td>
                                    <td
                                        style="color: #A3A3A3; font-size: 14px; font-weight: 600; padding: 5px 10px; text-align: right;">
                                        ৳ {{ number_format($order->discount_amount, 2) ?? 0 }}</td>
                                </tr>
                            @endif
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        {{-- <div class="final-total">
            <div>
                <span>TOTAL</span>
            </div>
            <div class="final-value">
                <span>৳ {{ $order->grand_total }}</span>
            </div>
        </div> --}}
        <div class="final-total">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td
                        style="text-transform: uppercase; color: #333333; font-size: 18px; font-weight: 600; padding: 10px; text-align: left;">
                        TOTAL
                    </td>
                    <td
                        style="background: #0F1228; color: #ffffff; font-size: 18px; font-weight: 600; padding: 10px; text-align: right; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                        ৳ {{ $order->grand_total }}
                    </td>
                </tr>
            </table>
        </div>

        <div class="track-order">
            <p>Your order has been confirmed. Click the button below to track your order and stay updated on your
                shipment. Thank you for shopping with us!
                - Glothentic Team</p>
            <a href="https://glowthentic.store/track-order" class="button">Track Order</a>
        </div>
        <div class="footer">
            <p class="footer-top"><a href="https://glowthentic.store/contact-us">Help Center</a> . <a
                    href="tel:+8801715443884">Support</a>
                .
                <a href="https://wa.me/+8801715443884" target="_blank">Chat</a>
            </p>
            <p>Copyright © 2023 Glowthentic. All rights reserved.</p>
            <p><a href="tel:+8801715443884">+880 1715-443884</a> | <a
                    href="mailto:info@glowthentic.store">info@glowthentic.store</a></p>
            <div class="social-link">
                <a href="https://www.facebook.com/glowthentics"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/glowthenticbd"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://wa.me/+8801715443884"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="https://www.tiktok.com/@glowthenticbd"><i class="fa-brands fa-tiktok"></i></a>
                <a href="https://www.youtube.com/@Glowthenticbd"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
    </div>
</body>

</html>
