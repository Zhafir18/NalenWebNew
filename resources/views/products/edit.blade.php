@extends('layout')

@section('title', 'Edit Product')

@section('content')
<main class="container py-5">
    <div>
        <h4>Edit Product</h4>
    </div>
    <form action="{{ route('products.update', ['product_id' => $product->product_id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <table class="table table-borderless">
            <tbody>
            <tr>
                <td><label for="productName">Name</label></td>
                <td>
                    <input type="text" name="productName" class="form-control" id="productName" value="{{ old('productName', $product->product_name) }}">
                    @error('productName')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td><label for="productDescription">Description</label></td>
                <td>
                    <input type="text" name="productDescription" class="form-control" id="productDescription" value="{{ old('productDescription', $product->product_description) }}">
                    @error('productDescription')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td><label for="productPrice">Price</label></td>
                <td>
                    <input type="text" name="productPrice" class="form-control" id="productPrice" value="{{ old('productPrice', $product->product_price) }}">
                    @error('productPrice')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td><label for="productLink">Link</label></td>
                <td>
                    <input type="text" name="productLink" class="form-control" id="productLink" value="{{ old('productLink', $product->product_link) }}">
                    @error('productLink')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td><label for="productImageFile">Photo</label></td>
                <td>
                    @php
                        $images = json_decode($product->product_image, true);
                    @endphp
                    @if(is_array($images))
                        @foreach ($images as $image)
                            <img src="{{ asset('images/' . $image) }}" alt="Product Image" class="img-fluid" style="max-width: 100px; height: auto; display: inline-block; margin-right: 5px;">
                        @endforeach
                    @else
                        <img src="{{ asset('images/' . $product->product_image) }}" alt="Product Image" class="img-fluid" style="max-width: 100px; height: auto;">
                    @endif
                </td>
            </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-success">Submit</button>
        <a class="btn btn-secondary" href="{{ route('products.index') }}">Cancel</a>
    </form>
</main>
@endsection
