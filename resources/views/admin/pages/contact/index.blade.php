@extends('admin.layouts.master')

@section('content')


    <div class="container">


        <div class="card ">
                <div class="card-header">

                    <div class="row justify-content-between align-self-center pb-16">

                                <div class="col-auto">

                                <h2> {{ __('site.contacts')}}</h2>
                                </div>

                                <div action="{{ route('admin.contacts.index') }}" class="col-auto">

                                    <form  class=" d-flex gx-1 align-items-center justify-content-end" >

                                        <select class="form-select " aria-label="Default" name="status">
                                            <option selected value="0">{{__('site.new')}}</option>
                                            <option value="1" @if( isset(request()->status) &&request()->status == 1) selected @endif >{{__('site.read')}}</option>
                                        </select>
                                        <button type="submit" class="btn btn-success ">Search</button>

                                    </form>

                                </div>


                    </div>
                </div>
            <div class="card-body">


                @foreach ($contacts as $contact )
                <div class="app-card app-card-notification shadow-sm mb-4 mb-10" >
				    <div class="app-card-header px-4 py-3">
				        <div class="row g-3 align-items-center">

					        <div class="col-12 col-lg-auto text-center text-lg-start">
						        <div class="notification-type mb-2">


                                    @if ( $contact->read ==0)
                                    <span class="badge bg-success">{{ __('site.new') }}</span>
                                    @else
                                    <span class="badge bg-danger">{{ __('site.read') }}</span>
                                    @endif
                                </div>
						        <h4 class="notification-title mb-1"> {{ $contact->subject }}</h4>

						        <ul class="notification-meta list-inline mb-0">
							        <li class="list-inline-item">

                                        {{ $contact->ago =='Now'?  $contact->ago :$contact->ago .__('site.ago')}} </li>
							        <li class="list-inline-item">|</li>
							        <li class="list-inline-item">{{ $contact->name }}</li>
                                    <li class="list-inline-item">|</li>
							        <li class="list-inline-item">

                                        <a href="mailto:{{ $contact->email }}" target="_blank">{{ $contact->email }}</a>
                                        </li>
						        </ul>

					        </div><!--//col-->
				        </div><!--//row-->
				    </div><!--//app-card-header-->
				    <div class="app-card-body p-4">
					    <div class="notification-content">
                            {{ $contact->message }}

                        </div>
				    </div><!--//app-card-body-->
				    <div class="app-card-footer px-4 py-3">
					    {{-- <a class="action-link" href="#">View all</a> --}}


                        @if ($contact->read ==0)
                        @if (Auth::user()->hasPermission('contacts-delete'))

                        <form class="d-inline-block" action="{{route('admin.contacts.read',$contact->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-success " title="{{ __('site.read') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" type="submit"> <i class="fas fa-check-circle"> </i></button>
                        </form>

                        @else

                        <button class="btn btn-success disabled" > <i class="fas fa-check-circle"></i> </button>

                        @endif
                        @endif

                        @if (Auth::user()->hasPermission('contacts-delete'))

                        <form class="d-inline-block" action="{{route('admin.contacts.destroy',$contact->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger "  title="{{ __('site.delete') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" type="submit"> <i class="fas fa-trash"></i></button>
                        </form>

                        @else

                        <button class="btn btn-danger disabled" > <i class="fas fa-trash"></i></button>

                        @endif
				    </div><!--//app-card-footer-->




				</div>
                @endforeach

                {!! $contacts->links() !!}

            </div>












    </div>
@endsection
