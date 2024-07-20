@extends('admin.layout')
@section('title', 'Quản lý Đơn hàng')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }

        .order-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .order-details h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .order-details p {
            margin-bottom: 5px;
        }

        .product-list {
            margin-top: 20px;
        }

        .product-item {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .product-name {
            font-weight: bold;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="order-details">
                <h2>Chi tiết sản phẩm đã đặt</h2>
                    <p><strong>Tên:</strong> {{ $order->name }}</p>
                    <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
                    <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
                    <p><strong>Phương thức thanh toán:</strong> {{ $order->payment_method }}</p>
                    <p><strong>Ngày mua:</strong> {{ $order->created_at }}</p>
                    <p><strong>Trạng thái:</strong> {{ $order->status }}</p>
                    <p><strong>Người dùng:</strong> {{ $order->user->username }}</p>
                    <div class="product-list">
                        <h3>Danh sách sản phẩm</h3>
                        @foreach($orderdetail as $detail)
                        <div class="product-item">
                            <p class="product-name">{{ $detail->product->name }}</p>
                            <p>Hình ảnh</p>
                            <img src="{{ asset('uploads/'.$detail->product->image) }}" alt="" width="100px">
                            <p>Giá: {{ $detail->price }}</p>
                            <p>Số lượng: {{ $detail->quantity }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

</body>

</html>

@endsection