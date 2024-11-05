<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        /* Đặt chung cho bảng */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        thead tr {
            background-color: #FFA500; /* Màu cam cho header */
            color: white;
            font-weight: bold;
        }

        thead tr th,
        tbody tr td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        /* Sản phẩm trong giỏ */
        .cart_product img {
            width: 100px;
            height: auto;
            object-fit: contain;
        }

        /* Canh trái cho phần tên sản phẩm */
        .cart_description {
            text-align: left;
        }

        /* Phần chỉnh số lượng */
        .cart_quantity_input {
            width: 50px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
        }

        /* Nút xóa sản phẩm */
        .cart_delete a {
            color: #ff6b6b;
            font-size: 20px;
            text-decoration: none;
        }

        .cart_delete a:hover {
            color: #ff3b3b;
        }

        /* Styling cho bảng tổng */
        .total_area {
            border: 1px solid #ddd;
            padding: 15px;
            background-color: #f9f9f9;
            margin-top: 20px;
            border-radius: 8px;
        }

        .total_area ul {
            list-style: none;
            padding: 0;
        }

        .total_area ul li {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 18px;
            font-weight: bold;
        }

        .total_area ul li span {
            color: #ff6600; /* Màu cam cho các số */
        }

        /* Điều chỉnh cho mobile */
        @media (max-width: 768px) {
            thead {
                display: none;
            }

            tbody tr {
                display: block;
                margin-bottom: 10px;
            }

            tbody tr td {
                display: flex;
                justify-content: space-between;
                padding: 10px;
            }

            .cart_product img {
                width: 80px;
            }
        }
    </style>
</head>
<body>
    <section>
        <table>
            <thead>
                <tr class="cart_menu">
                    <td class="image">Item</td>
                    <td class="description"></td>
                    <td class="price">Price</td>
                    <td class="quantity">Quantity</td>
                    <td class="total">Total</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['body'] as $value)
                    <tr>
                        <td class="cart_product">
                            <a href="#"><img src="" alt="Product Image"></a>
                        </td>
                        <td class="cart_description" id="{{$value['id']}}">
                            <h4><a href="#">{{$value['name']}}</a></h4>
                            <p>Web ID: {{$value['id']}}</p>
                        </td>
                        <td class="cart_price" id="{{ floor($value['price']) }}">
                            <p>${{ number_format($value['price'], 2) }}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <input class="cart_quantity_input" type="text" name="quantity" value="{{$value['qty']}}" autocomplete="off" size="2">
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                ${{ number_format($value['price'] * $value['qty'], 2) }}
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="#"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                @endforeach	
            </tbody>
        </table>
    </section>

    <section id="do_action">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li class="cart-sub-total">Cart Sub Total 
                                <span class="cart-sub-total">${{ number_format($data['total'][1], 2) }}</span>
                            </li>
                            <li>Eco Tax 
                                <span class="eco-tax">${{ number_format($data['total'][1] * 0.08, 2) }}</span>
                            </li>
                            <li>Shipping Cost <span>Free</span></li>
                            <li>Total 
                                <span class="withtax">${{ number_format($data['total'][1] + ($data['total'][1] * 0.08), 2) }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
