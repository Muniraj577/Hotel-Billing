@extends('layouts.admin.app')
@section('title', 'Booking')
@section('add-booking', 'active')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gif.css') }}">
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
                                    <a href="{{ route('admin.booking.index') }}" class="btn btn-primary float-right"><i
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
                                                        {{-- <div class="input-group bootstrap-timepicker timepicker">
                                                            <input id="timepicker1" type="text" class="form-control input-small">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                                        </div> --}}
                                                        <input type="text" name="arrival_time" onfocus="timepick($(this));"
                                                            value="{{ old('arrival_time') }}" class="form-control"
                                                            id="arrival_time" readonly>
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
                                                        <label for="departure_date">Departure Date</label>
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
                                                        <label for="departure_time">Departure Time</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="departure_time"
                                                            onfocus="timepick($(this));"
                                                            value="{{ old('departure_time') }}" class="form-control"
                                                            id="departure_time" readonly>
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
                                                        <label for="no_of_room">No of Rooms&nbsp;<span
                                                                class="req">*</span></label>
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
                                <h3><u>{{ strtoupper('Relatives') }}</u></h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="no_of_relatives">No of Relatives</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="no_of_relatives"
                                                            value="{{ old('no_of_relatives') }}"
                                                            onchange="addRelative($(this))" class="form-control"
                                                            id="no_of_relative" placeholder="Enter no of relatives">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row relativeTable d-none">
                                    <div class="col-md-12">
                                        <div>
                                            <button class="btn btn-primary float-right" type="button"
                                                onclick="addRow();">Add</button>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <th>First Name</th>
                                                    <th>Middle Name</th>
                                                    <th>Last Name</th>
                                                    <th>Phone no</th>
                                                    <th>Gender</th>
                                                    <th style="width: 10%;">Age</th>
                                                    <th>Relation</th>
                                                    <th>Action</th>
                                                </thead>
                                                <tbody class="relative_data">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="save" value="save" class="btn btn-primary">Save</button>
                                    <button type="submit" name="save" value="save_and_add_relative"
                                        class="btn btn-primary">Save and Add Relative</button>
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


            // $(".timepicker").timepicker({
            //     minuteStep: 1,
            //     icons: {
            //         up: 'fa fa-chevron-up',
            //         down: 'fa fa-chevron-down'
            //     }
            // });



        });

        let selectedList = [];

        // function onRoomChange(this_room) {
        //     var $selects = $(".no_of_room");
        //     var $select = $(this_room),
        //         $options = $selects.not($select).find('option'),
        //         selectedValue = $select.children('option:selected').val();
        //     console.log(selectedValue);
        //     var $optionsToDisable = $options.filter(function() {
        //         return $(this).val() == selectedValue && $(this).val() != '';
        //     });
        //     $optionsToDisable.prop("disabled", true);
        //     // $optionsToDisable.hide();
        // }

        function onRoomChange() { // Working code;
            updateSelectedList();
            disableAlreadySelected();
        }

        function updateSelectedList() {
            selectedList = [];
            let selectedValue;
            $('.no_of_room').each(function() {
                selectedValue = $(this).find('option:selected').val();
                if (selectedValue != "" && $.inArray(selectedValue, selectedList) == "-1") {
                    selectedList.push(selectedValue);
                }
            });
        }

        function disableAlreadySelected() {
            $('.no_of_room option').each(function() {
                if ($.inArray(this.value, selectedList) != "-1") {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        }

        function onEnterRoomNo(room_no) {
            var count_room = "{{ $countRoom }}";
            var no_of_room = $(room_no).val();
            console.log(count_room - no_of_room);
            console.log(count_room >= no_of_room);
            var html = "";
            if (no_of_room.match(/^\d+$/) && no_of_room != '') {
                if ((count_room - no_of_room) >= 0) {
                    for (var i = 0; i < no_of_room; i++) {
                        html +=
                            `<div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Select Room&nbsp;<span class="req">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="room_no[]" class="form-control no_of_room" onchange="onRoomChange();" id="room_no` +
                            i + `">
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
                    selectRefresh();
                } else {
                    $.alert({
                        title: "Alert !",
                        content: "No of room exceeds the room available",
                        icon: "fa fa-exclamationtriangle",
                        theme: "modern",
                    });
                }
            } else {
                $.alert({
                    title: "Alert !",
                    content: "Please enter only number",
                    icon: "fa fa-fa-exclamationtriangle",
                    theme: "modern",
                });
            }

        }


        function addRelative(relative_no) {
            $(".relativeTable").removeClass("d-none");
            var no_of_relative = $(relative_no).val();
            var html = "";
            for (var i = 0; i < no_of_relative; i++) {
                html += `<tr>
                            <td>
                                <input type="text" class="form-control" name="relative_first_name[]">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="relative_middle_name[]">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="relative_last_name[]">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="relative_contact_no[]">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="relative_gender[]">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="relative_age[]">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="relative_relation[]">
                            </td>
                            <td>
                                <div class="d-inline-flex">
                                    <button type="button" onclick="removeRow($(this));" class="btn btn-sm">
                                        <i class="fa fa-times req"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>`;
            }
            $(".relative_data").html(html);
        }


        function addRow() {
            let html = `<tr>
                            <td>
                                <input type="text" class="form-control" name="relative_first_name[]">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="relative_middle_name[]">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="relative_last_name[]">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="relative_contact_no[]">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="relative_gender[]">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="relative_age[]">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="relative_relation[]">
                            </td>
                            <td>
                                <div class="d-inline-flex">
                                    <button type="button" onclick="removeRow($(this));" class="btn btn-sm">
                                        <i class="fa fa-times req"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>`;
            $(".relative_data").append(html);
            var new_no_of_relative = parseInt($("#no_of_relative").val()) + 1;
            $("#no_of_relative").val(new_no_of_relative);
        }


        function removeRow(row) {
            $(row).closest("tr").remove();
            var new_no_of_relative = parseInt($("#no_of_relative").val()) - 1;
            $("#no_of_relative").val(new_no_of_relative);
            var no_of_relative = $("#no_of_relative").val();
            if (no_of_relative == 0) {
                $(".relativeTable").addClass("d-none");
                $("#no_of_relative").val('');
            }
        }


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
                "relative_first_name[]": {
                    required: function(element) {
                        return $("#no_of_relative").val() != '';
                    },
                    lettersonly: true,
                },
                "relative_middle_name[]": {
                    lettersonly: true,
                },
                "relative_last_name[]": {
                    required: function(element) {
                        return $("#no_of_relative").val() != '';
                    },
                    lettersonly: true,
                },
                "relative_gender[]": {
                    required: function(element) {
                        return $("#no_of_relative").val() != '';
                    },
                    lettersonly: true,
                },
                "relative_age[]": {
                    required: function(element) {
                        return $("#no_of_relative").val() != '';
                    },
                    digits: true,
                },
                "relative_relation[]": {
                    required: function(element) {
                        return $("#no_of_relative").val() != '';
                    },
                    lettersonly: true,
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
                
                contact_no: {
                    required: "Contact number is required",
                    digits: "Contact number must contain only numeric value",
                    minlength: "Contact number must have at least 10 digits",
                    maxlength: "The phone length must not be greater than 13",
                },
                occupation: {
                    required: "Occupation is required",
                },
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
                "relative_first_name[]": {
                    required: "This field is required",
                },
                "relative_last_name[]": {
                    required: "This field is required",
                },
                "relative_gender[]": {
                    required: "This field is required",
                },
                "relative_age[]": {
                    required: "This field is required",
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

                set_values(cus_id, first_name, middle_name, last_name, gender, age,
                    nationality, address, contact_no, occupation, identity, license,
                    sign);

                $("input#search_user").val('');
            },

        });

        $("#search_user").bind('paste', (e) => {
            $("#search_user").autocomplete('search');
        });

        function set_values(customer_id, fname, midname, lname, gender, age, nationality, address, contact_no, occupation,
            identity,
            license, sign) {
            $("#client_id").val(customer_id);
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
