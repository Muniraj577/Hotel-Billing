<link rel="stylesheet" href="{{ asset('css/datepicker.min.css') }}">
<form action="{{ route('admin.booking.updateDeparture', $booking_detail->id) }}" id="departureForm">
<div class="col-md-12">
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label for="departure_date">Departure Date</label>
            </div>
            <div class="col-md-8">
                <input type="text" onchange="engtonep($(this), 'nepali_departure_date')" name="departure_date"
                    value="{{ old('departure_date', $booking_detail->departure_date) }}" class="form-control"
                    id="departure_date" title="Click on textbox to enter date" readonly>
                <input type="hidden" name="nepali_departure_date"
                    value="{{ old('nepali_departure_date', $booking_detail->nepali_departure_date) }}"
                    class="form-control" id="nepali_departure_date" readonly>
                <div class="require departure_date"></div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label for="departure_time">Departure Time</label>
            </div>
            <div class="col-md-8">
                <input type="text" onclick="timepick($(this));" name="departure_time"
                    value="{{ old('departure_time', $booking_detail->departure_time) }}" class="form-control"
                    id="departure_time">
                <div class="require departure_time"></div>
            </div>
        </div>
    </div>
</div>
</form>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script>
    $("#departure_date").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
        clearBtn: true,
        startDate: "0d",
    });
</script>
