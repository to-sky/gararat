<div class="sidebar">
    <h3>{{ $pageTitle }} Catalog</h3>
    <ul>
        @if(count($catalogChilds) !== 0)
            @foreach($catalogChilds as $child)
                <li><a href="{{ route('catalogPage', $child->cid) }}">{{ $child->cat_name_en }}</a></li>
            @endforeach
        @else
            <li><a href="{{ route('catalogPage', $parentCatalog->cid) }}"><i class="fas fa-arrow-left"></i> Return to {{ $parentCatalog->cat_name_en }}</a></li>
        @endif
    </ul>
</div>
<!-- /.sidebar -->
