@extends('layouts.admin')

@section('content')

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif


<form action="{{ route('portfoliocategories.update',$pcategory) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="container">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#english">{{__('portfolio.english')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#arabic">{{__('portfolio.arabic')}}</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div id="english" class="container tab-pane active"><br>
                {{-- name --}}
                <div class="form-group col-sm-7">
                    <label class="col-sm-6 col-form-label" for="en_name">{{ __('pcategory.name') }}</label>
                    <input class="form-control {{ $errors->has('en_name') ? 'is-invalid' : '' }}" type="text" name="en_name" id="en_name" value="{{ $pcategory->getAttribute('name:en') }}" required>
                    @error('en_name')
                    <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div id="arabic" class="container tab-pane fade"><br>
                {{-- name --}}
                <div class="form-group col-sm-7">
                    <label class="col-sm-6 col-form-label" for="ar_name">{{ __('pcategory.name') }}</label>
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

