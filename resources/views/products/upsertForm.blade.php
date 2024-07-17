<!-- resources/views/products/create.blade.php -->
@extends('layout')

@section('title', 'Add Product')

@section('content')
<main class="container py-5">
    <div>
        <h4>Add Product</h4>
    </div>
    <form class="upsert-form" method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        <table class="table table-borderless">
            <tbody>
            <tr>
                <td><label for="productName">Name</label></td>
                <td>
                    <input type="text" name="productName" class="form-control" id="productName" value="{{ old('productName') }}">
                    @error('productName')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td><label for="productDescription">Description</label></td>
                <td>
                    <input type="text" name="productDescription" class="form-control" id="productDescription" value="{{ old('productDescription') }}">
                    @error('productDescription')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td><label for="productPrice">Price</label></td>
                <td>
                    <input type="text" name="productPrice" class="form-control" id="productPrice" value="{{ old('productPrice') }}">
                    @error('productPrice')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td><label for="productLink">Link</label></td>
                <td>
                    <input type="text" name="productLink" class="form-control" id="productLink" value="{{ old('productLink') }}">
                    @error('productLink')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td><label for="productImageFile">Photo</label></td>
                <td>
                    <input type="file" name="productImageFiles[]" class="form-control-file" id="productImageFiles" multiple>
                    @error('productImageFiles')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    @foreach ($errors->get('productImageFiles.*') as $message)
                    <div class="text-danger">{{ $message[0] }}</div>
                    @endforeach
                </td>
            </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-success">Submit</button>
        <a class="btn btn-secondary" href="{{ route('products.index') }}">Cancel</a>
    </form>
</main>
@endsection
