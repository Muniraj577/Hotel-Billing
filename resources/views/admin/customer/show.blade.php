@extends('layouts.admin.app')
@section('title', 'Customer')
@section('customer', 'active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row col-12 mb-2">
                <div class="col-sm-6">
                    <h1>Customer Details</h1>
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
                                <a href="{{ route('admin.customer.index') }}" class="btn btn-primary float-right"><i
                                        class="fa fa-arrow-left iCheck"></i>&nbsp;Back to List</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3><u>{{ strtoupper('Customer Details') }}</u></h3>
                            <input type="hidden" class="form-control" name="customer_id" id="client_id">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="first_name">Name: </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $customer->full_name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="gender">Gender:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $customer->gender }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="age">Age:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $customer->age }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="nationality">Nationality:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $customer->nationality }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="address">Address:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $customer->address }}</span>
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
                                                    <label for="contact_no">Contact No:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $customer->contact_no }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="occupation">Occupation:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $customer->occupation }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="identity_no">Citizenship No:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $customer->identity_no }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="driving_license_no">Driving License No:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $customer->driving_license_no }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
