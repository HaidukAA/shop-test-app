@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ $product->name }}</h5>
                </div>
                <div class="card-body">
                    <p><strong>Артикул:</strong> {{ $product->article }}</p>
                    <p><strong>Цена(грн):</strong> {{ $product->price }}</p>
                    <p><strong>Описание:</strong> {{ $product->description }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
