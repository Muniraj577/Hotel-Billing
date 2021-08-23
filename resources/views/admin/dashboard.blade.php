@extends('layouts.admin.app')
@section('title', 'Dashboard')
@section('dashboard', 'active')
@section('content')
    <style>
        table td,
        th {
            padding: 15px 15px !important;
        }

        .color {
            background-color: red;
            color: #fff;
        }

        .doughnut .card{
            border-top: 2px solid #00a65a !important;
        }

        .info-box {
            box-shadow: 0 0.46875rem 2.1875rem rgb(4 9 20 / 3%), 0 0.9375rem 1.40625rem rgb(4 9 20 / 3%), 0 0.25rem 0.53125rem rgb(4 9 20 / 5%), 0 0.125rem 0.1875rem rgb(4 9 20 / 3%);
            transition: all .2s;
        }

        .info-box {
            min-height: 0;
            padding: 0 !important;
        }

        .info-box-icon {
            border-radius: 0 !important;
            display: block;
            float: left;
            height: 80px;
            width: 90px;
            text-align: center;
            font-size: 45px;
            line-height: 80px;
            background: rgba(0, 0, 0, 0.2);
        }

        .info-box .info-box-text {
            text-transform: uppercase !important;
        }

    </style>
    <style>
        .bgcolor {
            background-color: #d00000;
            color: #fff;
            padding: 8px;
        }

        .bgcolor1 {
            background-color: #00b70c;
            color: #fff;
            padding: 8px;
        }

        .bstyle h5 {
            margin-bottom: 0;
            text-align: center;
            font-size: 16px;
            line-height: 1;
        }

        .paddingcol .col-md-2 {
            padding-right: 5px;
            padding-left: 5px;
        }

        .design {
            height: 30px;
            width: 30px;
        }

        .main {
            padding: 30px 40px 30px 30px;
        }

        .main1 {
            padding: 30px;
        }

    </style>
    <div class="content mt-3">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="card create-card">
                        <div class="card-body">
                            <button class="btn btn-primary">Dashboard</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card rounded-0 bg-light">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7 border-right main">
                            @foreach ($room_types as $room_type)
                                <div class="row">
                                    <div class="col-md-2 my-auto">
                                        <h6>{{ $room_type->name }}</h6>
                                    </div>
                                    <div class="col-md-10 paddingcol">
                                        <div class="row">
                                            @foreach ($room_type->rooms as $key => $room)
                                                <div class="col-md-2 mb-2">
                                                    <div
                                                        class="{{ $room->status == 'Available' ? 'bgcolor1' : 'bgcolor' }} bstyle">
                                                        <h5 @if ($room->status == 'UnAvailable') style="cursor:pointer;" onclick="showDetailModal({{ $room->id }});" @endif>{{ $room->room_no }}</h5>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @if (!$loop->last)
                                    <hr class="mb-4" />
                                @endif
                            @endforeach
                        </div>
                        <div class="col-md-5 main1">
                            <div class="row">
                                <div class="col-md-1">
                                    <h5 class="bgcolor1 design"></h5>
                                </div>
                                <div class="col-md-11 my-auto">
                                    <h6 class="pl-2">Available ({{ $available_room }})</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    <h5 class="bgcolor design"></h5>
                                </div>
                                <div class="col-md-11 my-auto">
                                    <h6 class="pl-2">Not Available ({{ $unavailable_room }})</h6>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 doughnut">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-pie-chart"></i>&nbsp;Data Analysis</div>
                        <div class="card-body">
                            <canvas id="chartData"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                    <div class="info-box rounded-0 bg-info"
                        onclick="window.open('{{ route('admin.booking.index') }}', '_self')">
                        <span class="info-box-icon elevation-1"><i class="fas fa-calendar-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Active Booking</span>
                            <span class="info-box-number">
                                {{ $activeBook }}
                            </span>
                        </div>
                    </div>


                    <div class="info-box bg-danger mb-3" onclick="window.open('{{ route('admin.booking.index') }}', '_self')">
                        <span class="info-box-icon elevation-1"><i class="fas fa-calendar-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Inactive Booking</span>
                            <span class="info-box-number">{{ $inactiveBook }}</span>
                        </div>
                    </div>

                    <div class="clearfix hidden-md-up"></div>


                    <div class="info-box bg-success mb-3" onclick="window.open('{{ route('admin.customer.index') }}', '_self')">
                        <span class="info-box-icon elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Customers</span>
                            <span class="info-box-number">{{ $totalCustomer }}</span>
                        </div>
                    </div>


                    <div class="info-box bg-warning mb-3" onclick="window.location = '{{ route('admin.room.index') }}'">
                        <span class="info-box-icon elevation-1"><i class="fa fa-dungeon"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Rooms</span>
                            <span class="info-box-number">{{ $totalRoom }}</span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <canvas id="getBooking"></canvas>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <canvas id="monthlyBooking"></canvas>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Customer Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body customerModal">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        function showDetailModal(room_id) {
            $.ajax({
                url: "{{ route('admin.getCustomerDetails') }}",
                type: "POST",
                data: {
                    "room_id": room_id
                },
                success: function(data) {
                    $("#exampleModal").modal("show");
                    $(".customerModal").html(data);
                }
            });

        }

        $(document).ready(function() {
            let chartUrl = "{{ route('admin.chartData') }}";
            var label_name = new Array();
            var label_data = new Array();
            $.get(chartUrl, function(response) {
                $.each(response, function(key, value) {
                    label_name.push(key);
                    label_data.push(value);
                });
                var optionColor = ["red", "green", "orange", "blue", "pink", "grey"];
                var ctx = document.getElementById('chartData').getContext('2d');
                var chartData = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: label_name,
                        datasets: [{
                            label: 'Total data',
                            data: label_data,
                            backgroundColor: optionColor,
                        }],
                    },
                    options: {
                        responsive: true,
                        legend: {
                            position: 'right',
                            labels: {
                                fontSize: 16,
                                fontColor: "black",
                                boxWidth: 25,
                                padding: 15,
                            }
                        }
                    },
                });
            });
        });

        $(document).ready(function() {
            const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
            ];
            let url = "{{ route('admin.getMonthlyBooking') }}";
            let year;
            let Datee = new Array();
            let monthName = new Array();
            let Count = new Array();
            $.get(url, function(response) {
                $.each(response, function(key, value) {
                    // console.log(key + '=' + value);
                    let date = new Date(key);
                    monthName.push(monthNames[date.getMonth()] + ' ' + date.getDate());
                    year = date.getFullYear();
                    Datee.push(key);
                    Count.push(value);
                });
                var ctx = document.getElementById('monthlyBooking');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: monthName,
                        datasets: [{
                            label: 'Daywise Monthly Bookings',
                            data: Count,
                            backgroundColor: [
                                'pink',

                            ],
                            borderWidth: 2,
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            })
        });


        $(document).ready(function() {
            const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
            ];
            let url = "{{ route('admin.getBooking') }}";
            let year;
            let Datee = new Array();
            let monthName = new Array();
            let Count = new Array();
            $.get(url, function(response) {
                $.each(response, function(key, value) {
                    // console.log(key + '=' + value);
                    let date = new Date(key);
                    monthName.push(monthNames[date.getMonth()]);
                    year = date.getFullYear();
                    Datee.push(key);
                    Count.push(value);
                });
                var ctx = document.getElementById('getBooking');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: monthName,
                        datasets: [{
                            label: 'Monthly Bookings '+(new Date).getFullYear(),
                            data: Count,
                            backgroundColor: [
                                'green',

                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            })
        });
    </script>
@endsection
