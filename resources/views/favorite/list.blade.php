@extends('common.main')

@section('title')
お気に入り商品一覧
@endsection

@section('body')
@foreach ($items as $item)
<div class="media">
    @if ($item->photo_url)
    <img src="/{{ $item->photo_url }}" class="img-thumbnail" style="width:30%">
    @else
    <img src="/no_photo.png"class="img-thumbnail w-3" style="width:30%">
    @endif
    <div class="media-body">
        <h5 class="mt-0">{{ $item->item_name }}</h5>
        {{ $item->description }}
        <p style="color:red">{{ $item->price }} 円</p>
        <a class="btn btn-success" href="{{ route('items.detail', ['item_id' => $item->id]) }}">商品詳細</a>
        @if (Auth::id())
        @if ($item->favorite_id)
        {!! Form::open(['route' => 'favorites.destroy']) !!}
        {!! Form::hidden('item_id', $item->id) !!}
        <input class="btn btn-outline-danger" type="submit" value="お気に入りから削除💔">            {!! Form::close() !!}
        @else
        {!! Form::open(['route' => 'favorites.create']) !!}
        {!! Form::hidden('item_id', $item->id) !!}
        <input class="btn btn-light" type="submit" value="お気に入りに追加❤️">
        {!! Form::close() !!}
        @endif
        @endif
    </div>
</div>
@endforeach
{{ $items->links() }}
@endsection
