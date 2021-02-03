<small class="va-t">{{ __('Share') }}&nbsp;|</small>

<a href="{!! Share::currentPage()->facebook()->getRawLinks() !!}" target="_blank">
    <i class="fab fa-facebook-square facebook-icon-color"></i>
</a>
<a href="{!! Share::currentPage()->whatsapp()->getRawLinks() !!}" target="_blank">
    <i class="fab fa-whatsapp-square whatsapp-icon-color"></i>
</a>

