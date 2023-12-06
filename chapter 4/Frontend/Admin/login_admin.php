<div>
    <div class="auth-logo">
        <a href="{{ route('home') }}"><img src="{{ asset('assets/compiled/svg/logo.svg') }}" alt="Logo"></a>
    </div>
    <h1 class="auth-title">Login</h1>

    <form wire:submit='store' method="POST">
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="email" class="form-control form-control-xl" placeholder="Email" wire:model='email'>
            <div class="form-control-icon">
                <i class="bi bi-envelope"></i>
            </div>
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" class="form-control form-control-xl" placeholder="Password" wire:model='password'>
            <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Login</button>
    </form>
</div>

