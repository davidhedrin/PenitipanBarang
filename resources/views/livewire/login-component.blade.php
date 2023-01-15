<div>
    <style>
        .alertMsg {
            position: fixed;
            margin-top: 20px;
            margin-right: 20px;
            width: 350px;
            top: 0;
            right: 0;
        }
        .fill {
            display: flex;
            justify-content: center;
            padding: 45px;
        }
        .fill img {
            flex-shrink: 0;
            width: 370px;
        }
        @media (max-width: 769px) {
            .fill img {
                width: 300px;
            }
        }
    </style>
    @if (Session::has('msgLimitRequest'))
        <div class="bs-toast toast fade show bg-warning alertMsg" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold">Warning!</div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ Session::get('msgLimitRequest') }} <strong>{{ Session::get('msgLimitSecRequest') }} detik</strong>
            </div>
        </div>
    @elseif (Session::has('msgFlagN'))
        <div class="bs-toast toast fade show bg-warning alertMsg" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold">Warning!</div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ Session::get('msgFlagN') }}
            </div>
        </div>
    @elseif (Session::has('msgFlagNull'))
        <div class="bs-toast toast fade show bg-info alertMsg" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold">Information!</div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ Session::get('msgFlagNull') }}
            </div>
        </div>
    @elseif (Session::has('msgPassWrong'))
        <div class="bs-toast toast fade show bg-danger alertMsg" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold">Danger!</div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ Session::get('msgPassWrong') }}
            </div>
        </div>
    @elseif (Session::has('msgUserNotFound'))
        <div class="bs-toast toast fade show bg-dark alertMsg" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold">Information!</div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ Session::get('msgUserNotFound') }}
            </div>
        </div>
    @elseif (Session::has('msgExcLogin'))
        <div class="bs-toast toast fade show bg-warning alertMsg" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold">System!</div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ Session::get('msgExcLogin') }}
            </div>
        </div>
    @elseif (Session::has('msgSuccessRegis'))
        <div class="bs-toast toast fade show bg-success alertMsg" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold">Selamat!</div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ Session::get('msgSuccessRegis') }}
            </div>
        </div>
    @endif
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 fill">
                            <img src="{{ asset('assets/img/avatars/image_login.svg') }}" alt="Login">
                        </div>
                        <div class="col-md-6">
                            <!-- Logo -->
                            <div class="app-brand justify-content-center">
                                <a href="index.html" class="app-brand-link gap-2">
                                    <span class="app-brand-logo demo">
                                        <img src="{{ asset('assets/img/icons/AsputBox.svg') }}" alt="AsputBox"
                                            width="300">
                                    </span>
                                </a>
                            </div>
                            <!-- /Logo -->
                            <div class="text-center">
                                <h4 class="mb-0 mt-3">Penitipan Barang Asrama Putra</h4>
                                <p class="mb-4">Universitas Advent Indonesia</p>
                            </div>

                            <form wire:submit.prevent="checkUserLogin" wire:ignore.self>
                                <div class="mb-3">
                                    {{-- <label for="email" class="form-label">email</label> --}}
                                    <div>
                                        <input wire:model="email" class="form-control" type="text"
                                            name="email" placeholder="Masukkan email anda" autocomplete="off">
                                    </div>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 form-password-toggle">
                                    <div class="d-flex justify-content-between">
                                        {{-- <label class="form-label" for="password">Password</label> --}}
                                    </div>
                                    <div class="input-group input-group-merge">
                                        <input wire:model="password" type="password" id="password"
                                            class="form-control" name="password" placeholder="***********"
                                            aria-describedby="password" />
                                        <span class="input-group-text cursor-pointer"><i
                                                class="bx bx-hide"></i></span>
                                    </div>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-check d-flex justify-content-between">
                                        <div>
                                            <input class="form-check-input" type="checkbox" id="remember-me" />
                                            <label class="form-check-label" for="remember-me"> Ingat saya</label>
                                        </div>

                                        <a href="auth-forgot-password-basic.html">
                                            <small>Lupa Password?</small>
                                        </a>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
                                </div>
                            </form>

                            <p class="text-center">
                                <span>Belum punya akun?</span>
                                <a href="{{ route('register') }}">
                                    <span>daftar disini.</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>
