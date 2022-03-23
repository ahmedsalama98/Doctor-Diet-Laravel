@extends('admin.layouts.master')

@section('content')


    <div class="container">



        <div class=" row align-items-center justify-content-center">
            <div class="col-md-6">

                <h1>{{__('site.change_password')}}</h1>

                <form action="{{ route('dashboard.account.update.password') }}"  class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')


                  {{-- old_password --}}
                    <div class="row align-items-center ">
                        <div class="col-md-2">

                            <label for="old_password">{{__('site.old_password')}}</label>
                        </div>
                        <div class="col-md-10">

                            <input type="password" id='old_password' name="old_password" class="form-control @error('old_password') is-invalid @enderror">
                        </div>
                        @error('old_password')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- old_password --}}


                  {{-- new_password --}}
                    <div class="row align-items-center ">
                        <div class="col-md-2">

                            <label for="new_password">{{__('site.new_password')}}</label>
                        </div>
                        <div class="col-md-10">

                            <input type="password" id='new_password' name="new_password" class="form-control @error('new_password') is-invalid @enderror">
                        </div>
                        @error('new_password')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- new_password --}}


                  {{-- new_password_confirmation --}}
                    <div class="row align-items-center ">
                        <div class="col-md-2">

                            <label for="new_password_confirmation">{{__('site.new_password_confirmation')}}</label>
                        </div>
                        <div class="col-md-10">

                            <input type="password" id='new_password_confirmation' name="new_password_confirmation" class="form-control @error('new_password_confirmation') is-invalid @enderror">
                        </div>
                        @error('new_password_confirmation')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- new_password_confirmation --}}





                    <div class="row align-items-center ">

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">{{ __('site.update') }}</button>

                        </div>

                    </div>


                </form>

            </div>
        </div>










    </div>
@endsection
