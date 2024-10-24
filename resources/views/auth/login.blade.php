@extends('layout.master')
@section('title', 'Menu home')


@section('script')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('loginForm', () => ({
                cellPhone: '',
                otp: '',
                login_token: '',
                error: '',
                loading: '',
                loadingResend: false,
                checkOtpForm: false,

                seconds: 10,
                minutes: 0,

                async login() {
                    this.loading = true;
                    const res = await fetch('{{ url('/login') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            'cellphone': this.cellPhone,
                            '_token': '{{ csrf_token() }}',
                        })
                    })
                    const data = await res.json();
                    this.loading = false;
                    if (res.ok) {
                        this.login_token = data.login_token
                        console.log(this.login_token)
                        this.checkOtpForm = true
                        this.timer();
                        this.error = '';
                    } else {
                        this.error = data.message;
                    }
                },
                async checkOtp() {
                    this.loading = true;
                    const res = await fetch('{{ url('/check-otp') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            '_token': '{{ csrf_token() }}',
                            'otp': this.otp,
                            'login_token': this.login_token,
                        })
                    })
                    const data = await res.json();
                    this.loading = false;
                    if (res.ok) {
                        document.location.href = '{{ route('home') }}'
                        this.error = '';
                    } else {
                        this.error = data.message;
                    }
                },
                async resendOtp() {
                    this.loadingResend = true;
                    const res = await fetch('{{ url('/resend-otp') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            '_token': '{{ csrf_token() }}',
                            'otp': this.otp,
                            'login_token': this.login_token
                        })
                    });

                    const data = await res.json();
                    this.loadingResend = false;
                    // console.log(data);

                    if (res.ok) {
                        this.login_token = data.login_token;
                        this.seconds = 10;
                        this.minutes = 0;
                        this.timer();
                        this.error = '';
                    } else {
                        this.error = data.message;
                    }
                },

                timer() {
                    const interval = setInterval(() => {
                        // console.log(this.seconds);
                        if (this.seconds > 0) {
                            this.seconds = this.seconds - 1;
                        }

                        if (this.seconds === 0) {
                            if (this.minutes === 0) {
                                clearInterval(interval);
                            } else {
                                this.seconds = 59;
                                this.minutes = this.minutes - 1;
                            }
                        }
                    }, 1000);
                },



            }));

        });
    </script>
@endsection

@section('content')
    <section class="auth_section book_section">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-4 offset-md-4">
                    <div x-data="loginForm" class="card">
                        <div class="card-body">
                            <div class="form_container">
                                <template x-if="!checkOtpForm">
                                    <div>
                                        <div class="mb-3">
                                            <label class="form-label">شماره موبایل</label>
                                            <input x-model="cellPhone" type="text" class="form-control mb-2" />
                                            <div class="form-text text-danger" x-text="error"></div>
                                        </div>
                                        <button @click="login()" type="type" class="btn btn-primary btn-auth">ورود
                                            <div x-show="loading" class="spinner-border spinner-border-sm ms-2"></div>
                                        </button>
                                    </div>
                                </template>
                                <template x-if="checkOtpForm">
                                    <div>
                                        <div class="mb-3">
                                            <label class="form-label">کد ورود</label>
                                            <input x-model="otp" type="text" class="form-control mb-2" />
                                            <div class="form-text text-danger" x-text="error"></div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-baseline">
                                            <button @click="checkOtp()" type="submit"
                                                class="btn btn-primary btn-auth">ارسال
                                                <div x-show="loading" class="spinner-border spinner-border-sm ms-2"></div>
                                            </button>

                                            <template x-if="seconds > 0 || minutes > 0">
                                                <div class="mb-1 me-3">
                                                    <span x-text="seconds < 10 ? `0${seconds}` : seconds"></span>:
                                                    <span x-text="minutes < 10 ? `0${minutes}` : minutes"></span>
                                                </div>
                                            </template>

                                            <template x-if="seconds == 0 && minutes == 0">
                                                <button @click="resendOtp" type="submit" class="btn btn-dark">ارسال دوباره
                                                    <div x-show="loadingResend"
                                                        class="spinner-border spinner-border-sm ms-2"></div>
                                                </button>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
