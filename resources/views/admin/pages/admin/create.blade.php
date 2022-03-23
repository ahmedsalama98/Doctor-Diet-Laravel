@extends('admin.layouts.master')

@section('content')


    <div class="container">



        <div class=" row align-items-center justify-content-center">
            <div class="col-md-6">

                <h1>{{__('site.create_new_admin')}}</h1>

                <form action="{{ route('admin.admins.store') }}" action="" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    {{-- name --}}
                    <div class="row align-items-center ">
                        <div class="col-md-2">

                            <label for="name">{{__('site.name')}}</label>
                        </div>
                        <div class="col-md-10">

                            <input value="{{ old('name') }}" type="text" id='name' name="name" class="form-control @error('name') is-invalid @enderror">
                        </div>
                        @error('name')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- name --}}


                    {{-- email --}}
                    <div class="row align-items-center ">
                        <div class="col-md-2">

                            <label for="email">{{__('site.email')}}</label>
                        </div>
                        <div class="col-md-10">

                            <input type="email" value="{{ old('email') }}" id='email' name="email" class="form-control @error('email') is-invalid @enderror">
                        </div>
                        @error('email')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- email --}}

                    {{-- role --}}
                    <div class="row align-items-center">
                        <div class="col-md-2">

                            <label for="role">{{__('site.role')}}</label>
                        </div>
                        <div class="col-md-10">

                            <select class="form-select @error('role') is-invalid @enderror" aria-label="Default" name="role">
                                <option selected value="admin">{{__('site.admin')}}</option>
                                <option value="moderator">{{__('site.moderator')}}</option>
                            </select>
                        </div>
                        @error('role')
                        <div class="col-12 text-danger ">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- role --}}

                    {{-- status --}}
                    <div class="row align-items-center">
                        <div class="col-md-2">

                            <label for="status">{{__('site.status')}}</label>
                        </div>
                        <div class="col-md-10">

                            <select class="form-select @error('status') is-invalid @enderror" aria-label="Default" name="status">
                                <option selected value="1">{{__('site.active')}}</option>
                                <option value="0">{{__('site.inactive')}}</option>
                            </select>
                        </div>
                        @error('status')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- status --}}


                 {{-- image --}}
                    <div class="row align-items-center ">
                        <div class="col-md-2">

                            <label for="image">{{__('site.image')}}</label>
                        </div>
                        <div class="col-md-10">

                            <input type="file" id='image' name="image" class="form-control @error('image') is-invalid @enderror">
                        </div>
                        @error('image')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- image --}}


                  {{-- password --}}
                    <div class="row align-items-center ">
                        <div class="col-md-2">

                            <label for="password">{{__('site.password')}}</label>
                        </div>
                        <div class="col-md-10">

                            <input type="password" id='password' name="password" class="form-control @error('password') is-invalid @enderror">
                        </div>
                        @error('password')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- password --}}

                    {{-- password_confirmation --}}
                    <div class="row align-items-center ">
                        <div class="col-md-2">

                            <label for="password_confirmation">{{__('site.password_confirmation')}}</label>
                        </div>
                        <div class="col-md-10">

                            <input type="password" id='password_confirmation' name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                        </div>
                        @error('password_confirmation')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- password_confirmation --}}



                    <div class="row align-items-center ">

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">{{ __('site.create') }}</button>

                        </div>

                    </div>


                </form>

            </div>
        </div>










    </div>
@endsection
