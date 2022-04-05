@extends('admin.layouts.master')

@section('content')


    <div class="container">


        <div class="card ">
                <div class="card-header">

                    <div class="row justify-content-between align-self-center pb-16">

                                <div class="col-auto">

                                <h2> {{ __('site.foods')}}</h2>
                                </div>




                                <div action="{{ route('admin.foods.index') }}" class="col-auto">

                                    <form  class=" d-flex gx-1 align-items-center justify-content-end" >
                                        <input type="text" id="search" value="{{ request()->search }}" name="search" class="form-control search-docs" placeholder="Search">

                                        <select class="form-select @error('category') is-invalid @enderror" aria-label="Default" name="category_id">
                                            <option selected value="">{{__('site.all')}}</option>
                                            @foreach ($food_categories as $category )
                                            <option @if (request()->category_id == $category->id) selected @endif value="{{ $category->id }}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
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

                        <table class="table table-hover  p-8">
                            <thead>
                                <tr>
                                    <th class="cell">{{ __('site.image') }}</th>
                                    <th class="cell">{{ __('site.ar.name') }}</th>
                                    <th class="cell">{{ __('site.en.name') }}</th>
                                    <th class="cell">{{ __('site.category') }}</th>

                                    <th class="cell">{{ __('site.calories') }}</th>
                                    <th class="cell">{{ __('site.per') }}</th>

                                    <th class="cell">{{ __('site.status') }}</th>
                                    <th class="cell">{{ __('site.action') }}</th>

                                </tr>
                            </thead>
                            <tbody>

                                @forelse ( $foods as  $food)

                                <tr>
                                    <td class="cell">

                                        @if ($food->first_media !=null)
                                        <img src=" {{ $food->first_media->file_url }}" alt="aveter" class='d-block avatar'>
                                        @else
                                        <img src=" {{ asset('uploads/food_media/default.png') }}" alt="aveter" class='d-block avatar'>
                                        @endif
                                    </td>

                                    <td class="cell">{{ $food->name_ar }}</td>

                                    <td class="cell">{{ $food->name_en }}</td>
                                    <td class="cell">{{ $food->category->name }}</td>

                                    <td class="cell">{{ $food->calories }}</td>
                                    <td class="cell">

                                    @if ($food->unit =='gm')
                                    {{__('site.100_gm')}}
                                    @elseif ($food->unit =='cup')
                                    {{__('site.1_cup')}}
                                    @else
                                    {{__('site.1_one')}}
                                    @endif
                                    </td>


                                    <td class="cell">

                                        @if($food->status ==1)
                                        <span class="badge rounded-pill bg-success">{{__('site.active')}}</span>

                                        @else
                                        <span class="badge rounded-pill bg-danger">{{__('site.inactive')}}</span>

                                        @endif

                                    </td>
                                    <td class="cell">

                                        @if (Auth::user()->hasPermission('foods-update'))
                                        <a class="btn btn-primary " href="{{route('admin.foods.edit',$food->id)}}">{{ __('site.edit') }}</a>

                                        @else

                                        <button class="btn btn-primary disabled" >{{ __('site.edit') }}</button>

                                        @endif

                                        @if (Auth::user()->hasPermission('foods-delete'))


                                        <form class="d-inline-block" action="{{route('admin.foods.destroy',$food->id)}}" method="POST">
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

                            {!! $foods->links() !!}
                          </div>


                          <div class="col-auto">
                            @if (Auth::user()->hasPermission('foods-create'))
                            <a class="btn btn-success " href="{{ route('admin.foods.create') }}">{{ __('site.create_new_food')  }}</a>

                            @else

                            <button class="btn btn-success disabled" >{{ __('site.create_new_food')  }}</button>

                            @endif
                        </div>

                      </div>
                </div>

                </div>

            </div>











    </div>
@endsection
