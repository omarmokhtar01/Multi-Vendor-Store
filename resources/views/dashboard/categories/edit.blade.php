@extends('layout.dashboard')

@section('titleContent', 'Edit category')

@section('breadcrumb')
    <!-- عشان ميحصلش override من الابن للاب -->
    @parent
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Home</a></li>

@endsection






@section('content')
<div class="col-md-12">


        {{-- <img src="{{ $category->image }}" alt="category" class="w-75 h-75"> --}}

        <form action="{{ route('categories.update', $category->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group pt-5 px-5">
        {{-- <label for="name">Name</label> --}}
        <x-form.label>
            Name
        </x-form.label>

        <input name="name" class="form-control @error('name')is-invalid @enderror" type="text" value="{{ old('name', $category->name) }}">
        @error('name')
            <span class="text-danger invalid-feedback">{{ $message }}</span>
        @enderror



            <label for="name" class="mt-2">Image</label>
            <input type="file" name="image" class="form-control p-1 @error('image')is-invalid @enderror" id="image" placeholder="Enter image" accept="image/*">
            @error('image')
            <span class="text-danger invalid-feedback">{{ $message }}</span>
        @enderror

        <label for="name" class="mt-2">Description</label>

            <textarea name="description" class="form-control @error('description')is-invalid @enderror" id="description" cols="30" rows="10">
                {{old('description', $category->description) }}
            </textarea>
            @error('description')
            <span class="text-danger invalid-feedback">{{ $message }}</span>
        @enderror

            <label for="status" class="mt-2">Status</label>
            <select name="status" class="form-control @error('status')is-invalid @enderror" id="status">
                <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="archived" {{ $category->status == 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
            @error('status')
                    <span class="text-danger invalid-feedback">{{ $message }}</span>
                @enderror

            <div class="col-12 px-4 text-center w-100">
                <button  class="btn btn-success m-4 w-75" type="submit">
                    Save
                </button></div>


        </div>

        </form>






    </div>

@endsection







@push('styles')
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
@endpush
