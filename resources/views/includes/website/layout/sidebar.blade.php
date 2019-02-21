<div class="sidebar">
    <h3>{{ $pageTitle }} Catalog</h3>
    <ul>
        @foreach($catalogChilds as $child)
            <li><a href="{{ route('catalogPage', $child->cid) }}">{{ $child->cat_name_en }}</a></li>
        @endforeach
    </ul>
</div>
<!-- /.sidebar -->
