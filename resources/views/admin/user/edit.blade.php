@extends('layouts.admin')

@section('content')

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('admin.user.update',$user->id) }}" method="POST">
    @csrf

    <div class="form-group m-4">
        <h2>{{__('user.Uuser')}}</h2>
    </div>

    <div class="container">

        <div class="form-group ml-5">

            <label for="name" class="col-sm-2 col-form-label">{{ __('user.name') }}</label>

            <div class="col-sm-9">

                <input type="text" name='name' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name') ? old('name') : $user->name}}" id="name" placeholder="Ex: Susi Similikiti">

                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>

            </div>

        </div>

          <div class="form-group ml-5">

            <label for="email" class="col-sm-2 col-form-label">{{ __('user.email') }}</label>

            <div class="col-sm-9">

                <input type="email" name='email' class="form-control {{$errors->first('email') ? "is-invalid" : "" }} " value="{{old('email') ? old('email') : $user->email}}" id="email" placeholder="Email">

                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>

            </div>

        </div>

         {{-- role --}}

         <div class="form-group ml-5">

            <label class="col-sm-2 col-form-label">{{ __('user.roles') }}</label>

            <div class="col-sm-9 row">

                @foreach ($roles as $role)

                <div class="col-lg-3">

                    <div class="checkbox">

                        <label><input type="checkbox" name="roles[]"
                             value="{{ $role->id }}"
                            @foreach ($user->roles as $role_premit)
                                @if ($role_premit->id == $role->id)
                                    checked
                                @endif
                            @endforeach
                        > {{ $role->name }} </label>

                    </div>

                </div>

                @endforeach


            </div>

        </div>

        <div class="form-group ml-5">

            <div class="col-sm-3">

                <button type="submit" class="btn btn-primary">{{ __('user.update') }}</button>

            </div>

        </div>

    </div>

  </form>
@endsection
