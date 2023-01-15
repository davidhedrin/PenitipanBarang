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
        
        .authentication-wrapper2.authentication-basic2 {
            width: 850px;
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            margin: auto;
            /*Solves a problem in which the content is being cut when the div is smaller than its' wrapper:*/
            max-width: 100%;
            max-height: 100%;
            overflow: auto;
            margin-top: 6%;
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
            .authentication-wrapper2.authentication-basic2{
                width: auto;
                margin-top: auto;
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
    @endif
    <div class="container-xxl">
        <div class="authentication-wrapper2 authentication-basic2 container-p-y">
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <a href="{{ route('home') }}" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="{{ asset('assets/img/icons/AsputBox.svg') }}" alt="AsputBox" width="300">
                            </span>
                        </a>
                    </div>
                    <div class="text-center">
                        <h4 class="mb-0 mt-3">Pendaftaran AsputBox</h4>
                        <p class="mb-4">Universitas Advent Indonesia</p>
                    </div>
                    <!-- /Logo -->
                    <form wire:submit.prevent="addDataToDb()" wire:ignore.self>
                        <div class="row">
                            <div class="col-md-6">
                                {{-- <img src="{{ asset('assets/img/avatars/image_login.svg') }}" alt="Login"> --}}
                                <div class="mb-3">
                                    {{-- <label for="email" class="form-label">No Ponsel:</label> --}}
                                    <div>
                                        <input wire:model="name" class="form-control" type="text"
                                            placeholder="Masukkan Nama Lengkap" autocomplete="off">
                                    </div>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 form-password-toggle">
                                    <div class="d-flex justify-content-between">
                                        {{-- <label class="form-label" for="password">Password:</label> --}}
                                    </div>
                                    <div class="input-group input-group-merge">
                                        <input wire:model="password" type="password" class="form-control"
                                            name="password" placeholder="Masukkan Password"
                                            aria-describedby="password" />
                                        <span class="input-group-text cursor-pointer"><i
                                                class="bx bx-hide"></i></span>
                                    </div>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 form-password-toggle">
                                    <div class="d-flex justify-content-between">
                                        {{-- <label class="form-label" for="password">Ko-Password:</label> --}}
                                    </div>
                                    <div class="input-group input-group-merge">
                                        <input wire:model="ko_password" type="password" class="form-control"
                                            placeholder="Masukkan Ko-Password" aria-describedby="password" />
                                        <span class="input-group-text cursor-pointer"><i
                                                class="bx bx-hide"></i></span>
                                    </div>
                                    @error('ko_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    {{-- <label for="email" class="form-label">Email:</label> --}}
                                    <div>
                                        <input wire:model="email" class="form-control" type="text"
                                            placeholder="Masukkan Email Anda" autocomplete="off">
                                    </div>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    {{-- <label for="email" class="form-label">No Ponsel:</label> --}}
                                    <div>
                                        <input wire:model="no_phone" class="form-control" type="text"
                                            placeholder="Masukkan No Ponsel" autocomplete="off">
                                    </div>
                                    @error('no_phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div>
                                        <select class="form-select" wire:model="gander">
                                            <option>Pilih Gander</option>
                                            <option value="1">Laki-laki</option>
                                            <option value="2">Perempuan</option>
                                        </select>
                                    </div>
                                    @error('gander')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check d-flex justify-content-center">
                                <div>
                                    <input wire:model="acc_term" class="form-check-input" type="checkbox"
                                        id="remember-me" value="Y" />
                                    <label class="form-check-label" for="remember-me"> Saya menyetujui
                                        peraturan AsputBox</label>
                                </div>
                            </div>
                            <span class="d-flex justify-content-center">
                                @error('acc_term')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Daftar
                                Sekarang</button>
                        </div>
                    </form>
                    <p class="text-center">
                        <span>Sudah punya akun?</span>
                        <a href="{{ route('login') }}">
                            <span>login disini.</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
