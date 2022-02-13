@extends('layouts.admin')

@section('styles')
@section('styles')
<style>

   .picture-container {
  position: relative;
  cursor: pointer;
  text-align: center;
}
 .picture {
  /* width: 800px; */
  height: 400px;
  background-color: #999999;
  border: 4px solid #CCCCCC;
  color: #FFFFFF;
  /* border-radius: 50%; */
  margin: 5px auto;
  overflow: hidden;
  transition: all 0.2s;
  -webkit-transition: all 0.2s;
}
.picture:hover {
  border-color: #2ca8ff;
}
.picture input[type="file"] {
  cursor: pointer;
  display: block;
  height: 100%;
  left: 0;
  opacity: 0 !important;
  position: absolute;
  top: 0;
  width: 100%;
}
.picture-src {
  width: 100%;
  height: 100%;
}
.image {
    display: flex;
    margin: auto;
    justify-content: center;
    align-items: center;
}
.rowInput {
    display: flex;
    gap: 15px;
}
.selectLang {
    margin-top: 38px;
}
</style>
@endsection
@section('content')

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group m-4">
        <h2>{{__('portfolio.Cportfolio')}}</h2>
    </div>

    <div class="container">

        {{-- image --}}
        <div class="image">
                {{-- image desktop --}}
        <div class="form-group col-md-6">

            <div class="picture-container">

                <div class="picture">

                    <img src="" class="picture-src" id="wizardPicturePreview" height="200px" width="400px" title=""/>

                    <input type="file" id="wizard-picture" name="cover" class="form-control {{$errors->first('cover') ? "is-invalid" : "" }} ">

                    <div class="invalid-feedback">
                        {{ $errors->first('cover') }}
                    </div>

                </div>

                <h6>{{ __('portfolio.Scover') }}</h6>

            </div>

        </div>

        {{-- image mobile --}}
        <div class="form-group col-md-6">

            <div class="picture-container">

                <div class="picture">

                    <img src="" class="picture-src" id="wizardPicturePreview1" height="200px" width="400px" title=""/>

                    <input type="file" id="wizard-picture1" name="mobileImage" class="form-control {{$errors->first('mobileImage') ? "is-invalid" : "" }} ">

                    <div class="invalid-feedback">
                        {{ $errors->first('mobileImage') }}
                    </div>

                </div>

                <h6>{{ __('portfolio.Simage') }}</h6>

            </div>

        </div>
        </div>

        {{-- change language --}}
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link bg-aqua-active" href="" id="english-link">EN</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="" id="arabic-link">AR</a>
            </li>
         </ul>

         <div class="card-body" id="english-form">
            <div class="form-group">
                <label class="required" for="en_title">Name (EN)</label>
                <input class="form-control {{ $errors->has('en_title') ? 'is-invalid' : '' }}" type="text" name="en_title" id="en_title" value="{{ old('en_title', '') }}" required>
                @if($errors->has('en_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('en_title') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="card-body d-none" id="arabic-form">
            <div class="form-group">
                <label class="required" for="title">Name (AR)</label>
                <input class="form-control {{ $errors->has('es_title') ? 'is-invalid' : '' }}" type="text" name="es_title" id="es_title" value="{{ old('es_title', '') }}" required>
                @if($errors->has('es_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('es_title') }}
                    </div>
                @endif
            </div>
        </div>


        {{-- /////////////// --}}
        {{-- category --}}
        <div class="form-group ml-4">

            <label for="category" class="col-sm-2 col-form-label">{{ __('portfolio.category') }}</label>

            <div class="col-sm-7">

                <select name='category' class="form-control {{$errors->first('category') ? "is-invalid" : "" }} " id="category">
                    <option disabled selected>{{ __('portfolio.Chooseone') }}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category')
                    <small class="form-text text-danger"> {{ $message }}</small>
                @enderror

            </div>

        </div>

        <div class="form-group ml-4">

            <label for="link" class="col-sm-2 col-form-label">{{ __('portfolio.link') }}</label>

            <div class="col-sm-7">

                <input type="text" name='link' class="form-control {{$errors->first('link') ? "is-invalid" : "" }} " value="{{old('link')}}" id="link">

                <div class="invalid-feedback">
                    {{ $errors->first('link') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-4">

            <div class="col-sm-3">

                <button type="submit" class="btn btn-primary">{{ __('portfolio.create') }}</button>

            </div>

        </div>

    </div>

  </form>
@endsection

@push('scripts')

<script>
    // change language
    var $englishForm = $('#english-form');
   var $arabicForm = $('#arabic-form');
   var $englishLink = $('#english-link');
   var $arabicLink = $('#arabic-link');

   $englishLink.click(function() {
     $englishLink.toggleClass('bg-aqua-active');
     $englishForm.toggleClass('d-none');
     $arabicLink.toggleClass('bg-aqua-active');
     $arabicForm.toggleClass('d-none');
   });

   $arabicLink.click(function() {
     $englishLink.toggleClass('bg-aqua-active');
     $englishForm.toggleClass('d-none');
     $arabicLink.toggleClass('bg-aqua-active');
     $arabicForm.toggleClass('d-none');
   });
    // Prepare the preview for profile picture
    $("#wizard-picture").change(function(){
      readURL(this);
  });
  //Function to show image before upload
function readURL(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
      }
      reader.readAsDataURL(input.files[0]);
  }
}
//image mobile
  // Prepare the preview for profile picture
  $("#wizard-picture1").change(function(){
      readURL1(this);
  });
  //Function to show image before upload
function readURL1(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#wizardPicturePreview1').attr('src', e.target.result).fadeIn('slow');
      }
      reader.readAsDataURL(input.files[0]);
  }
}
</script>
@endpush
