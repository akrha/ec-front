@extends('common.main')

@section('title')
お気に入り商品一覧
@endsection

@section('body')
@foreach ($items as $item)
@if ($item->favorite_id)
<h2>{{ $item->item_name }}</h2>
    説明：
    <pre>{{ $item->description }}</pre>
    価格：
    <p>{{ $item->price }} 円</p>
    画像：
    <p><img src="/{{ $item->photo_url }}" alt=""></p>

    <a href="{{ route('items.detail', ['item_id' => $item->id]) }}">商品詳細</a>

    {!! Form::open(['route' => 'favorites.destroy']) !!}
    {!! Form::hidden('item_id', $item->id) !!}
    {!! Form::submit('お気に入りから削除💔') !!}
    {!! Form::close() !!}
@endif
@endforeach
@endsection
