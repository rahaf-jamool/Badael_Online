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

<form action="{{ route('admin.portfolio.update',$portfolio->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group m-4">
        <h2>{{__('portfolio.Uportfolio')}}</h2>
    </div>

    <div class="container">

        {{-- image --}}
        <div class="image">
            {{-- image desktop --}}
        <div class="form-group col-md-6">

            <div class="picture-container">

                <div class="picture">

                    <img src="{{ asset('storage/'.$portfolio->cover) }}" class="picture-src" id="wizardPicturePreview" height="200px" width="400px" title=""/>

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

                    <img src="{{ asset('storage/'.$portfolio->mobileImage) }}" class="picture-src" id="wizardPicturePreview1" height="200px" width="400px" title=""/>

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
        <div class="container">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-link bg-aqua-active" id="englishLink"><a class="text-decoration-none" href="#english-form" role="tab" data-toggle="tab">Name (EN)</a></li>
                <li class="nav-link" id="arabicLink"><a class="text-decoration-none" href="#arabic-form" role="tab" data-toggle="tab">Name (AR)</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="card-body tab-pane active" id="english-form">
                    {{-- name --}}
                    <div class="form-group">
                        <label class="required" for="en_name">Name (EN)</label>
                        <input class="form-control {{ $errors->has('en_name') ? 'is-invalid' : '' }}" type="text" name="en_name" id="en_name" value="{{ $portfolio->getTranslation('name','en')  }}" required>
                        @if($errors->has('en_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('en_name') }}
                            </div>
                        @endif
                    </div>
                    {{-- client --}}
                    <div class="form-group">
                        <label class="required" for="en_client">Client (EN)</label>
                        <input class="form-control {{ $errors->has('en_client') ? 'is-invalid' : '' }}" type="text" name="en_client" id="en_client" value="{{ old('en_client') ? old('en_client') : $portfolio->en_client  }}" required>
                        @if($errors->has('en_client'))
                            <div class="invalid-feedback">
                                {{ $errors->first('en_client') }}
                            </div>
                        @endif
                    </div>
                    {{-- desc --}}
                    <div class="form-group">
                        <label class="required" for="en_desc">Description (EN)</label>
                        <input class="form-control {{ $errors->has('en_desc') ? 'is-invalid' : '' }}" type="text" name="en_desc" id="en_desc" value="{{ old('en_desc') ? old('en_desc') : $portfolio->en_desc }}" required>
                        @if($errors->has('en_desc'))
                            <div class="invalid-feedback">
                                {{ $errors->first('en_desc') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body tab-pane" id="arabic-form">
                    {{-- name --}}
                    <div class="form-group">
                        <label class="required" for="title">Name (AR)</label>
                        <input class="form-control {{ $errors->has('ar_name') ? 'is-invalid' : '' }}" type="text" name="ar_name" id="ar_name" @if($portfolio->locale == 'ar') value="{{ $portfolio->name  }}" required>
                        @if($errors->has('ar_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('ar_name') }}
                            </div>
                        @endif
                    </div>
                    {{-- client --}}
                    <div class="form-group">
                        <label class="required" for="title">Client (AR)</label>

                        <input class="form-control {{ $errors->has('ar_client') ? 'is-invalid' : '' }}" type="text" name="ar_client" id="ar_client"  value="{{ old('ar_client') ? old('ar_client') : $portfolio->ar_client }}" required>
                        @if($errors->has('ar_client'))
                            <div class="invalid-feedback">
                                {{ $errors->first('ar_client') }}
                            </div>
                        @endif
                    </div>
                    {{-- desc --}}
                    <div class="form-group">
                        <label class="required" for="title">Description (AR)</label>
                        <input class="form-control {{ $errors->has('ar_desc') ? 'is-invalid' : '' }}" type="text" name="ar_desc" id="ar_desc" value="{{ old('ar_desc') ? old('ar_desc') : $portfolio->ar_desc }}" required>
                        @if($errors->has('ar_desc'))
                            <div class="invalid-feedback">
                                {{ $errors->first('ar_desc') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        {{--  category  --}}
        <div class="form-group ml-4">

            <label for="category" class="col-sm-2 col-form-label">{{ __('portfolio.category') }}</label>

            <div class="col-sm-7">

                <select name='category' class="form-control {{$errors->first('category') ? "is-invalid" : "" }} " id="category">
                    <option disabled selected>{{ __('portfolio.Chooseone') }}</option>
                    @foreach ($categories as $category)
                    <option {{ $category->id == $portfolio->pcategory_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
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

                <input type="text" name='link' class="form-control {{$errors->first('link') ? "is-invalid" : "" }} " value="{{old('link') ? old('link') : $portfolio->link}}" id="link">

                <div class="invalid-feedback">
                    {{ $errors->first('link') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-4">

            <label for="date" class="col-sm-2 col-form-label">{{ __('portfolio.Pdate') }}</label>

            <div class="col-sm-7">

                <input type="date" name='date' class="form-control {{$errors->first('date') ? "is-invalid" : "" }} " value="{{old('date') ? old('date') : $portfolio->date}}" id="date" >

                <div class="invalid-feedback">
                    {{ $errors->first('date') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-4">

            <div class="col-sm-3">

                <button type="submit" class="btn btn-primary">{{ __('portfolio.update') }}</button>

            </div>

        </div>

    </div>

  </form>
@endsection

@push('scripts')

<script>
    // language
    window.onload = function () {
        if(localStorage.getItem('local') == 'en'){
                $('.ar').css({display: "none"});
                $('.en').css({display: "block"});
        }else{
                $('.ar').css({display: "block"});
                $('.en').css({display: "none"});
        }
    }

    $(function () {
        $(".selectLang").change(function() {
            var val = $(this).val();
            localStorage.setItem('local',val);
            if(localStorage.getItem('local') == 'en'){
                $('.ar').css({display: "none"});
                $('.en').css({display: "block"});
        }else{
                $('.ar').css({display: "block"});
                $('.en').css({display: "none"});
        }
        });
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
