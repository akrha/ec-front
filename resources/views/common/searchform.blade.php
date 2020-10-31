<?php
$q = !empty($request['q']) ? $request['q'] : '';
$sort = !empty($request['sort']) ? $request['sort'] : '';;
?>
{!! Form::open(['route' => 'items.search', 'method' => 'get']) !!}
    {!! Form::text('q', $q) !!}
    {!! Form::select('sort', [
        'updatedAtDesc' => '新しい順',
        'updatedAtAsc' => '古い順',
        'priceAsc' => '価格が安い順',
        'priceDesc' => '価格が高い順'
    ], $sort) !!}
    {!! Form::submit('検索') !!}
{!! Form::close() !!}