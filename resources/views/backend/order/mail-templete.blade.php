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
            width: 200px;
            border-radius: 10px;
        }

        .content h2 {
            color: #ffffff;
            font-size: 18px;
            margin-bottom: 10px;
            padding: 10px;
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
            color: #333333;
            margin-bottom: 5px;
        }

        .total-row.final-total {
            font-weight: bold;
            font-size: 16px;
            background-color: #0F1228;
            color: #ffffff;
            padding: 10px;
            border-radius: 5px;
        }

        .total-row.final-total span:first-child {
            text-transform: uppercase;
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

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #1a2526;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            margin-top: 10px;
        }

        .footer {
            background-color: #1a2526;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            font-size: 12px;
        }

        .footer a {
            color: #ffffff;
            text-decoration: none;
            margin: 0 5px;
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
                <h2>Your Order Summary</h2>
            </div>
            <h1>Thank You for Choosing <span>Glowthentic</span></h1>
            <p>Hello Nayem</p>
            <p>We’re thrilled to confirm your order with Glowthentic. Your commitment to sustainability helps us make a
                positive impact on the planet. Below are the details of your purchase.</p>
        </div>
        <table class="order-details">
            <tr>
                <th>Invoice Number</th>
                <td>#123456</td>
            </tr>
            <tr>
                <th>Order Date</th>
                <td>October 10, 2023</td>
            </tr>
            <tr>
                <th>Shipping Address</th>
                <td>123 Green Lane, Eco City, 12345</td>
            </tr>
            <tr>
                <th>Shipping Method</th>
                <td>123 Green Lane, Eco City, 12345</td>
            </tr>
            <tr>
                <th>Payement Status</th>
                <td>123 Green Lane, Eco City, 12345</td>
            </tr>
        </table>
        <table class="product-list">
            <tr>
                <th>PRODUCT/ITEM'S</th>
                <th>UNIT PRICE</th>
                <th>QTY</th>
                <th>PRICE</th>
            </tr>
            <tr>
                <td>
                    <div class="product-item">
                        <img src="product1-placeholder.png" alt="Miyora Coconut Oil">
                        <div class="product-info">
                            <div class="product-name">MIYORA COCONUT OIL</div>
                            <div class="product-description">(45 gm)</div>
                        </div>
                    </div>
                </td>
                <td>৳ 500</td>
                <td>100</td>
                <td>৳ 50,000</td>
            </tr>
            <tr>
                <td>
                    <div class="product-item">
                        <img src="product2-placeholder.png" alt="Eyes Cream">
                        <div class="product-info">
                            <div class="product-name">EYES CREAM</div>
                            <div class="product-description">(45 gm)</div>
                        </div>
                    </div>
                </td>
                <td>৳ 500</td>
                <td>100</td>
                <td>৳ 50,000</td>
            </tr>
            <tr>
                <td>
                    <div class="product-item">
                        <img src="product3-placeholder.png" alt="Floraya">
                        <div class="product-info">
                            <div class="product-name">FLORAYA</div>
                            <div class="product-description">(45 gm)</div>
                        </div>
                    </div>
                </td>
                <td>৳ 500</td>
                <td>100</td>
                <td>৳ 50,000</td>
            </tr>
        </table>
        <div class="total-section">
            <div class="left"></div>
            <div class="right">
                <div class="total-row">
                    <span>SUBTOTAL</span>
                    <span>$46.74</span>
                </div>
                <div class="total-row">
                    <span>SHIPPING</span>
                    <span>$5.00</span>
                </div>
                <div class="total-row">
                    <span>TAX</span>
                    <span>$0</span>
                </div>
                <div class="total-row final-total">
                    <span>TOTAL</span>
                    <span>$51.74</span>
                </div>
            </div>
        </div>

        <div>
            <p>Well notify you when your items are shipped. You can track your order from your dashboard, Thanks again
                for shopping with us!
                -The Glowthentic Team</p>
        </div>
        {{-- <div class="trending">
            <h2>Trending Products</h2>
            <div class="trending-products">
                <div class="trending-product">
                    <img src="trending1-placeholder.png" alt="Trending 1">
                    <p>Reusable Straw Set</p>
                </div>
                <div class="trending-product">
                    <img src="trending2-placeholder.png" alt="Trending 2">
                    <p>Organic Cotton Tote</p>
                </div>
                <div class="trending-product">
                    <img src="trending3-placeholder.png" alt="Trending 3">
                    <p>Eco Makeup Kit</p>
                </div>
            </div>
            <a href="#" class="button">Shop Now</a>
        </div> --}}
        <div class="footer">
            <p><a href="#">Help Center</a> | <a href="#">Support</a> | <a href="#">Chat</a></p>
            <p>Copyright © 2023 EcoStride. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
