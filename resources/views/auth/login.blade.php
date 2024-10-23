@extends('layout.master')
@section('title', 'Menu home')


@section('script')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('loginForm', () => ({
                cellPhone: '',
                error: '',
                loading: '',

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
                        this.error = '';
                    } else {
                        this.error = data.message;
                    }
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
