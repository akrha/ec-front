@extends('common.main')

@section('title')
出品中商品一覧
@endsection

@section('body')
@include('common.searchform')
    <h1>商品一覧</h1>
    @foreach ($items as $item)
    <h2>{{ $item->item_name }}</h2>
    説明：
    <pre>{{ $item->description }}</pre>
    価格：
    <p>{{ $item->price }} 円</p>
    画像：
    <p><img src="/{{ $item->photo_url }}" alt=""></p>

    <a href="{{ route('items.detail', ['item_id' => $item->id]) }}">商品詳細</a>

    @if (Auth::id())
    @if ($item->favorite_id)
    {!! Form::open(['route' => 'favorites.destroy']) !!}
    {!! Form::hidden('item_id', $item->id) !!}
    {!! Form::submit('お気に入りから削除💔') !!}
    {!! Form::close() !!}
    @else
    {!! Form::open(['route' => 'favorites.create']) !!}
    {!! Form::hidden('item_id', $item->id) !!}
    {!! Form::submit('お気に入りに追加❤️') !!}
    {!! Form::close() !!}
    @endif
    @endif

    @endforeach
    {{ $items->links() }}
    @if (empty($item))
    お探しの商品は見つかりませんでした。
    @endif
@include('common.searchform')
@endsection
