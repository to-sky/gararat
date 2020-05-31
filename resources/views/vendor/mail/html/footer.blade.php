{{-- TODO: add dinamic social links --}}
<tr>
<td>
<table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td class="content-cell" align="center" style="padding-bottom: 0;">
    <a href="https://www.facebook.com/gararatcom" class="" target="_blank">
        <img src="{{ asset('images/icons/facebook.svg') }}" alt="Facebook" class="social-logo">
    </a>
    <a href="https://www.youtube.com/channel/UCoBI2FCQzx4tMEUbMpVphJw" class="" target="_blank">
        <img src="{{ asset('images/icons/youtube.svg') }}" alt="Youtube" class="social-logo">
    </a>
    <a href="https://api.whatsapp.com/send?phone=00201016200599" class="" target="_blank">
        <img src="{{ asset('images/icons/whatsapp.svg') }}" alt="WhatsApp" class="social-logo">
    </a>
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
