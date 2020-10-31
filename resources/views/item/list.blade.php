<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>出品中商品一覧</title>
</head>
<body>
@include('common.searchform')
    <h1>商品一覧</h1>
    @foreach ($items as $item)
    <h2>{{ $item->item_name }}</h2>
    説明：
    <pre>{{ $item->description }}</pre>
    価格：
    <p>{{ $item->price }} 円</p>
    画像：
    <p><img src="{{ $item->photo_url }}" alt=""></p>

    <a href="{{ route('items.detail', ['item_id' => $item->id]) }}">商品詳細</a>
    @endforeach
    @if (empty($item))
    お探しの商品は見つかりませんでした。
    @endif
@include('common.searchform')
</body>
</html>