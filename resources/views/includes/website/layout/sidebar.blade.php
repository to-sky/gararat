<div class="sidebar">
    <h3>Catalog</h3>
    <ul>
        @foreach($catalogChilds as $child)
            <li><a href="{{ route('catalogPage', $child->cat_number) }}">{{ $child->cat_name_en }}</a></li>
        @endforeach
    </ul>
</div>
<!-- /.sidebar -->