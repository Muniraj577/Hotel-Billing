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
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">CPU Traffic</span>
                            <span class="info-box-number">
                                10
                                <small>%</small>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Likes</span>
                            <span class="info-box-number">41,410</span>
                        </div>
                    </div>
                </div>
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Sales</span>
                            <span class="info-box-number">760</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">New Members</span>
                            <span class="info-box-number">2,000</span>
                        </div>
                    </div>
                </div>
            </div>
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
                                                    <div class="{{ $room->status == 'Available' ? 'bgcolor1' : 'bgcolor' }} bstyle">
                                                        <h5 @if($room->status == 'UnAvailable') style="cursor:pointer;" onclick="showDetailModal({{ $room->id }});" @endif>{{ $room->room_no }}</h5>
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
                                    <h6 class="pl-2">Available</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    <h5 class="bgcolor design"></h5>
                                </div>
                                <div class="col-md-11 my-auto">
                                    <h6 class="pl-2">Not Available</h6>
                                </div>
                            </div>

                        </div>
                    </div>
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
    function showDetailModal(room_id){
        $.ajax({
            url: "{{ route('admin.getCustomerDetails') }}",
            type: "POST",
            data: {"room_id" : room_id},
            success: function(data){
                $("#exampleModal").modal("show");
                $(".customerModal").html(data);
            }
        });
        
    }
</script>
@endsection
