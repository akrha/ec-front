<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TOP PAGE</title>
</head>
<body>
    <h1>キーワードから探す</h1>
    @include('common.searchform')
    <h1>ラベルから探す</h1>
    @foreach ($tags as $tag)
    <a href="{{ route('items.search', ['tag_id' => $tag['id']]) }}">{{ $tag['name'] }}</a>
    @endforeach
</body>
</html>