@extends('admin.layouts.master')

@section('content')


    <div class="container">


        <div class="card ">
                <div class="card-header">

                    <div class="row justify-content-between align-self-center pb-16">

                                <div class="col-auto">

                                <h2> {{ __('site.users')}}</h2>
                                </div>




                                <div action="{{ route('admin.users.index') }}" class="col-auto">

                                    <form  class=" d-flex gx-1 align-items-center justify-content-end" >
                                        <input type="text" id="search" value="{{ request()->search }}" name="search" class="form-control search-docs" placeholder="Search">

                                        <select class="form-select " aria-label="Default" name="status">
                                            <option selected value="1">{{__('site.active')}}</option>
                                            <option value="0" @if( isset(request()->status) &&request()->status == 0) selected @endif >{{__('site.inactive')}}</option>
                                        </select>
                                        <button type="submit" class="btn btn-success ">Search</button>


                                    </form>

                                </div>


                    </div>
                </div>
            <div class="card-body">
                <div class="table-responsive">


                        <table class="table table-hover p-8">
                            <thead>
                                <tr>
                                    <th class="cell">{{ __('site.image') }}</th>
                                    <th class="cell">{{ __('site.name') }}</th>
                                    <th class="cell">{{ __('site.email') }}</th>
                                    <th class="cell">{{ __('site.status') }}</th>
                                    <th class="cell">{{ __('site.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ( $users as  $user)

                                <tr>
                                    <td class="cell">
                                        <img src="{{ $user->avatar_url }}" alt="aveter" class='d-block avatar'>
                                    </td>
                                    <td class="cell">{{ $user->name }}</td>

                                    <td class="cell">{{ $user->email }}</td>
                                    <td class="cell">

                                        @if($user->status ==1)
                                        <span class="badge rounded-pill bg-success">{{__('site.active')}}</span>

                                        @else
                                        <span class="badge rounded-pill bg-danger">{{__('site.inactive')}}</span>

                                        @endif

                                    </td>
                                    <td class="cell">

                                        @if (Auth::user()->hasPermission('users-update'))
                                        <a class="btn btn-primary " href="{{route('admin.users.edit',$user->id)}}">{{ __('site.edit') }}</a>

                                        @else

                                        <button class="btn btn-primary disabled" >{{ __('site.edit') }}</button>

                                        @endif

                                        @if (Auth::user()->hasPermission('users-delete'))


                                        <form class="d-inline-block" action="{{route('admin.users.destroy',$user->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger " type="submit">{{ __('site.delete') }}</button>
                                        </form>

                                        @else

                                        <button class="btn btn-danger disabled" >{{ __('site.delete') }}</button>

                                        @endif




                                    </td>
                                </tr>


                                @empty

                                @endforelse


                            </tbody>
                        </table>


                      <div class="row align-items-center justify-content-between align-content-center">
                          <div class="col-auto">

                            {!! $users->links() !!}
                          </div>


                          <div class="col-auto">
                            @if (Auth::user()->hasPermission('users-create'))
                            <a class="btn btn-success " href="{{ route('admin.users.create') }}">{{ __('site.create_new_user')  }}</a>

                            @else

                            <button class="btn btn-success disabled" >{{ __('site.create_new_user')  }}</button>

                            @endif
                        </div>
                      </div>
                </div>
                </div>

            </div>











    </div>
@endsection
