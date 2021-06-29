@extends('layouts.admin.app')
@section('title', 'Product')
@section('product', 'active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row col-12 mb-2">
                <div class="col-sm-6">
                    <h1>Product</h1>
                </div>

            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title float-right">
                                <a href="{{ route('admin.product.index') }}" class="btn btn-primary"><i
                                        class="fa fa-arrow-left iCheck"></i>&nbsp;Back to List</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data"
                                id="form">
                                @csrf
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="name">Name&nbsp;<span class="req">*</span></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="name" value="{{ old('name') }}"
                                                        class="form-control" placeholder="Enter product name">
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="unit_id">Unit&nbsp;<span class="req">*</span></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select name="unit_id" class="form-control">
                                                        <option value="">Select Unit</option>
                                                        @foreach ($units as $unit)
                                                            <option value="{{ $unit->id }}" {{ old("unit_id") == $unit->id ? "selected" : "" }}>{{ $unit->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('unit_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="price">Price&nbsp;<span class="req">*</span></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="price" value="{{ old('price') }}"
                                                        class="form-control">
                                                    @error('price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {

        });

        $('#form').validate({
            onfocusout: true,
            rules: {
                unit_id: "required",
                name: {
                    required: true,
                    lettersonly: true,
                },
                price: {
                    required: true,
                    number: true,
                },
            },
            messages: {
                unit_id: {
                    required: "Please select unit",
                },
                name: {
                    required: "Product name is required",
                },
                price:{
                    required: "Price is required",
                    number: "Please enter valid price",
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endsection
