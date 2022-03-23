@extends('admin.layouts.master')

@section('content')


    <div class="container">



        <div class=" row align-items-center justify-content-center">
            <div class="col-md-10">

                <h1>{{__('site.edit_food')}}</h1>

                <form action="{{ route('admin.foods.update',$food->id) }}" action="" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    {{-- name_ar --}}
                    <div class="row align-items-center ">
                        <div class="col-md-2">

                            <label for="name_ar">{{__('site.ar.name')}}</label>
                        </div>
                        <div class="col-md-10">

                            <input value="{{ $food->name_ar }}" type="text" id='name_ar' name="name_ar" class="form-control @error('name_ar') is-invalid @enderror">
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

                            <input value="{{ $food->name_en }}" type="text" id='name_en' name="name_en" class="form-control @error('name_en') is-invalid @enderror">
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

                            <textarea cols="30" rows="10" id='description_ar' name="description_ar" class="form-control  editor @error('description_ar') is-invalid @enderror">{{  $food->description_ar  }}</textarea>
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

                            <textarea cols="30" rows="10" id='description_en' name="description_en" class="form-control  editor @error('description_en') is-invalid @enderror">{{ $food->description_en }}</textarea>
                        </div>
                        @error('description_en')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- description_en --}}

                    {{-- calories --}}
                    <div class="row align-items-center">
                        <div class="col-md-2">

                            <label for="calories">{{__('site.calories')}}</label>
                        </div>
                        <div class="col-md-10">

                            <input value="{{ $food->calories  }}"  id="calories" name="calories"  type="number" class="form-select @error('calories') is-invalid @enderror">
                        </div>
                        @error('calories')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- calories --}}

                    {{-- unit --}}
                    <div class="row align-items-center">
                        <div class="col-md-2">

                            <label for="unit">{{__('site.unit')}}</label>
                        </div>
                        <div class="col-md-10">

                            <select class="form-select @error('unit') is-invalid @enderror" aria-label="Default" name="unit">
                                <option @if ($food->unit == 'gm') selected @endif  value="gm">{{__('site.100_gm')}} </option>
                                <option  @if ($food->unit == 'cup') selected @endif value="cup">{{__('site.1_cup')}}</option>
                                <option @if ($food->unit == 'one') selected @endif value="one">{{__('site.1_one')}}</option>

                            </select>
                        </div>
                        @error('unit')
                        <div class="col-12 text-danger">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                    {{-- unit --}}



                    {{-- category --}}
                    <div class="row align-items-center">
                        <div class="col-md-2">

                            <label for="category">{{__('site.category')}}</label>
                        </div>
                        <div class="col-md-10">

                            <select class="form-select @error('category') is-invalid @enderror" aria-label="Default" name="category_id">
                                @foreach ($food_categories as $category )
                                <option @if ($food->category_id == $category->id) selected @endif value="{{ $category->id }}">{{$category->name}}</option>
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
                                <option  @if ($food->status ==1) selected @endif   value="1">{{__('site.active')}}</option>
                                <option  @if ($food->status ==0) selected @endif  value="0">{{__('site.inactive')}}</option>
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



                    <div class="row align-items-center ">

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">{{ __('site.update') }}</button>

                        </div>

                    </div>


                </form>

            </div>
        </div>










    </div>

    @push('script')
    <script src="{{ asset('dashbaord_files/js/ckeditor.js') }}"></script>
    <script src="{{ asset('dashbaord_files/js/ar.js') }}"></script>



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
