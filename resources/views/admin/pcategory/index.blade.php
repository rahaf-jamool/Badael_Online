@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">{{ __('pcategory.pcategory') }}</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">

        <form class="form-inline" action="{{ route('portfoliocategories.store') }}" method="POST">
            @csrf
            <div class="form-group col-sm-7">
                    <div>
                        <label class="required" for="en_name">{{__('pcategory.Name english')}}</label>
                        <input type="text" name='en_name' class="form-control {{$errors->first('en_name') ? "is-invalid" : "" }} " value="{{old('en_name')}}" id="en_name">
                        @error('en_name')
                        <small class="form-text text-danger"> {{ $message }}</small>
                        @enderror
                    </div>
                    <div class="ml-2">
                        <label class="required" for="ar_name">{{__('pcategory.Name arabic')}}</label>
                        <input type="text" name='ar_name' class="form-control {{$errors->first('ar_name') ? "is-invalid" : "" }} " value="{{old('ar_name')}}" id="ar_name">
                        @error('ar_name')
                        <small class="form-text text-danger"> {{ $message }}</small>
                        @enderror
                    </div>
                <button type="submit" class="btn btn-primary ml-4 mt-4">{{ __('pcategory.create') }}</button>
            </div>
        </form>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>

                    <tr>

                        <th>{{ __('pcategory.no') }}</th>

                        <th>{{ __('pcategory.name') }}</th>

                        <th>{{ __('pcategory.option') }}</th>

                    </tr>

                </thead>

                <tbody>

                @php

                $no=0;

                @endphp

                @foreach ($pcategory as $pcategory)

                    <tr>

                        <td>{{ ++$no }}</td>

                        <td>{{ $pcategory->name }}</td>

                        <td>

                            <a href="{{route('portfoliocategories.edit', [$pcategory])}}" class="btn btn-info btn-sm"> {{ __('pcategory.edit') }} </a>

                            <form method="POST" action="{{route('portfoliocategories.destroy', [$pcategory])}}" class="d-inline" onsubmit="return confirm('Delete this pcategory permanently?')">

                                @csrf
                                @method('DELETE')

                                <input type="hidden" name="_method" value="DELETE">

                                <input type="submit" value="{{ __('pcategory.del') }}" class="btn btn-danger btn-sm">

                            </form>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>

@endpush
