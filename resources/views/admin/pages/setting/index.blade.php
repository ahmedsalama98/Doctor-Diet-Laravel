@extends('admin.layouts.master')

@section('content')


    <div class="container">



        <div class=" row align-items-center justify-content-center">
            <div class="col-md-10">

                <h1>{{__('site.settings')}}</h1>

                <form action="{{ route('admin.settings.update') }}" action="" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <h2>{{ __('site.general') }}</h2>

                    @foreach ($general_settings as $setting)
                    <div class="row align-items-center ">
                        <div class="col-md-2">

                            <label for="{{$setting->key}}">{{$setting->display_name}}</label>
                        </div>
                        <div class="col-md-10">

                            <input value="{{$setting->value}}" type="text" id='{{$setting->key}}' name="settings[{{$setting->key}}]" class="form-control @error('name_ar') is-invalid @enderror">
                        </div>
                        @error('settings.'.$setting->key)
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    @endforeach

                    <h2>{{ __('site.social_accounts') }}</h2>

                    @foreach ($social_accounts as $setting)
                    <div class="row align-items-center ">
                        <div class="col-md-2">

                            <label for="{{$setting->key}}">{{$setting->display_name}}</label>
                        </div>
                        <div class="col-md-10">

                            <input value="{{$setting->value}}" type="text" id='{{$setting->key}}' name="settings[{{$setting->key}}]" class="form-control @error('name_ar') is-invalid @enderror">
                        </div>
                        @error('settings.'.$setting->key)
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    @endforeach



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
