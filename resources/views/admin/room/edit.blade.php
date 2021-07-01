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
                                <a href="{{ route('admin.room.index') }}" class="btn btn-primary">
                                    <i class="fa fa-arrow-left iCheck"></i>&nbsp;Back to List
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.room.update', $room->id) }}" method="POST"
                                enctype="multipart/form-data" id="form">
                                @csrf
                                @method('PUT')
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="name">Name&nbsp;<span class="req">*</span></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder="Enter room name" value="{{ $room->name }}">
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
                                                    <input type="text" name="room_no" class="form-control"
                                                        value="{{ $room->room_no }}">
                                                    @error('room_no')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="type_id">Room Type&nbsp;<span class="req">*</span></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select name="room_type_id" class="form-control">
                                                        <option value="">Select Room Type</option>
                                                        @foreach ($room_types as $room_type)
                                                            <option value="{{ $room_type->id }}"
                                                                {{ old('room_type_id', $room->room_type_id) == $room_type->id ? 'selected' : '' }}>
                                                                {{ $room_type->name }}
                                                            </option>
                                                        @endforeach
                                                        @error("room_type_id")
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="price">Price</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="price" class="form-control"
                                                        value="{{ $room->price }}">
                                                    @error('price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="is_active">Is Active&nbsp;<span class="req">*</span></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select name="is_active" class="form-control">
                                                        <option value="1" {{ $room->is_active == '1' ? 'selected' : '' }}>
                                                            Active
                                                        </option>
                                                        <option value="0" {{ $room->is_active == '0' ? 'selected' : '' }}>
                                                            Inactive
                                                        </option>
                                                    </select>
                                                    @error('is_active')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="status">Status</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select name="status" class="form-control">
                                                        @foreach (['Available' => 'Available', 'UnAvailable' => 'Not Available'] as $key => $value)
                                                            <option value="{{ $key }}"
                                                                {{ $key == $room->status ? 'selected' : '' }}>
                                                                {{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('status')
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
                name: {
                    required: true,
                },
                room_no: "required",
                price:{
                    number: true,
                },
                status: "required",
            },
            messages: {
                name: {
                    required: "Name field is required",
                },
                room_no: "Enter room number",
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endsection
