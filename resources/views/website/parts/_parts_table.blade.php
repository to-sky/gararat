<div class="parts">
    <table class="border border-light-sm shadow-sm table table-borderless table-hover">
        <tbody>
        @foreach($parts as $part)
            <tr>
                <td>
                    <a href="{{ route('parts.show', $part) }}">
                        <img src="{{ $part->getFirstMediaUrl('main_image', 'thumb') }}" width="60">
                    </a>
                </td>
                <td>{{ $part->producer_id }}</td>
                <td>
                    <a href="{{ route('parts.show', $part) }}">{{ $part->trans('name') }}</a>
                </td>
                <td>{!! $part->displaySitePrice() !!}</td>
                <td>
                    @component('website.components.product_qty_input', ['product' => $part]) @endcomponent
                </td>
                <td>
                    <button class="btn btn-outline-danger" type="button">
                        <i class="fas fa-shopping-cart"></i>
                    </button>

                    @auth
                    <a href="{{ route('admin.parts.edit', $part) }}" class="btn btn-outline-muted" target="_blank">
                        <i class="fas fa-edit"></i>
                    </a>
                    @endauth
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="pagination__wrapper">
        {{ $parts->appends(request()->only(['catalogs', 'equipmentGroups', 'inStock', 'price']))->links() }}
    </div>
</div>