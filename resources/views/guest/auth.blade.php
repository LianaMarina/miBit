@extends('layout/app')

@section('title')
    Авторизация
@endsection

@section('content')
    <style>
        p,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        select,
        input,
        label,
        button {
            color: white !important;
        }

        .genre-btn {
            padding: 3px 35px;
            margin: 5px;
            cursor: pointer;
            background-color: #535156;
            border-radius: 50px;
        }

        .genre-btn.active_genre {
            background-color: #950FFF !important;
            color: #fff;
        }
    </style>
    <div class="container" id="authPage">
        <div class="" :class="message ? 'alert alert-success': ''">
            @{{ message }}
        </div>
        <div class="" :class="error ? 'alert alert-danger': ''">
            @{{ error }}
        </div>
        <div class="d-flex justify-content-center">
            <form class="p-5 col-6 rounded" id="formAuth" @submit.prevent="Auth">
                <h2 class="mb-4">Вход</h2>
                <div class="mb-3">
                    <label for="phone" class="form-label">Телефон</label>
                    <input type="phone" class="form-control" id="phone" name="phone"
                        :class="errors.phone ? 'is-invalid' : ''">
                    <div class="invalid-feedback" v-for="error in errors.phone">
                        @{{ error }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control" id="password" name="password"
                        :class="errors.password ? 'is-invalid' : ''">
                    <div class="invalid-feedback" v-for="error in errors.password">
                        @{{ error }}
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn"
                        style="background-color: #950FFF; font-size: 16px; padding: 5px 30px; font-weight: 500;">Войти</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const app = {
            data() {
                return {
                    message: '',
                    errors: [],
                    selectedGenres: [],
                    error: '',
                }
            },
            methods: {
                async Auth() {
                    let form = document.getElementById('formAuth');
                    let form_data = new FormData(form);
                    const response = await fetch('{{ route('auth') }}', {
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: form_data,
                    });
                    if (response.status == 400) {
                        this.errors = await response.json();
                        setTimeout(() => {
                            this.errors = [];
                        }, 10000);
                    }
                    if (response.status == 200) {
                        form.reset();
                        window.location = '{{ route('welcome') }}';
                    }
                    if (response.status == 401) {
                        this.error = await response.json();
                        setTimeout(() => {
                            this.error = '';
                        }, 10000);
                        form.reset();
                    }
                },
            },
        }
        Vue.createApp(app).mount('#authPage');
    </script>
@endsection
