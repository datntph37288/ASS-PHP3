



@extends('clients.layout.master_product_detail')

@section('content')
<form action="{{ route('checkout.index') }}" method="GET">
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
            @foreach(session('cart', []) as $id => $details)
                @php $total += $details['price'] * $details['quantity'] @endphp
                <tr>
                    <td>
                        <img src="{{ Storage::url($details['image']) }}" alt="Image placeholder" class="img-fluid" width="100px">
                    </td>
                    <td>{{ $details['name'] }}</td>
                    <td>
                        <input type="number" name="quantities[{{ $id }}]" value="{{ $details['quantity'] }}" class="form-control" style="width: 100px; display: inline-block;" min="1" required>
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

    <button type="submit" class="btn btn-primary">Thanh Toán</button>
</form>

@endsection

