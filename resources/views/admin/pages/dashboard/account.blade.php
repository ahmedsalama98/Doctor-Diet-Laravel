@extends('admin.layouts.master')

@section('content')


    <div class="container-fluid">


        <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
            <div class="app-card-header p-3 border-bottom-0">
                <div class="row align-items-center gx-3">
                    <div class="col-auto">

                            <img class="profile-image" src="{{ Auth::user()->avatar_url }}" alt="">

                    </div><!--//col-->
                    <div class="col-auto">
                        <h2 class="app-card-title">

                            {{ Auth::user()->roles[0]->name }}
                        </h2>
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//app-card-header-->
            <div class="app-card-body px-4 w-100">

                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>{{ __('site.name') }}</strong></div>
                            <div class="item-data">{{ Auth::user()->name }}</div>
                        </div><!--//col-->

                    </div><!--//row-->
                </div><!--//item-->
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>{{ __('site.email') }}</strong></div>
                            <div class="item-data">{{ Auth::user()->email }}</div>
                        </div><!--//col-->

                    </div><!--//row-->
                </div><!--//item-->
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>{{ __('site.country') }}</strong></div>
                            <div class="item-data">
                                {{ Auth::user()->country ?  Auth::user()->country : '...' }}
                            </div>
                        </div><!--//col-->

                    </div><!--//row-->
                </div><!--//item-->

                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>{{ __('site.gender') }}</strong></div>
                            <div class="item-data">

                                @if(Auth::user()->gender ==0)
                                {{__('site.male')}}
                                @elseif(Auth::user()->gender ==1)
                                {{__('site.female')}}
                                @else
                                     ...
                                @endif
                            </div>
                        </div><!--//col-->

                    </div><!--//row-->
                </div><!--//item-->



                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>{{ __('site.birth_date') }}</strong></div>
                            <div class="item-data">
                                {{ Auth::user()->birth_date ?  Auth::user()->birth_date : '...' }}
                            </div>
                        </div><!--//col-->

                    </div><!--//row-->
                </div><!--//item-->
            </div><!--//app-card-body-->
            <div class="app-card-footer p-4 mt-auto">
               <a class="btn btn-secondary" href="{{ route('dashboard.account.edit') }}">{{ __('site.manage_profile') }}</a>
            </div><!--//app-card-footer-->

        </div>




    </div>
@endsection
