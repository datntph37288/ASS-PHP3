@extends('clients.layout.master_product_detail')

@section('content')
<div class="container">
    <h1>Giỏ Hàng</h1>
    <form action="{{ route('cart.update') }}" method="POST">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Số Lượng</th>
                    <th>Giá</th>
                    <th>Tổng</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0 @endphp
                @foreach($cart as $id => $details)
                    @php $total += $details['price'] * $details['quantity'] @endphp
                    <tr>
                        <td>
                            <img src="{{ Storage::url($details['image']) }}" width="50" height="50" class="img-fluid" alt="{{ $details['name'] }}">
                        </td>
                        <td>{{ $details['name'] }}</td>
                        <td>
                            <input type="number" name="quantities[{{ $id }}]" value="{{ $details['quantity'] }}" class="form-control" min="1" required>
                        </td>
                        <td>{{ $details['price'] }}đ</td>
                        <td>{{ $details['price'] * $details['quantity'] }}đ</td>
                        <td>
                            <form action="{{ route('cart.remove') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-6 offset-md-6 text-right">
                <h4>Tổng: {{ $total }}đ</h4>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Cập Nhật Giỏ Hàng</button>
        <a href="{{ route('checkout.index') }}" class="btn btn-success">Thanh Toán</a>
    </form>
</div>
@endsection
