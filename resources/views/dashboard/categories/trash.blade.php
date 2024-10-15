@extends('layout.dashboard')

@section('titleContent', 'Categories')

@section('breadcrumb')
<!-- عشان ميحصلش override من الابن للاب -->
@parent
<li class="breadcrumb-item"><a href="/dashboard/categories">Categories</a></li>
<li class="breadcrumb-item"><a href="#">Home</a></li>

@endsection

@section('add_btn')
    <button class="btn btn-success m-4">
        <i class="fas fa-plus">
            <a href="{{ route('categories.create') }}" class="text-white">
                Add Category
            </a>

        </i>
    </button>
@endsection






@section('content')

<x-alert type="success" info="success"  msg="Category created successfully" />
<x-alert type="delete" info="danger"/>

<form action="{{URL::current()}}" method="get" class="d-flex col-12 justify-content-between">
    <input type="text" name="name" placeholder="Enter Name" class="form-control">
    <select name="status" id="status" class="form-control mx-4">
        <option value="">All</option>
        <option value="archived">Archived</option>
        <option value="active">Active</option>
    </select>
    <button class="btn btn-dark" type="submit">Filter</button>


</form>

    <table class="table table-responsive">
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                {{-- <th>Image</th> --}}
                <th>Status</th>
                <th>Deleted At</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>


            @forelse ($categories as $category)
                <tr>
                    <td>
                        <img src="{{ asset($category->image) }}" alt="category" class="w-50 h-50">

                    </td>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    {{-- <td>{{ $category->image }}</td> --}}
                    <td>{{ $category->status }}</td>
                    <td>{{ $category->deleted_at }}</td>

                    <td>
                        <form action="{{ route('categories.restore', $category->id) }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-danger">Restore</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('categories.force-delete', $category->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="delete">
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Force Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No Categories definded</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- AppServiceProvider --}}
    {{-- Paginator::useBootstrap(); --}}

    {{-- withQueryString() عشان لو عندي سرش او فلتر يفضل محافظ عليهم وانا بتنقل بين الصفحات --}}
    {{$categories->withQueryString()->links()}}

    {{-- لو عندي تصميم خاص ل pagination انا عاملو --}}
    {{-- {{$categories->withQueryString()->links('folderName')}} --}}

@endsection



@push('styles')
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
@endpush
