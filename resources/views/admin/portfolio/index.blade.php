@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">{{__('portfolio.portfolio')}}</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">

        <a href="{{ route('portfolios.create') }}" class="btn btn-success">{{ __('portfolio.Create portfolio') }}</a>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>

                    <tr>

                        <th>{{ __('portfolio.no') }}</th>

                        <th>{{ __('portfolio.cover') }}</th>

                        <th>{{ __('portfolio.name') }}</th>

                        <th>{{ __('portfolio.Project date') }}</th>

                        <th>{{ __('portfolio.option') }}</th>

                    </tr>

                </thead>

                <tbody>

                @php

                $no=0;

                @endphp

                @foreach ($portfolio as $portfolio)

                    <tr>

                        <td>{{ ++$no }}</td>

                        <td>

                            <img src="{{ asset('storage/'.$portfolio->cover) }}" alt="" style="height: 100px; width: 200px">

                        </td>

                        <td>{{ $portfolio->name }}</td>

                        <td>{{ $portfolio->date }}</td>

                        <td>

                            <a href="{{route('portfolios.edit', [$portfolio])}}" class="btn btn-info btn-sm"> {{ __('portfolio.edit') }} </a>

                            <form method="POST" action="{{route('portfolios.destroy', [$portfolio])}}" class="d-inline" onsubmit="return confirm('Delete this portfolio permanently?')">

                                @csrf
                                @method('DELETE')

                                <input type="hidden" name="_method" value="DELETE">

                                <input type="submit" value="{{ __('portfolio.delete') }}" class="btn btn-danger btn-sm">

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
