@extends('layout.dashboard')

@section('titleContent', 'Categories')

@section('breadcrumb')
    <!-- عشان ميحصلش override من الابن للاب -->
    @parent
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Home</a></li>

@endsection

@section('add_btn')

@endsection


@section('content')
    <div class="col-md-12">


        <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
            @csrf


            {{-- <div> --}}
            {{-- @if ($errors->has('name'))
    <span class="text-danger">{{ $errors->first('name') }}</span> --}}

            {{-- بترجع كل رسائل الخطأ --}}
            {{-- <span class="text-danger">{{ $errors->get('name') }}</span> --}}


            {{-- @endif --}}


            {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif --}}



            {{-- </div> --}}

            <div class="form-group pt-5 px-5">
                {{-- <label for="name">Name</label> --}}

                <x-form.label for="name">Name</x-form.label>


                {{-- old بتحفظلي القيمة السابقة في prev request --}}
                <input type="text" name="name" class="form-control @error('name')is-invalid @enderror" id="name" placeholder="Enter name" value="{{old('name')}}">

                @error('name')
                    <span class="text-danger invalid-feedback">{{ $message }}</span>
                @enderror

                {{-- <label for="slug" class="mt-2">Slug</label>
                <input type="text" name="slug" class="form-control" id="slug" placeholder="Enter slug"> --}}

                <label for="description" class="mt-2">Description</label>
                <textarea type="textarea" name="description" class="form-control @error('description')is-invalid @enderror" id="description" placeholder="Enter description">
                    {{old('description')}}
            </textarea>
            @error('description')
                    <span class="text-danger invalid-feedback">{{ $message }}</span>
                @enderror

                <label for="name" class="mt-2">Image</label>
                <input type="file" name="image" class="form-control p-1 @error('image')is-invalid @enderror" id="image" placeholder="Enter image" accept="image/*" value="{{old('image')}}">
                @error('image')
                    <span class="text-danger invalid-feedback">{{ $message }}</span>
                @enderror

                <label for="status" class="mt-2">Status</label>
                <select name="status" class="form-control @error('status')is-invalid @enderror" id="status"  value="{{old('status')}}">
                    <option value="active">Active</option>
                    <option value="archived">Archived</option>
                </select>
                @error('status')
                    <span class="text-danger invalid-feedback">{{ $message }}</span>
                @enderror

            </div>
            <div class="col-12 px-4 text-center w-100">
                <button class="btn btn-success m-4 w-75" type="submit">
                    Add
                </button>
            </div>



    </div>

    </form>



@endsection




@push('styles')
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
@endpush
