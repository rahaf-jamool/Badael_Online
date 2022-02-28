@extends('layouts.admin')

@section('content')

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif


<form action="{{ route('portfoliocategories.update',$pcategory->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="container">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-link bg-aqua-active" id="englishLink"><a class="text-decoration-none" href="#english-form" role="tab" data-toggle="tab">{{__('portfolio.english')}}</a></li>
            <li class="nav-link" id="arabicLink"><a class="text-decoration-none" href="#arabic-form" role="tab" data-toggle="tab">{{__('portfolio.arabic')}}</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="card-body tab-pane active" id="english-form">
                {{-- name --}}
                <div class="form-group col-sm-7">
                    <label class="col-sm-6 col-form-label" for="en_name">{{ __('pcategory.Nenglish') }}</label>
                    <input class="form-control {{ $errors->has('en_name') ? 'is-invalid' : '' }}" type="text" name="en_name" id="en_name" value="{{ $pcategory->getAttribute('name:en') }}" required>
                    @error('en_name')
                    <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="card-body tab-pane" id="arabic-form">
                {{-- name --}}
                <div class="form-group col-sm-7">
                    <label class="col-sm-6 col-form-label" for="ar_name">{{ __('pcategory.Narabic') }}</label>
                    <input class="form-control {{ $errors->has('ar_name') ? 'is-invalid' : '' }}" type="text" name="ar_name" id="ar_name" value="{{ $pcategory->getAttribute('name:ar') }}" required>
                    @error('ar_name')
                    <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group ml-4">

            <div class="col-sm-3">

                <button type="submit" class="btn btn-primary">{{ __('pcategory.update') }}</button>

            </div>

        </div>

    </div>

  </form>
@endsection

