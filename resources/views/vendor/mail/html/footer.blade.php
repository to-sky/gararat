<tr>
<td>
<table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td class="content-cell" align="center" style="padding-bottom: 0;">
    @php
        $facebook = DB::select('select * from settings where `key` = ?', ['facebook'])
                        ? DB::select('select * from settings where `key` = ?', ['facebook'])[0]->value
                        : null;

        $youtube = DB::select('select * from settings where `key` = ?', ['youtube'])
                    ? DB::select('select * from settings where `key` = ?', ['youtube'])[0]->value
                    : null;

        $whatsapp = DB::select('select * from settings where `key` = ?', ['whatsapp'])
                    ? DB::select('select * from settings where `key` = ?', ['whatsapp'])[0]->value
                    : null;
    @endphp

    @if($facebook)
    <a href="{{ $facebook }}" target="_blank">
        <img src="{{ asset('images/icons/facebook.svg') }}" alt="Facebook" class="social-logo">
    </a>
    @endif

    @if($youtube)
    <a href="{{ $youtube }}" target="_blank">
        <img src="{{ asset('images/icons/youtube.svg') }}" alt="Youtube" class="social-logo">
    </a>
    @endif

    @if($whatsapp)
    <a href="https://api.whatsapp.com/send?phone={{ $whatsapp }}" target="_blank">
        <img src="{{ asset('images/icons/whatsapp.svg') }}" alt="WhatsApp" class="social-logo">
    </a>
    @endif

</td>
</tr>
<tr>
<td class="content-cell" align="center" style="padding-top: 15px;">
{{ Illuminate\Mail\Markdown::parse($slot) }}
</td>
</tr>
</table>
</td>
</tr>