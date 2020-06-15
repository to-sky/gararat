<a href="{{ $href }}"
   class="@if(isset($classes)) {{ $classes }} @else btn btn-outline-danger btn-sm bg-white @endif"
   title="Delete"
   data-toggle="modal"
   data-target="#deleteItemModal"
   data-modal-body-text="{{ $modalText }}"
>
    <i class="ti-trash text-danger"></i>
</a>