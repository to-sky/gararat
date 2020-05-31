@if($message = session('success') ?? session('error') ?? false)
    @php($alertStatus = session('success') ? 'alert-success' : 'alert-danger')

    <div class="alert {{ $alertStatus }} alert-dismissible animate__animated animate__slideInDown text-white alert-popup"
         role="alert" data-auto-close="3000">
        <i class="fas fa-check-circle"></i> {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif