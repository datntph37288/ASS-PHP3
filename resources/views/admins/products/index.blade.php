@extends('admins.layout.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Danh Sách Sản Phẩm</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <a href=" {{ route('product.create') }} " class="btn btn-secondary add-btn">
                                        <i class="ri-add-line align-bottom me-1"></i> Add
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <div class="search-box ms-2">
                                        <input type="text" class="form-control search" placeholder="Search...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="">STT</th>
                                        <th class="">Name</th>
                                        <th class="">Image</th>
                                        <th class="">Số Lượng</th>
                                        <th class="">Price</th>
                                        <th class="">Ngày Nhập</th>
                                        <th class="">Category ID</th>
                                        <th class="">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>
                                                <img src="{{ Storage::url($product->hinh_anh) }}" alt="Image"
                                                    width="100">
                                            </td>
                                            <td>{{ $product->so_luong }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ \Carbon\Carbon::parse($product->ngay_nhap)->format('d/m/Y') }}</td>
                                            <td>{{ $product->category_name }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <a href="{{ route('product.edit', $product->id) }}"
                                                            class="btn btn-sm btn-success edit-item-btn">Edit</a>
                                                    </div>
                                                    <div class="remove">
                                                        <a href="{{ route('product.show', $product->id) }}"
                                                            class="btn btn-sm btn-info remove-item-btn">Detail</a>
                                                    </div>
                                                    <div class="delete">
                                                        <form action="{{ route('product.destroy', $product->id ) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" onclick="return confirm('Bạn có muốn xóa không ?')" class="btn btn-sm btn-danger remove-item-btn">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                <a class="page-item pagination-prev disabled" href="javascript:void(0);">
                                    Previous
                                </a>
                                <ul class="pagination listjs-pagination mb-0"></ul>
                                <a class="page-item pagination-next" href="javascript:void(0);">
                                    Next
                                </a>
                            </div>
                        </div>
                    </div>
                </div><!-- end card -->
            </div>
        </div>
    </div>
@endsection
