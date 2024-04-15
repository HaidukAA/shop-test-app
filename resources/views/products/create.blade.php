
@extends('layouts.app')

@section('title', 'Добавить новый товар')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Добавить новый товар</h5>
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
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="article">Артикул:</label>
                            <input type="text" name="article" class="form-control" value="{{ old('article') }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Название:</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="price">Цена(грн):</label>
                            <input type="number" name="price" class="form-control" value="{{ old('price') }}">
                        </div>

                        <div class="form-group">
                            <label for="description">Описание:</label>
                            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="description">URL:</label>
                            <textarea name="slug" class="form-control">{{ old('slug') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Добавить товар</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
