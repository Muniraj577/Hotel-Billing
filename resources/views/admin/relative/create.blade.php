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
                    <h1>Add Relative</h1>
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
                            <div class="row">
                                <div class="col-md-5 my-auto">
                                    <div class="input-group inputcontainer">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bar-input" id="basic-addon1"><i
                                                    class="fa fa-user barcode"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Search by user name or phone"
                                            id="search_user" value="">
                                        <div class="spinner">
                                            <div class="rect1"></div>
                                            <div class="rect2"></div>
                                            <div class="rect3"></div>
                                            <div class="rect4"></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-7 my-auto float-right">
                                    <a href="{{ route('admin.booking.show', $booking_detail->id) }}"
                                        class="btn btn-primary float-right"><i
                                            class="fa fa-arrow-left iCheck"></i>&nbsp;Back to List</a>
                                </div>
                            </div>
                            {{-- <div class="card-title float-right">
                            <a href="{{ route('admin.booking.show', $booking_detail->id) }}" class="btn btn-primary float-right"><i
                                            class="fa fa-arrow-left iCheck"></i>&nbsp;Back to Booking Detail</a>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.relative.store', $booking_detail->id) }}" method="POST"
                                enctype="multipart/form-data" id="form">
                                @csrf
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
                                                            value="{{ old('first_name') }}" class="form-control"
                                                            placeholder="Enter First Name" id="firstName">
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
                                                            value="{{ old('middle_name') }}" class="form-control"
                                                            placeholder="Enter Middle Name" id="middleName">
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
                                                        <input type="text" name="last_name" value="{{ old('last_name') }}"
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
                                                                {{ old('gender') == 'Male' ? 'selected' : '' }}>Male
                                                            </option>
                                                            <option value="Female"
                                                                {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                                                            </option>
                                                            <option value="Other"
                                                                {{ old('gender') == 'Other' ? 'selected' : '' }}>Other
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
                                                        <input type="text" name="age" value="{{ old('age') }}"
                                                            class="form-control" id="age">
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
                                                            value="{{ old('nationality') }}" class="form-control"
                                                            id="nationality">
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
                                                        <input type="text" name="address" value="{{ old('address') }}"
                                                            class="form-control" id="address">
                                                        @error('address')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="contact_no">Contact No&nbsp;<span
                                                                class="req">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="contact_no"
                                                            value="{{ old('contact_no') }}" class="form-control"
                                                            id="contact_no">
                                                        @error('contact_no')
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
                                                        <label for="occupation">Occupation&nbsp;<span
                                                                class="req">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="occupation"
                                                            value="{{ old('occupation') }}" class="form-control"
                                                            id="occupation">
                                                        @error('occupation')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="identity_id">Identity Type&nbsp;<span
                                                                class="req">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select name="identity_id" class="form-control" id="identity_id">
                                                            <option value="">Select Identity Type</option>
                                                            @foreach ($identities as $key => $identity)
                                                                <option value="{{ $identity->id }}"
                                                                    {{ $identity->id == old('identity_id') ? 'selected' : '' }}>
                                                                    {{ $identity->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('identity_id')
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
                                                            value="{{ old('identity_no') }}" class="form-control"
                                                            id="identity">
                                                        @error('identity_no')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="driving_license_no">Driving License No</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="driving_license_no"
                                                            value="{{ old('driving_license_no') }}" class="form-control"
                                                            placeholder="Enter Driving License number" id="license">
                                                        @error('driving_license_no')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="relation">Relation&nbsp;<span
                                                                class="req">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="relation" value="{{ old('relation') }}"
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
                                                        <img src="#" id="preview" alt="">
                                                        @error('signature')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="profile_pic">Upload Profile Photo</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="file" name="profile_pic" class="form-control"
                                                            onchange="showImg(this, 'prfview')">
                                                        <img src="#" id="prfview" alt="">
                                                        @error('profile_pic')
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
                                    <button type="submit" name="save" value="save_and_continue" class="btn btn-primary">Save
                                        and Add Another</button>
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
                identity_id: "required",
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
                contact_no: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 13
                },
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
                profile_pic: {
                    accept: "image/*",
                    extension: "jpg|jpeg|png"
                },
            },
            messages: {
                identity_id: "Identity Type is required",
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
                contact_no: {
                    required: "Contact number is required",
                    digits: "Contact number must contain only numeric value",
                    minlength: "Contact number must have at least 10 digits",
                    maxlength: "The phone length must not be greater than 13",
                },
                occupation: {
                    required: "Occupation is required",
                },
                identity_no: "Identity number is required",
                relation: {
                    required: "Relation field is required",
                },
                signature: {
                    accept: "Please upload a valid image",
                    extension: "Image must be of type jpg, jpeg, png",
                },
                profile_pic: {
                    accept: "Please upload a valid image",
                    extension: "Image must be of type jpg, jpeg, png",
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });


        $("#search_user").autocomplete({
            source: function(data, cb) {
                $.ajax({
                    url: "{{ route('admin.getCustomer') }}",
                    type: "POST",
                    data: {
                        'keyword': data.term
                    },
                    dataType: 'json',
                    autoFocus: true,
                    showHintOnFocus: true,
                    autoSelect: true,
                    selectInitial: true,

                    success: function(res) {
                        if (res.length) {
                            var datas = $.map(res, function(value) {
                                return {
                                    label: value.first_name + "(" + value.contact_no + ")",
                                    id: value.id,
                                    identity_id: value.identity_id,
                                    first_name: value.first_name,
                                    middle_name: value.middle_name,
                                    last_name: value.last_name,
                                    gender: value.gender,
                                    age: value.age,
                                    nationality: value.nationality,
                                    address: value.address,
                                    contact_no: value.contact_no,
                                    occupation: value.occupation,
                                    identity: value.identity_no,
                                    license: value.driving_license_no,
                                    sign: value.signature,
                                }
                            });
                        } else {

                            $('.spinner').hide();
                        }
                        cb(datas);

                    },
                    error: function() {
                        $('.spinner').hide();
                    },

                });
            },
            search: function(e, ui) {
                $('.spinner').show();



            },
            response: function(e, el) {
                if (el.content == undefined) {
                    // console.log('no data found');
                } else if (el.content.length == 1) {
                    // $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', el);
                    // $(this).autocomplete("close");

                }
                $('.spinner').hide();
                // console.log('hiding');
            },


            select: function(e, ui) {
                console.log(typeof ui.content);
                e.preventDefault();
                if (typeof ui.content != 'undefined') {
                    if (isNaN(ui.content[0].id)) {
                        return;
                    }
                    var cus_id = ui.content[0].id,
                        identity_id = ui.content[0].identity_id,
                        first_name = ui.content[0].first_name,
                        middle_name = ui.content[0].middle_name,
                        last_name = ui.content[0].last_name,
                        gender = ui.content[0].gender,
                        age = ui.content[0].age,
                        nationality = ui.content[0].nationality,
                        address = ui.content[0].address,
                        contact_no = ui.content[0].contact_no,
                        occupation = ui.content[0].occupation,
                        identity = ui.content[0].identity,
                        license = ui.content[0].license,
                        sign = ui.content[0].sign;
                } else {
                    console.log(ui.item);
                    var cus_id = ui.item.id,
                        identity_id = ui.item.identity_id,
                        first_name = ui.item.first_name,
                        middle_name = ui.item.middle_name,
                        last_name = ui.item.last_name,
                        gender = ui.item.gender,
                        age = ui.item.age,
                        nationality = ui.item.nationality,
                        address = ui.item.address,
                        contact_no = ui.item.contact_no,
                        occupation = ui.item.occupation,
                        identity = ui.item.identity,
                        license = ui.item.license,
                        sign = ui.item.sign;

                }

                // set value

                set_values(cus_id, identity_id, first_name, middle_name, last_name, gender, age,
                    nationality, address, contact_no, occupation, identity, license,
                    sign);

                $("input#search_user").val('');
            },

        });

        $("#search_user").bind('paste', (e) => {
            $("#search_user").autocomplete('search');
        });

        function set_values(customer_id, identity_id, fname, midname, lname, gender, age, nationality, address, contact_no, occupation,
            identity,
            license, sign) {
            $("#client_id").val(customer_id);
            $("#identity_id").val(identity_id);
            $("#firstName").val(fname);
            $("#middleName").val(midname);
            $("#surName").val(lname);
            $("#gender").val(gender);
            $("#age").val(age);
            $("#nationality").val(nationality);
            $("#address").val(address);
            $("#contact_no").val(contact_no);
            $("#occupation").val(occupation);
            $("#identity").val(identity);
            $("#license").val(license);
        }
    </script>
@endsection
