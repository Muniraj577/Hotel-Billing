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
                                <a href="{{ route('admin.room.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add Room
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="Room" class="table text-center">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Name</th>
                                        <th>Room No</th>
                                        <th>Price</th>
                                        <th>Is Active</th>
                                        <th>Status</th>
                                        <th class="hidden">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rooms as $key => $room)

                                        <tr>
                                            <td>{{ ++$id }}</td>
                                            
                                            <td>{{ $room->name }}</td>
                                            <td>{{ $room->room_no }}</td>
                                            <td>{{ $room->price }}</td>
                                            <td>
                                                {{ $room->is_active ? 'Active' : 'Inactive' }}
                                            </td>
                                            <td>
                                                {{ $room->status }}
                                            </td>
                                            <td>
                                                <div class="d-inline-flex">
                                                    <a href="{{ route('admin.room.edit', $room->id) }}"
                                                        class="btn btn-sm btn-primary" title="Edit Room">
                                                        <i class="fa fa-edit iCheck"></i> Edit
                                                    </a>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')

    <script>
        $(document).ready(function() {
            $("#Room").DataTable({
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
                       extend:'colvis',
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
