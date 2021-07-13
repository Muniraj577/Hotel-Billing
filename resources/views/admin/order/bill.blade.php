@extends('layouts.admin.app')
@section('title', 'Order Bill')
@section('bills', 'active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row col-12 mb-2">
                <div class="col-sm-6">
                    <h1>Order Bill</h1>
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
                                {{-- <a href="{{ route('admin.order.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add Order
                                </a> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="Order" class="table text-center">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Room</th>
                                        <th>Total</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th class="hidden">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rooms as $key => $room)
                                        <?php $room_orders = App\Models\Order::where('status',
                                        'Unpaid')->count(); ?>
    
                                        @if($room_orders > 0)
                                            <?php
                                            $orders = [];
                                            $paid = [];
                                            $due = [];
                                            foreach ($room->orders->where('status', 'Unpaid') as $order) {
                                            $orders[] = $order;
                                            }

                                            foreach ($orders as $key => $order) {
                                            $paid[] = $order->totalPaid();
                                            $due[] = $order->totalDue();
                                            
                                            }

                                            $paid = array_sum($paid);
                                            $due = array_sum($due);
                                            ?>
                                            <tr>
                                                <td>{{ ++$id }}</td>
                                                <td>{{ $room->name }}</td>
                                                <td>{{ $room->totalAmount() }}</td>
                                                <td>{{ $paid }}</td>
                                                <td>{{ $due }}</td>
                                                <td>
                                                    <div class="d-inline-flex">
                                                        <form action="{{ route('admin.order.bill.markpaid') }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" class="form-control" name="paid"
                                                                value="{{ $due }}">
                                                            <input type="hidden" class="form-control" name="room_id"
                                                                value="{{ $room->id }}">
                                                            <button type="submit" class="btn btn-sm btn-primary">Mark as
                                                                Paid</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
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
            $("#Order").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "dom": 'lBfrtip',
                "buttons": [{
                        extend: 'collection',
                        text: "<i class='fa fa-ellipsis-v'></i>",
                        buttons: [{
                                extend: 'copy',
                                exportOptions: {
                                    columns: 'th:not(:last-child)'
                                }
                            },
                            {
                                extend: 'csv',

                                exportOptions: {
                                    columns: 'th:not(:last-child)'
                                }
                            },
                            {
                                extend: 'excel',

                                exportOptions: {
                                    columns: 'th:not(:last-child)'
                                }
                            },
                            {
                                extend: 'pdf',

                                exportOptions: {
                                    columns: 'th:not(:last-child)'
                                }
                            },
                            {
                                extend: 'print',

                                exportOptions: {
                                    columns: 'th:not(:last-child)'
                                },

                            },
                        ],

                    },
                    {
                        extend: 'colvis',
                        columns: ':not(.hidden)'
                    }
                ],
                "language": {
                    "infoEmpty": "No entries to show",
                    "emptyTable": "No data available",
                    "zeroRecords": "No records to display",
                }
            });
            dataTablePosition();
        });
    </script>
@endsection
