@if($message = session('success') ?? session('error') ?? false)
    @php($alertStatus = session('success') ? 'alert-success' : 'alert-danger')

    <div class="alert {{ $alertStatus }} alert-dismissible animate__animated animate__slideInDown text-white alert-popup"
         role="alert" data-auto-close="3000">

        @if(is_array($message))
            @foreach($message as $text)
                <i class="fas @if(session('success')) fa-check-circle @else fa-exclamation-circle @endif"></i> {{ $text }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            @endforeach
        @else
            <i class="fas @if(session('success')) fa-check-circle @else fa-exclamation-circle @endif"></i> {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        @endif
    </div>
@endif