@extends('common.main')

@section('title')
TOP PAGE
@endsection

@section('body')
<h1>キーワードから探す</h1>
@include('common.searchform')
<h1>ラベルから探す</h1>
@foreach ($tags as $tag)
<a href="{{ route('items.search', ['tag_id' => $tag['id']]) }}" class="btn btn-warning">{{ $tag['name'] }}</a>
@endforeach
@endsection