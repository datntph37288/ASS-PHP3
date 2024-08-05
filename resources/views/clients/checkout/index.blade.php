@extends('clients.layout.master_product_detail')

@section('content')
<div class="container">
    <h1>Thanh Toán</h1>

    <h3>Thông Tin Đơn Hàng</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Ảnh</th>
                <th>Tên Sản Phẩm</th>
                <th>Số Lượng</th>
                <th>Giá</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0 @endphp
            @foreach($cart as $id => $details)
                @php $total += $details['price'] * $details['quantity'] @endphp
                <tr>
                    <td><img src="{{ Storage::url($details['image']) }}" width="50" height="50" alt="{{ $details['name'] }}"></td>
                    <td>{{ $details['name'] }}</td>
                    <td>{{ $details['quantity'] }}</td>
                    <td>{{ $details['price'] }}đ</td>
                    <td>{{ $details['price'] * $details['quantity'] }}đ</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-6 offset-md-6 text-right">
            <h4>Tổng: {{ $total }}đ</h4>
        </div>
    </div>

    <form action="{{ route('order.store') }}" method="POST">
    @csrf
    <input type="hidden" name="order_items" value="{{ json_encode($cart) }}">

    <div class="mb-3">
        <label for="name" class="form-label">Họ và Tên:</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Số Điện Thoại:</label>
        <input type="text" class="form-control" id="phone" name="phone" required>
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Địa Chỉ:</label>
        <input type="text" class="form-control" id="address" name="address" required>
    </div>

    <div class="mb-3">
        <label for="payment_method" class="form-label">Phương Thức Thanh Toán:</label>
        <select class="form-control" id="payment_method" name="payment_method" required>
            <option value="credit_card">Thẻ Tín Dụng</option>
            <option value="paypal">PayPal</option>
            <option value="cod">Thanh Toán Khi Nhận Hàng</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Hoàn Thành Thanh Toán</button>
</form>

</div>
@endsection
