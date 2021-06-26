@extends('layouts.admin.app')
@section('title', 'Room')
@section('room', 'active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row col-12 mb-2">
                <div class="col-sm-6">
                    <h1>Room</h1>
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
                                <a href="{{ route('admin.room.index') }}" class="btn btn-primary"><i
                                        class="fa fa-arrow-left iCheck"></i>&nbsp;Back to List</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.room.store') }}" method="POST" enctype="multipart/form-data"
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
                                                        class="form-control" placeholder="Enter room name">
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="room_no">Room No&nbsp;<span class="req">*</span></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="room_no" value="{{ old('room_no') }}"
                                                        class="form-control">
                                                    @error('room_no')
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
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="is_active">Status&nbsp;<span class="req">*</span></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select name="is_active" class="form-control">
                                                        <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>
                                                            Active
                                                        </option>
                                                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>
                                                            Inactive
                                                        </option>
                                                    </select>
                                                    @error('is_active')
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
        // $(document).on('click', 'form button[type=submit]', function(e) { //Working Code
        //     console.log($(e.target).parents('form'));
        //     var isValid = $(e.target).parents('form').valid();
        //     if (!isValid) {
        //         e.preventDefault(); //prevent the default action
        //     }
        // });
        $('#form').validate({
            onfocusout: true,
            rules: {
                name: {
                    required: true,
                    lettersonly: true,
                },
                room_no: "required",

                price: {
                    number:true,
                },
            },
            messages: {
                name: {
                    required: "Name field is required",
                },
                room_no: "Enter room number"

            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endsection
