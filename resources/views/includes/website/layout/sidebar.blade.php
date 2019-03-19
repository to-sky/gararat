<div class="sidebar">
    <h3>{{ $pageTitle }} Catalog</h3>
    @if(count($catalogChilds) !== 0 && $currentCatalog->parent_cat != 0)
        <div class="sidebar__back">
            <a href="{{ route('catalogPage', $parentCatalog->cid) }}"><i class="fas fa-arrow-left"></i> Return to {{ $parentCatalog->cat_name_en }}</a>
        </div>
        <!-- /.sidebar__back -->
    @endif
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
@if(isset($preRenderedCatalog) && $preRenderedCatalog !== NULL)
    <div class="tree-sidebar">
        {!! $preRenderedCatalog !!}
    </div>
    <!-- /.tree-sidebar -->
@endif
