@extends('layouts.admin.app')
@section('title', 'Relative')
@section('booking', 'active')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gif.css') }}">
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row col-12 mb-2">
                <div class="col-sm-6">
                    <h1>Edit Relative</h1>
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
                            <div class="card-title">
                                <a href="{{ route('admin.booking.show', $customer->booking_id) }}"
                                    class="btn btn-primary float-right"><i class="fa fa-arrow-left iCheck"></i>&nbsp;Back to
                                    Booking Detail</a>

                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.relative.udpate', $customer->id) }}" method="POST"
                                enctype="multipart/form-data" id="form">
                                @csrf
                                @method('put')
                                <h3><u>{{ strtoupper('Customer Details') }}</u></h3>
                                <input type="hidden" class="form-control" name="customer_id" id="client_id">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="first_name">First Name&nbsp;<span
                                                                class="req">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="first_name"
                                                            value="{{ old('first_name', $customer->first_name) }}"
                                                            class="form-control" placeholder="Enter First Name"
                                                            id="firstName">
                                                        @error('first_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="middle_name">Middle Name</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="middle_name"
                                                            value="{{ old('middle_name', $customer->middle_name) }}"
                                                            class="form-control" placeholder="Enter Middle Name"
                                                            id="middleName">
                                                        @error('middle_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="last_name">Surname&nbsp;<span
                                                                class="req">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="last_name"
                                                            value="{{ old('last_name', $customer->last_name) }}"
                                                            class="form-control" placeholder="Enter Surname" id="surName">
                                                        @error('last_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="gender">Gender&nbsp;<span class="req">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select name="gender" class="form-control" id="gender">
                                                            <option value="">Select Gender</option>
                                                            <option value="Male"
                                                                {{ old('gender', $customer->gender) == 'Male' ? 'selected' : '' }}>
                                                                Male
                                                            </option>
                                                            <option value="Female"
                                                                {{ old('gender', $customer->gender) == 'Female' ? 'selected' : '' }}>
                                                                Female
                                                            </option>
                                                            <option value="Other"
                                                                {{ old('gender', $customer->gender) == 'Other' ? 'selected' : '' }}>
                                                                Other
                                                            </option>
                                                        </select>
                                                        @error('gender')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="age">Age&nbsp;<span class="req">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="age"
                                                            value="{{ old('age', $customer->age) }}" class="form-control"
                                                            id="age">
                                                        @error('age')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="nationality">Nationality&nbsp;<span
                                                                class="req">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="nationality"
                                                            value="{{ old('nationality', $customer->nationality) }}"
                                                            class="form-control" id="nationality">
                                                        @error('nationality')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="address">Address&nbsp;<span class="req">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="address"
                                                            value="{{ old('address', $customer->address) }}"
                                                            class="form-control" id="address">
                                                        @error('address')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="contact_no">Contact No&nbsp;<span
                                                                class="req">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="contact_no"
                                                            value="{{ old('contact_no', $customer->contact_no) }}"
                                                            class="form-control" id="contact_no">
                                                        @error('contact_no')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="occupation">Occupation&nbsp;<span
                                                                class="req">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="occupation"
                                                            value="{{ old('occupation', $customer->occupation) }}"
                                                            class="form-control" id="occupation">
                                                        @error('occupation')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="identity_no">Citizenship No&nbsp;<span
                                                                class="req">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="identity_no"
                                                            value="{{ old('identity_no', $customer->identity_no) }}"
                                                            class="form-control" id="identity">
                                                        @error('identity_no')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="driving_license_no">Driving License No</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="driving_license_no"
                                                            value="{{ old('driving_license_no', $customer->driving_license_no) }}"
                                                            class="form-control" placeholder="Enter Driving License number"
                                                            id="license">
                                                        @error('driving_license_no')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="relation">Relation&nbsp;<span
                                                                class="req">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="relation"
                                                            value="{{ old('relation', $customer->relation) }}"
                                                            class="form-control">
                                                        @error('relation')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="signature">Upload Signature&nbsp;<span
                                                                class="req">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="file" name="signature" class="form-control"
                                                            onchange="showImg(this, 'preview')">
                                                        <img src="{{ $customer->getSign($customer->signature) }}"
                                                            id="preview" style="height: 20px; width: 20px;" alt="">
                                                        @error('signature')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="save" value="save" class="btn btn-primary">Save</button>
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
        $('#form').validate({
            rules: {
                first_name: {
                    required: true,
                    lettersonly: true,
                },
                middle_name: {
                    lettersonly: true,
                },
                last_name: {
                    required: true,
                    lettersonly: true,
                },
                gender: "required",
                age: {
                    required: true,
                    digits: true,
                    max: 100,
                },
                nationality: {
                    required: true,
                    lettersonly: true,
                },
                address: "required",
                contact_no: "required",
                occupation: {
                    required: true,
                    lettersonly: true,
                },
                relation: {
                    required: true,
                    lettersonly: true,
                },
                identity_no: "required",
                signature: {
                    accept: "image/*",
                    extension: "jpg|jpeg|png"
                },
            },
            messages: {
                first_name: {
                    required: "First Name is required",
                    lettersonly: "Only alphabets suppported",
                },
                last_name: {
                    required: "Surname is required",
                    lettersonly: "Only alphabets suppported",
                },
                gender: "Gender is required",
                age: {
                    required: "Age is required",
                    digits: "Age must be a number",
                    max: "Age must be between 0 and 100",
                },
                nationality: {
                    required: "Nationality is required"
                },
                address: "Address is required",
                contact_no: "Contact number is required",
                occupation: {
                    required: "Occupation is required",
                },
                identity_no: "Citizenship number is required",
                relation: {
                    required: "Relation field is required",
                },
                signature: {
                    accept: "Please upload a valid image",
                    extension: "Image must be of type jpg, jpeg, png",
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endsection
