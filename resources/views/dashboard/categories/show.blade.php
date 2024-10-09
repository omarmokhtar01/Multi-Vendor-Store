@extends('layout.dashboard')

@section('titleContent', 'Category')

@section('breadcrumb')
    <!-- عشان ميحصلش override من الابن للاب -->
    @parent
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Home</a></li>

@endsection






@section('content')
    <div class="col-12 text-center">


        <img src="{{ asset($category->image) }}" alt="category" class="w-75 h-75">
        <h2 class="text-bold">{{ $category->name }} ({{ $category->id }})</h2>
        <p>{{ $category->description }}</p>
        <p>{{ $category->created_at }}</p>

        @if ($category->status === 'active')
            <h4 class="text-success">

                {{ $category->status }}
            </h4>
        @else
            <h4 class="text-danger">

                {{ $category->status }}
            </h4>
        @endif


    </div>

@endsection







@push('styles')
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
@endpush
