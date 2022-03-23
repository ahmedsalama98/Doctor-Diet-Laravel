@extends('admin.layouts.master')

@section('content')


    <div class="container">



        <div class=" row align-items-center justify-content-center">
            <div class="col-md-12">

                <h1>{{__('site.edit_meal')}}</h1>

                <form action="{{ route('admin.meals.update',$meal->id) }}" action="" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    {{-- name_ar --}}
                    <div class="row align-items-center ">
                        <div class="col-md-2">

                            <label for="name_ar">{{__('site.ar.name')}}</label>
                        </div>
                        <div class="col-md-10">

                            <input value="{{ $meal->name_ar }}" type="text" id='name_ar' name="name_ar" class="form-control @error('name_ar') is-invalid @enderror">
                        </div>
                        @error('name_ar')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- name_ar --}}

                    {{-- name_en --}}
                    <div class="row align-items-center ">
                        <div class="col-md-2">

                            <label for="name_en">{{__('site.en.name')}}</label>
                        </div>
                        <div class="col-md-10">

                            <input value="{{$meal->name_ar }}" type="text" id='name_en' name="name_en" class="form-control @error('name_en') is-invalid @enderror">
                        </div>
                        @error('name_en')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- name_en --}}



                    {{-- description_ar --}}
                    <div class="row align-items-center ">
                        <div class="col-md-2">

                            <label for="description_ar">{{__('site.ar.description')}}</label>
                        </div>
                        <div class="col-md-10">

                            <textarea cols="30" rows="10" id='description_ar' name="description_ar" class="form-control  editor @error('description_ar') is-invalid @enderror">{{ $meal->description_ar }}</textarea>
                        </div>
                        @error('description_ar')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- description_ar --}}


                    {{-- description_en --}}
                    <div class="row align-items-center ">
                        <div class="col-md-2">

                            <label for="description_en">{{__('site.ar.description')}}</label>
                        </div>
                        <div class="col-md-10">

                            <textarea cols="30" rows="10" id='description_en' name="description_en" class="form-control  editor @error('description_en') is-invalid @enderror">{{ $meal->description_en }}</textarea>
                        </div>
                        @error('description_en')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- description_en --}}




                    {{-- category --}}
                    <div class="row align-items-center">
                        <div class="col-md-2">

                            <label for="category">{{__('site.category')}}</label>
                        </div>
                        <div class="col-md-10">

                            <select class="form-select @error('category') is-invalid @enderror" aria-label="Default" name="category_id">



                                @foreach ($meal_categories as $category )


                                <option @if($meal->category_id == $category->id) selected @endif value="{{ $category->id }}">{{$category->name}}</option>

                                @endforeach

                            </select>
                        </div>
                        @error('category')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- category --}}






                    {{-- status --}}
                    <div class="row align-items-center">
                        <div class="col-md-2">

                            <label for="status">{{__('site.status')}}</label>
                        </div>
                        <div class="col-md-10">

                            <select class="form-select @error('status') is-invalid @enderror" aria-label="Default" name="status">
                                <option @if($meal->status == 1) selected @endif value="1">{{__('site.active')}}</option>
                                <option  @if($meal->status == 0) selected @endif value="0">{{__('site.inactive')}}</option>
                            </select>
                        </div>
                        @error('status')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- status --}}






                 {{-- images --}}
                    <div class="row align-items-center ">
                        <div class="col-md-2">

                            <label for="images">{{__('site.images')}}</label>
                        </div>
                        <div class="col-md-10">

                            <input  multiple type="file" id='images' name="images[]" class="form-control  @error('images') is-invalid @enderror">
                        </div>
                        @error('images.*')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- images --}}



                 {{-- foods --}}
                 <div class="row  ">
                    <div class="col-md-6">

                        <h3>{{ __('site.foods') }}</h3>
                        <div class="accordion accordion-flush" id="accordionFlushExample">


                            @foreach ($food_categories as $category)

                             <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collaps-{{  $category->id }}" aria-expanded="false" aria-controls="flush-collaps-{{  $category->id }}">
                                   {{$category->name}}
                                  </button>
                                </h2>
                                <div id="flush-collaps-{{  $category->id }}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">


                                    <table  class="table table-hoverd table-responsive p-8">

                                        <thead>
                                            <tr class="cell">
                                                <th>  {{ __('site.foods') }}</th>
                                                <th>  {{ __('site.action') }}</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($category->foods as $food)

                                            <tr>
                                                <th>  {{ $food->name}}</th>
                                                <th>  <button type="button" id="add_food_{{ $food->id}}" class=" @if(in_array($food->id , $meal->foods->pluck('id')->toArray())) disabled @endif btn btn-success add_food" data-food_unit="{{ __('site.'.$food->unit) }}" data-food_name="{{ $food->name }}" data-food_id="{{ $food->id }}"> add</button></th>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>


                                </div>
                              </div>



                            @endforeach
                        </div>

                       </div>
                    <div class="col-md-6">




                        <table  class="table table-hoverd table-responsive p-8">

                            <thead>
                                <tr class="cell">
                                    <th>  {{ __('site.foods') }}</th>
                                    <th>  {{ __('site.quantity') }}</th>
                                    <th>  {{ __('site.unit') }}</th>
                                    <th>  {{ __('site.action') }}</th>

                                </tr>
                            </thead>

                            <tbody id="foods_table">

                                @foreach ($meal->foods as $food )

                                <td> {{$food->name  }}</td>
                                <td><input value="{{ $food->pivot->quantity }}" type="number" name="foods[{{ $food->id }}][quantity]" > </td>
                                <td>{{ __('site.1_'.$food->unit) }} </td>
                                <td> <button type="button" id="{{ $food->id }}" class="delete_food btn btn-danger" data-parent_id="{{ $food->id }}">   <i class="fas fa-trash-alt"></i>  </button></td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>




                    @error('foods.*')
                    <div class="col-12 text-danger">
                        {{ $message }}
                    </div>

                    @enderror
                    @error('foods')
                    <div class="col-12 text-danger">
                        {{ $message }}
                    </div>

                    @enderror
                </div>
                {{-- foods --}}



                    <div class="row align-items-center ">

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">{{ __('site.create') }}</button>

                        </div>

                    </div>


                </form>

            </div>
        </div>










    </div>

    @push('script')
    <script src="{{ asset('dashbaord_files/js/ckeditor.js') }}"></script>
    <script src="{{ asset('dashbaord_files/js/ar.js') }}"></script>
    <script src="{{ asset('dashbaord_files/js/add-product.js') }}"></script>




    <script>
ClassicEditor

    .create( document.querySelector( '#description_ar' ), {

        language: 'ar',
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
            ]
        }

    } )
    .catch( error => {
        console.log( error );
    } );


    ClassicEditor

    .create( document.querySelector( '#description_en' ), {

        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
            ]
        }

    } )
    .catch( error => {
        console.log( error );
    } );


    </script>
    @endpush
@endsection
