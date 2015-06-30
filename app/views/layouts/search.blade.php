<div id="search">
    <form action="/Search" method="get">
        <input type="text" name="search_content" placeholder="@if(!empty($search_content)){{$search_content}}@endif" class="form-control" id="search_text"/>
        <input type="submit" class="btn btn-primary" value="搜书"/>
    </form>
</div>