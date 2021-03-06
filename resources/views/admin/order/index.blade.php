@extends('layouts.admin.app')
@section('title', 'Order')
@section('order', 'active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row col-12 mb-2">
                <div class="col-sm-6">
                    <h1>Order</h1>
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
                                <a href="{{ route('admin.order.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add Order
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="Order" class="table table-responsive-xl text-center">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Room</th>
                                        <th>Customer</th>
                                        <th>Total</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th class="hidden">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $order)
                                        <tr>
                                            <td>{{ ++$id }}</td>
                                            <td>{{ $order->room->name }}</td>
                                            <td>{{ $order->customer->full_name }}</td>
                                            <td>{{ $order->total }}</td>
                                            <td>{{ $order->paid ? $order->paid : 0 }}</td>
                                            <td>{{ $order->due }}</td>
                                            <td>
                                                {{-- <div class="d-inline-flex">
                                                    <a href="{{ route('admin.order.edit', $order->id) }}"
                                                        class="btn btn-sm btn-primary" title="Edit Order">
                                                        <i class="fa fa-edit iCheck"></i> Edit
                                                    </a>
                                                </div> --}}
                                                <div class='dropdown action_dropdown'>
                                                    <button class='action_button btn dropdown-toggle' type='button'
                                                        id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true'
                                                        aria-expanded='false'>
                                                        Action
                                                    </button>
                                                    <div class='dropdown-menu dropdown-menu-right'
                                                        aria-labelledby='dropdownMenuButton'>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.order.edit', $order->id) }}">
                                                            <i class="fa fa-edit iCheck"></i>&nbsp;Edit</a>
                                                        @if ($order->status == 'Unpaid')
                                                            <form action="{{ route('admin.order.markpaid', $order->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('put')
                                                                <button class="dropdown-item" type="submit">
                                                                    <i class="fa fa-check-circle"></i>&nbsp;Mark as Paid
                                                                </button>
                                                            </form>
                                                            @else
                                                            <button class="dropdown-item" type="button" onclick="alertPaid();">
                                                                <i class="fa fa-check-circle"></i>&nbsp;Mark as Paid
                                                            </button>
                                                        @endif
                                                    </div>

                                                </div>
                                            </td>
                                        </tr>
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
                "responsive": false,
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

        function alertPaid()
        {
            $.alert({
                title: "Alert !",
                content: "This order is already paid",
                icon: "fa fa-exclamation-triangle",
                theme: "modern",
            });
        }
    </script>
@endsection
