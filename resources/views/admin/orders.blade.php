@extends('admin.layout')
@section('title', 'Quản lý Đơn hàng')
@section('content')
<div class="container_table">

    <table class="table_form">
        <tr>
            <th class="thead">#</th>
            <th class="thead">Khách Hàng</th>
            <th class="thead">Phone</th>
            <th class="thead">Email</th>
            <th class="thead">Địa chỉ</th>
            <th class="thead order-k">Chi tiết</th>
            <th class="thead">Ngày</th>                        
            <th class="thead">Trạng Thái</th>
            <!-- <th class="thead">Phương Thức Thanh Toán</th> -->
            <th class="thead order-k">Hành Động</th>
        </tr>
        @foreach($orders as $item)
        <tr>
            <td class="tbody">{{ $item->id }}</td>
            <td class="tbody">{{ $item->name }}</td>
            <td class="tbody">{{ $item->phone }}</td>
            <td class="tbody">{{ $item->email }}</td>
            <td class="tbody">{{ $item->address }}</td>
            <td class="tbody order-k"><a href="{{ route('orderDetail',['id'=>$item->id]) }}" class="myA" > Xem</a></td>
            <td class="tbody">{{ $item->buy_date }}</td>
            <td class="tbody">Đã Thanh Toán</td>
            <!-- <td class="tbody">Tiền mặt</td> -->
            <td class="tbody order-k"><a href="#" class="myDel"> Xóa</a></td>
        </tr>
        @endforeach
    </table>
    <div class="clearfix"></div>
</div>

@endsection