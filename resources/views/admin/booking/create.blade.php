@extends('layouts.admin.app')
@section('title', 'Booking')
@section('booking', 'active')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gif.css') }}">
    <style>
        .ui-widget.ui-widget-content {
            border: 1px solid #ccc1c1;
        }
        

    </style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row col-12 mb-2">
                <div class="col-sm-6">
                    <h1>Add Booking</h1>
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
                            {{-- <div class="card-title"> --}}
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
                                    <a href="{{ route('admin.room.index') }}" class="btn btn-primary float-right"><i
                                            class="fa fa-arrow-left iCheck"></i>&nbsp;Back to List</a>
                                </div>
                            </div>
                            {{-- </div> --}}
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.booking.store') }}" method="POST" enctype="multipart/form-data"
                                id="form">
                                @csrf
                                <h3><u>{{ strtoupper('Customer Details') }}</u></h3>
                                <input type="hidden" class="form-control" name="customer_id" value="" id="client_id">
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
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-12">
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
                                            <div class="form-group">
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
                                        </div>
                                    </div>
                                </div>
                                <h3><u>{{ strtoupper('Booking Details') }}</u></h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="arrival_date">Arrival Date&nbsp;<span
                                                                class="req">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text"
                                                            onchange="engtonep($(this), 'nepali_arrival_date')"
                                                            name="arrival_date" value="{{ old('arrival_date') }}"
                                                            class="form-control" id="arrival_date"
                                                            title="Click on textbox to enter date" readonly>
                                                        <input type="hidden" name="nepali_arrival_date"
                                                            value="{{ old('nepali_arrival_date') }}" class="form-control"
                                                            id="nepali_arrival_date" readonly>
                                                        @error('arrival_date')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="arrival_time">Arrival Time&nbsp;<span
                                                                class="req">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="time" name="arrival_time"
                                                            value="{{ old('arrival_time') }}" class="form-control"
                                                            id="arrival_time">
                                                        @error('arrival_time')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="purpose">Purpose</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <textarea name="purpose" class="form-control"
                                                            style="width: 100%;">{{ old('purpose') }}</textarea>
                                                        @error('purpose')
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
                                                        <label for="departure_date">Departure Date&nbsp;<span
                                                                class="req">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text"
                                                            onchange="engtonep($(this), 'nepali_departure_date')"
                                                            name="departure_date" value="{{ old('departure_date') }}"
                                                            class="form-control" id="departure_date"
                                                            title="Click on textbox to enter date" readonly>
                                                        <input type="hidden" name="nepali_departure_date"
                                                            value="{{ old('nepali_departure_date') }}"
                                                            class="form-control" id="nepali_departure_date" readonly>
                                                        @error('departure_date')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="departure_time">Departure Time&nbsp;<span
                                                                class="req">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="time" name="departure_time"
                                                            value="{{ old('departure_time') }}" class="form-control"
                                                            id="departure_time">
                                                        @error('departure_time')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="remarks">Remarks</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <textarea name="remarks" class="form-control"
                                                            style="width: 100%;">{{ old('remarks') }}</textarea>
                                                        @error('remarks')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3><u>{{ strtoupper('Room Details') }}</u></h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="no_of_room">No of Rooms</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="no_of_rooms"
                                                            value="{{ old('no_of_rooms') }}"
                                                            onchange="onEnterRoomNo($(this))" class="form-control"
                                                            id="no_of_room" placeholder="Enter no of rooms">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="room_data">
                                                @if (old('room_no') != '')
                                                    @include('admin.partial.booking.redirectCreate')
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#arrival_date").datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                todayBtn: 'linked',
                clearBtn: true,
                autoclose: true,
            }).on('changeDate', function(selected) {
                var minDate = new Date(selected.date.valueOf());
                $('#departure_date').datepicker('setStartDate', minDate);
            });

            $("#departure_date").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                clearBtn: true,
            }).on('changeDate', function(selected) {
                var minDate = new Date(selected.date.valueOf());
                $('#arrival_date').datepicker('setEndDate', minDate);
            });
        });

        function onEnterRoomNo(room_no) {
            var no_of_room = $(room_no).val();
            var html = "";
            for (var i = 0; i < no_of_room; i++) {
                html += `<div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Select Room</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="room_no[]" class="form-control" id="room_no` + i + `">
                                            <option value="">Select Room</option>
                                            @foreach ($rooms as $room)
                                                <option value="{{ $room->id }}">{{ $room->name . '(' . $room->room_no . ')' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>`;
            }
            $(".room_data").html(html);
        }


        $('#form').validate({
            rules: {
                first_name: "required",
                last_name: "required",
                gender: "required",
                age: {
                    required: true,
                    digits: true,
                    max: 100,
                },
                nationality: "required",
                address: "required",
                contact_no: "required",
                occupation: "required",
                identity_no: "required",
                signature: {
                    accept: "image/*",
                    extension: "jpg|jpeg|png"
                },
                arrival_date: "required",
                arrival_time: "required",
                no_of_rooms: {
                    required: true,
                    digits: true,
                },
                "room_no[]": "required",

            },
            messages: {
                first_name: "First Name is required",
                last_name: "Surname is required",
                gender: "Gender is required",
                age: {
                    required: "Age is required",
                    digits: "Age must be a number",
                    max: "Age must be between 0 and 100",
                },
                nationality: "Nationality is required",
                address: "Address is required",
                contact_no: "Contact number is required",
                occupation: "Occupation is required",
                identity_no: "Citizenship number is required",
                signature: {
                    accept: "Please upload a valid image",
                    extension: "Image must be of type jpg, jpeg, png",
                },
                arrival_date: "Arrival date is required",
                arrival_time: "Arrival time is required",
                no_of_rooms: {
                    required: "Please enter no. of rooms",
                    digits: "This field must be number",
                },
                "room_no[]": "Please select room",

            },
            submitHandler: function(form) {
                form.submit();
            }
        });


        $("#search_user").autocomplete({
            source: function(data, cb) {
                console.log(data);
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
                        console.log(res);
                        if (res.length) {
                            var datas = $.map(res, function(value) {
                                return {
                                    label: value.first_name,
                                    id: value.id,
                                    // item_name: value.name,
                                    // stock: value.qty,
                                    // barcode: value.barcode,
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
                    $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', el);
                    $(this).autocomplete("close");

                }
                $('.spinner').hide();
                // console.log('hiding');
            },


            select: function(e, ui) {
                console.log(ui);
                e.preventDefault();
                if (typeof ui.content != 'undefined') {
                    if (isNaN(ui.content[0].id)) {
                        return;
                    }
                    var stock = ui.content[0].stock;
                    var item_id = ui.content[0].id;
                } else {
                    var stock = ui.item.stock;
                    var item_id = ui.item.id;
                }

                $("input#search_user").val('');
            },

        });

        $("#search_user").bind('paste', (e) => {
            $("#search_user").autocomplete('search');
        });
    </script>
@endsection
