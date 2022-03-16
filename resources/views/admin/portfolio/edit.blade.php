@extends('layouts.admin')

@section('styles')

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

@endsection

@section('content')

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('portfolios.update',$portfolio) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group m-4">
            <h2>{{__('portfolio.Update portfolio')}}</h2>
        </div>

        <div class="container">

            {{-- image --}}
            <div class="image">
                {{-- image desktop --}}
                <div class="form-group col-md-6">

                    <div class="picture-container">

                        <div class="picture">

                            <img src="{{ asset('storage/'.$portfolio->cover) }}" class="picture-src"
                                 id="wizardPicturePreview" height="200px" width="400px" title=""/>

                            <input type="file" id="wizard-picture" name="cover"
                                   class="form-control {{$errors->first('cover') ? "is-invalid" : "" }} ">

                            <div class="invalid-feedback">
                                {{ $errors->first('cover') }}
                            </div>

                        </div>

                        <h6>{{ __('portfolio.Select cover') }}</h6>

                    </div>

                </div>

                {{-- image mobile --}}
                <div class="form-group col-md-6">

                    <div class="picture-container">

                        <div class="picture">

                            <img src="{{ asset('storage/'.$portfolio->mobileImage) }}" class="picture-src"
                                 id="wizardPicturePreview1" height="200px" width="400px" title=""/>

                            <input type="file" id="wizard-picture1" name="mobileImage"
                                   class="form-control {{$errors->first('mobileImage') ? "is-invalid" : "" }} ">

                            <div class="invalid-feedback">
                                {{ $errors->first('mobileImage') }}
                            </div>

                        </div>

                        <h6>{{ __('portfolio.Select image') }}</h6>

                    </div>
                </div>
            </div>
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
                        <label class="required" for="en_name">{{__('portfolio.name')}}</label>
                        <input class="form-control {{ $errors->has('en_name') ? 'is-invalid' : '' }}" type="text"
                               name="en_name" id="en_name" value="{{ $portfolio->getAttribute('name:en') }}" required>
                        @if($errors->has('en_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('en_name') }}
                            </div>
                        @endif
                    </div>
                    {{-- client --}}
                    <div class="form-group col-sm-7">
                        <label class="required" for="en_client">{{__('portfolio.client')}}</label>
                        <input class="form-control {{ $errors->has('en_client') ? 'is-invalid' : '' }}" type="text"
                               name="en_client" id="en_client" value="{{ $portfolio->getAttribute('client:en') }}"
                               required>
                        @if($errors->has('en_client'))
                            <div class="invalid-feedback">
                                {{ $errors->first('en_client') }}
                            </div>
                        @endif
                    </div>
                    {{-- desc --}}
                    <div class="form-group col-sm-7">
                        <label class="required" for="en_desc">{{__('portfolio.desc')}}</label>
                        <input class="form-control {{ $errors->has('en_desc') ? 'is-invalid' : '' }}" type="text"
                               name="en_desc" id="en_desc" value="{{ $portfolio->getAttribute('desc:en') }}" required>
                        @if($errors->has('en_desc'))
                            <div class="invalid-feedback">
                                {{ $errors->first('en_desc') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div id="arabic" class="container tab-pane fade"><br>
                    {{-- name --}}
                    <div class="form-group col-sm-7">
                        <label class="required" for="title">{{__('portfolio.name')}}</label>
                        <input class="form-control {{ $errors->has('ar_name') ? 'is-invalid' : '' }}" type="text"
                               name="ar_name" id="ar_name" value="{{ $portfolio->getAttribute('name:ar') }}" required>
                        @if($errors->has('ar_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('ar_name') }}
                            </div>
                        @endif
                    </div>
                    {{-- client --}}
                    <div class="form-group col-sm-7">
                        <label class="required" for="title">{{__('portfolio.client')}}</label>
                        <input class="form-control {{ $errors->has('ar_client') ? 'is-invalid' : '' }}" type="text"
                               name="ar_client" id="ar_client" value="{{ $portfolio->getAttribute('client:ar') }}"
                               required>
                        @if($errors->has('ar_client'))
                            <div class="invalid-feedback">
                                {{ $errors->first('ar_client') }}
                            </div>
                        @endif
                    </div>
                    {{-- desc --}}
                    <div class="form-group col-sm-7">
                        <label class="required" for="title">{{__('portfolio.desc')}}</label>
                        <input class="form-control {{ $errors->has('ar_desc') ? 'is-invalid' : '' }}" type="text"
                               name="ar_desc" id="ar_desc" value="{{ $portfolio->getAttribute('desc:ar') }}" required>
                        @if($errors->has('ar_desc'))
                            <div class="invalid-feedback">
                                {{ $errors->first('ar_desc') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            {{--  category  --}}
            <div class="form-group ml-4">

                <label for="category" class="col-sm-2 col-form-label">{{ __('portfolio.category') }}</label>

                <div class="col-sm-7">

                    <select name='category' class="form-control {{$errors->first('category') ? "is-invalid" : "" }} "
                            id="category">
                        <option disabled selected>{{ __('portfolio.Choose one') }}</option>
                        @foreach ($categories as $category)
                            <option
                                {{ $category->id == $portfolio->pcategory_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
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

                    <input type="text" name='link' class="form-control {{$errors->first('link') ? "is-invalid" : "" }} "
                           value="{{old('link') ? old('link') : $portfolio->link}}" id="link">

                    <div class="invalid-feedback">
                        {{ $errors->first('link') }}
                    </div>

                </div>

            </div>

            <div class="form-group ml-4">

                <label for="date" class="col-sm-2 col-form-label">{{ __('portfolio.Project date') }}</label>

                <div class="col-sm-7">

                    <input type="date" name='date' class="form-control {{$errors->first('date') ? "is-invalid" : "" }} "
                           value="{{old('date') ? old('date') : $portfolio->date}}" id="date">

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
        // Prepare the preview for profile picture
        $("#wizard-picture").change(function () {
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
        $("#wizard-picture1").change(function () {
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
