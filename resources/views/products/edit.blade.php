@extends('layouts.app')

@section('title', 'Редактировать товар')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Редактировать товар</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="article">Артикул:</label>
                            <input type="text" name="article" class="form-control" value="{{ old('article', $product->article) }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Название:</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">
                        </div>
                        <div class="form-group">
                            <label for="price">Цена(грн):</label>
                            <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Описание:</label>
                            <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="slug">URL:</label>
                            <textarea name="slug" class="form-control">{{ old('slug', $product->slug) }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
