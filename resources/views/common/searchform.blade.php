<?php
$q = !empty($request['q']) ? $request['q'] : '';
$sort = !empty($request['sort']) ? $request['sort'] : '';;
?>
<div class="form-inline my-2 my-lg-0">
<form method="GET" action="{{ route('items.search') }}" accept-charset="UTF-8">
    <input class="form-control mr-sm-2" name="q" type="search" value="{{ $q }}">
        <select name="sort" class="custom-select custom-select-lg mb-3">
    <option value="updatedAtDesc" selected="selected">新しい順</option>
            <option value="updatedAtAsc">古い順</option>
            <option value="priceAsc">価格が安い順</option>
            <option value="priceDesc">価格が高い順</option>
        </select>
    <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="検索">
</form>
</div>