@extends('admins.layout.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Sửa Sản Phẩm</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row">
                            <form action="{{route('product.update', $products->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Tên Sản Phẩm:</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{$products->name}}" disabled>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="hinh_anh" class="form-label">Hình Ảnh:</label>
                                        {{-- <input type="file" class="form-control" id="hinh_anh" name="hinh_anh" value="{{$products->hinh_anh}}"> --}}
                                        <td class="mt-3">
                                            <img src="{{ Storage::url($products->hinh_anh) }}" alt="Image"
                                                width="300">
                                        </td>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="so_luong" class="form-label">Số Lượng:</label>
                                        <input type="text" class="form-control" min="1" id="so_luong" name="so_luong" value="{{$products->so_luong}}" disabled>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Giá:</label>
                                        <input type="text" class="form-control" min="1" id="price" name="price" value="{{$products->price}}" disabled>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="ngay_nhap" class="form-label">Ngày Nhập:</label>
                                        <input type="date" class="form-control" id="ngay_nhap" name="ngay_nhap" value="{{$products->ngay_nhap}}" disabled>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Mô Tả:</label>
                                    <textarea class="form-control" id="description" rows="4" name="description" disabled >{{$products->description}} </textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Danh Mục:</label>
                                    <select class="form-select mb-3" aria-label="Default select example" name="category_id" disabled>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $products->category_id ? 'selected' :  '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-auto">
                                    <div>
                                        <div>
                                            <a href="{{ route('product.index') }}" class="btn btn-secondary add-btn">Về Trang Sản Phẩm</a>
                                        </div>
                                    </div>

                                </div>
                            </form>


                        </div>
                    </div>
                </div><!-- end card -->
            </div>
        </div>
    </div>
@endsection
