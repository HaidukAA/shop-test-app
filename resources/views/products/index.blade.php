@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Список товаров</h1>
                    @auth
                        <a href="{{ route('products.create') }}" class="btn btn-primary">Добавить товар</a>
                    @endauth   
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Артикул</th>
                            <th>Название</th>
                            <th>Цена(грн)</th>
                            <th>Описание</th>
                            @auth
                                <th>Действия</th>
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->article }}</td>
                                <td>
                                <a href="{{ route('products.show', $product->slug) }}" class="link-opacity-100-hover">
                                    {{ $product->name }}
                                </a>
                            </td>

                                <td>{{ $product->price }}</td>
                                <td>{{ $product->description }}</td>
                                @auth
                                    <td>
                                        @can('update', $product)
                                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-primary">Редактировать</a>
                                        @endcan
                                        @can('delete', $product)
                                            <form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                                            </form>
                                        @endcan
                                    </td>
                                @endauth
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
