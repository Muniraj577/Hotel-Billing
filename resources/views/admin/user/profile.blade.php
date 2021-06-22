@extends('layouts.admin.app')
@section('title', 'User')
@section('user', 'active')
@section('content')
    <style>
        .form-control {
            padding: .175rem .75rem;
        }

    </style>
    <?php $admin = getAdmin(); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('images/admin/avatars/' . $admin->avatar) }}" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center"><i class="fas fa-user"></i> {{ $admin->name }}
                            </h3>
                            <p class="text-center"><i class="fas fa-envelope"></i> {{ $admin->email }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a
                                        class="nav-link {{ $errors->has('current_password') || $errors->has('password') ? 'active' : '' }}"
                                        href="#change-password" data-toggle="tab">Change Password</a></li>
                                <li class="nav-item"><a class="nav-link {{ $errors->has('email') ? 'active' : '' }}"
                                        href="#change-email" data-toggle="tab">Change
                                        Email</a></li>
                                <li class="nav-item"><a class="nav-link{{ $errors->has('image') ? 'active' : '' }}"
                                        href="#change-image" data-toggle="tab">Change
                                        Image</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane {{ $errors->has('current_password') || $errors->has('password') ? 'active' : '' }}"
                                    id="change-password">
                                    <form class="form-horizontal" method="POST"
                                        action="{{ route('admin.adminNewPassword') }}">
                                        @csrf
                                        {{-- @foreach ($errors->all() as $error)
                                            <p class="text-danger">{{ $error }}</p>
                                        @endforeach --}}
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-2 col-form-label">Current
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="password"
                                                    name="current_password" autocomplete="current-password">
                                                @error('current_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="new_password" class="col-sm-2 col-form-label">New
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="password">
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Confirm New
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="password_confirmation">
                                            </div>
                                        </div>
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane {{ $errors->has('email') ? 'active' : '' }}" id="change-email">
                                    <form class="form-horizontal" method="POST"
                                        action="{{ route('admin.changeAdminEmail') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="email" placeholder="Email"
                                                    value="{{ $admin->email }}" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">New Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" name="email" id="email"
                                                    placeholder="Enter your new email">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane {{ $errors->has('image') ? 'active' : '' }}" id="change-image">
                                    <form class="form-horizontal" method="POST"
                                        action="{{ route('admin.chageAdminAvatar') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="image" class="col-sm-2 col-form-label">Choose Image:</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control" name="image" id="img">
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <img id="imgPreview" src="{{ asset('images/admin/avatars/' . $admin->avatar) }}"
                                                alt="" style="width: 100px; height: 100px;">

                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
