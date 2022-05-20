@if (Route::has('password.request'))
   <a class="btn btn-link" href="{{ route('password.request') }}">
   {{ __('esqueceu sua senha?') }}
    </a>
@endif