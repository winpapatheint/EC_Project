<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #555;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .subtotal {
            font-weight: bold;
        }

        p {
            margin-bottom: 10px;
        }

        .footer {
            margin-top: 20px;
            border-top: 2px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Order Confirmation</h2>
        <p>Dear {{ $orderDetails->first()->buyer->name }},</p>
        <p>Your order has been successfully placed. Here are the details:</p>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Shop</th>
                    <th>Quantity</th>
                    <th>Price(tax inc)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderDetails as $detail)
                <tr>
                    <td>{{ $detail->product->product_name }}</td>
                    <td>{{ $detail->seller->shop_name }}</td>
                    <td>{{ $detail->qty }}</td>
                    <td>{{ $detail->price }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table>
            <tbody>
                <tr>
                    <td class="subtotal">Subtotal :</td>
                    <td>¥{{ number_format($orderDetails->first()->order->sub_total_amount , 0, '.', ',') }}</td>
                </tr>
                <tr>
                    <td class="subtotal">Shipping Fee :</td>
                    <td>¥{{ number_format($orderDetails->first()->order->shipping_fee , 0, '.', ',') }}</td>
                </tr>
                <tr>
                    <td class="subtotal">Coupon Discounted :</td>
                    <td>¥{{ number_format($orderDetails->first()->order->coupon_discount_amount , 0, '.', ',') }}</td>
                </tr>
                <tr>
                    <td class="subtotal">Total Price :</td>
                    <td>¥{{ number_format($orderDetails->first()->order->total_amount , 0, '.', ',') }}</td>
                </tr>
            </tbody>
        </table>
        <p>Please transfer the total amount of {{ $totalAmount }} to the following bank account:</p>
        <p>Bank Name: Mizuho Bank</p>
        <p>Bank Code: 1234</p>
        <p>Branch Code: 123</p>
        <p>Account Number: 12345678</p>
        <p>Account Holder: Jhon</p>
        <p>If you don't transfer the amount within 3 days, your order will be cancelled.</p>
        <p>Please make sure the following your bank account name for the transfer process:</p>
        <p>Account Holder: {{ $accountHolder }}</p>
        <p>Thank you for shopping with us.</p>
        <div class="footer">
            <p>If you have any questions, please contact us at info@asia-hd.com.</p>
        </div>
    </div>
</body>
</html>
