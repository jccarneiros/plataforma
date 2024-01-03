@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($rooms as $room)
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-3">
                <span class="btn btn-sm btn-outline-info text-center w-100">{{$room->tipoEnsino->name}} - {{$room->name}} - ({{$room->students->count()}})</span>
            </div>
        @endforeach
    </div>
    <div class="container">
        <div class="row">
{{--            <div id="calendar"></div>--}}
        </div>
    </div>
@endsection
@push('scripts')

@endpush