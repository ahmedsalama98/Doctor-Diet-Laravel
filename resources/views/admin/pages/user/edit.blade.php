@extends('admin.layouts.master')

@section('content')


    <div class="container">



        <div class=" row align-items-center justify-content-center">
            <div class="col-md-6">

                <h1>{{__('site.edit_user')}}</h1>

                <form action="{{ route('admin.users.update',$user->id) }}" action="" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    {{-- name --}}
                    <div class="row align-items-center ">
                        <div class="col-md-2">

                            <label for="name">{{__('site.name')}}</label>
                        </div>
                        <div class="col-md-10">

                            <input value="{{ $user->name }}" type="text" id='name' name="name" class="form-control @error('name') is-invalid @enderror">
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

                            <input type="email" value="{{ $user->email }}" id='email' name="email" class="form-control @error('email') is-invalid @enderror">
                        </div>
                        @error('email')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- email --}}



                    {{-- status --}}
                    <div class="row align-items-center">
                        <div class="col-md-2">

                            <label for="status">{{__('site.status')}}</label>
                        </div>
                        <div class="col-md-10">

                            <select class="form-select @error('status') is-invalid @enderror" aria-label="Default" name="status">
                                <option @if($user->status ==1) selected @endif value="1">{{__('site.active')}}</option>
                                <option  @if($user->status ==0) selected @endif value="0">{{__('site.inactive')}}</option>
                            </select>
                        </div>
                        @error('status')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- status --}}

                    {{-- gender --}}
                    <div class="row align-items-center">
                        <div class="col-md-2">

                            <label for="gender">{{__('site.gender')}}</label>
                        </div>
                        <div class="col-md-10">

                            <select class="form-select @error('gender') is-invalid @enderror" aria-label="Default" name="gender">
                                <option @if($user->gender ==0) selected @endif  value="0">{{__('site.male')}}</option>
                                <option  @if($user->gender ==1) selected @endif value="1">{{__('site.female')}}</option>
                                <option  @if(!isset($user->gender)) selected @endif value="">{{__('site.another_thing')}}</option>
                            </select>
                        </div>
                        @error('gender')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>


                        @enderror
                    </div>
                    {{-- gender --}}


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
