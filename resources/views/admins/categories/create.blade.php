@extends('admins.layout.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Thêm Sản Phẩm</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row">
                            <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Tên Danh Mục:</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                </div>

                                <div class="col-sm-auto">
                                    <div>
                                        <button type="submit" class="btn btn-secondary add-btn" data-bs-toggle="modal"
                                            id="create-btn" data-bs-target="#showModal">
                                            <i class="ri-add-line align-bottom me-1"></i> Thêm Sản Phẩm
                                        </button>
                                        <button type="reset" class="btn btn-info" data-bs-toggle="modal" id="create-btn"
                                            data-bs-target="#showModal"> Reset
                                        </button>
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
