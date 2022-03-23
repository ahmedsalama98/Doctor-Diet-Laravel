@extends('admin.layouts.master')

@section('content')


    <div class="container">



        <div class=" row align-items-center justify-content-center">
            <div class="col-md-6">

                <h2>{{__('site.edit') .' '. __('site.profile')}}</h2>

                <form  action="{{ route('dashboard.account.update') }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    {{-- name --}}
                    <div class="row align-items-center ">
                        <div class="col-md-2">

                            <label for="name">{{__('site.name')}}</label>
                        </div>
                        <div class="col-md-10">

                            <input value="{{ Auth::user()->name}}" type="text" id='name' name="name" class="form-control @error('name') is-invalid @enderror">
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

                            <input type="email" value="{{ Auth::user()->email}}" id='email' name="email" class="form-control @error('email') is-invalid @enderror">
                        </div>
                        @error('email')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- email --}}

                    {{-- birth_date --}}
                    <div class="row align-items-center ">
                        <div class="col-md-2">

                            <label for="birth_date">{{__('site.birth_date')}}</label>
                        </div>
                        <div class="col-md-10">

                            <input type="date" value="{{ Auth::user()->birth_date}}" id='birth_date' name="birth_date" class="form-control @error('birth_date') is-invalid @enderror">
                        </div>
                        @error('birth_date')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- birth_date --}}



                    {{-- country --}}
                    <div class="row align-items-center">
                        <div class="col-md-2">

                            <label for="country">{{__('site.country')}}</label>
                        </div>
                        <div class="col-md-10">

                            <select class="form-select @error('country') is-invalid @enderror" aria-label="Default" name="country">


                                <option value="">...</option>
                                @foreach ($countries as  $country)

                                    <option @if($country == Auth::user()->country) selected @endif value="{{ $country }}">  {{ $country }}</option>
                                @endforeach

                            </select>
                        </div>
                        @error('country')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- country --}}

                   {{-- gender --}}
                    <div class="row align-items-center">
                        <div class="col-md-2">

                            <label for="gender">{{__('site.gender')}}</label>
                        </div>
                        <div class="col-md-10">

                            <select class="form-select @error('gender') is-invalid @enderror" aria-label="Default" name="gender">
                                <option @if(Auth::user()->gender ==0) selected @endif  value="0">{{__('site.male')}}</option>
                                <option  @if(Auth::user()->gender ==1) selected @endif value="1">{{__('site.female')}}</option>
                                <option  @if(!isset(Auth::user()->gender)) selected @endif value="">{{__('site.another_thing')}}</option>
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
