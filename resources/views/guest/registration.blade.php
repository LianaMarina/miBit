@extends('layout/app')

@section('title')
    Регистрация
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
    <div class="container" id="registrationPage">
        <div class="" :class="message ? 'alert alert-success' : ''">
            @{{ message }}
        </div>
        <div class="d-flex justify-content-center">
            <form class="p-5 col-6 rounded" id="formReg" @submit.prevent="Reg">
                <h2 class="mb-4">Регистрация</h2>
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
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Повторите пароль</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        :class="errors.password ? 'is-invalid' : ''">
                    <div class="invalid-feedback" v-for="error in errors.password">
                        @{{ error }}
                    </div>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="rule" name="rule"
                        :class="errors.rule ? 'is-invalid' : ''">
                    <label class="form-check-label" for="rule">Согласие на обработку персональных данных</label>
                    <div class="invalid-feedback" v-for="error in errors.rule">
                        @{{ error }}
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn"
                        style="background-color: #950FFF; font-size: 16px; padding: 5px 30px; font-weight: 500;">Регистрация</button>
                </div>
            </form>
        </div>
        <div class="d-flex justify-content-center">
            <div class="p-3 col-6 rounded my-5 d-none" style="background-color: #282933;" id="block_choose_favorite">
                <p>Любимые жанры</p>
                <div class="genre-selector">
                    @foreach ($genres as $genre)
                        <button class="genre-btn btn" data-genre="{{ $genre->id }}">{{ $genre->title }}</button>
                    @endforeach
                    <div class="d-flex justify-content-end mt-3">
                        <button @click="sendFavGenres" id="submit-btn" class="btn"
                            style="background-color: #950FFF; font-size: 16px; padding: 5px 30px; font-weight: 500;">Сохранить</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        const app = {
            data() {
                return {
                    message: '',
                    errors: [],
                    selectedGenres: [],
                }
            },
            methods: {
                async Reg() {
                    let form = document.getElementById('formReg');
                    let form_data = new FormData(form);
                    const response = await fetch('{{ route('registration') }}', {
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
                        }, 1000);
                    }
                    if (response.status == 200) {
                        this.message = await response.json();
                        setTimeout(() => {
                            this.message = '';
                        }, 1000);
                        form.reset();
                        let favorite_choose = document.getElementById('block_choose_favorite');
                        favorite_choose.classList.remove('d-none');
                        form.classList.add('d-none');
                    }
                },
                async sendFavGenres() {
                    let genreBtns = document.querySelectorAll('.genre-btn');
                    let genres = [];
                    genreBtns.forEach(function(btn) {
                        if (btn.classList.contains('active_genre')) {
                            genres.push(btn.getAttribute(
                                'data-genre')); // Добавляем выбранный жанр в массив
                        }
                    });
                    this.selectedGenres = genres;
                    const response = await fetch('{{ route('sendFavGenres') }}', {
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            selectedGenres: this.selectedGenres,
                        })
                    });
                    if (response.status == 200) {
                        this.message = await response.json();
                        setTimeout(() => {
                            this.message = [];
                        }, 10000);
                        window.location = '{{ route('welcome') }}';
                    }
                },
            },
            mounted() {
                let genreBtns = document.querySelectorAll('.genre-btn');
                genreBtns.forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        this.classList.toggle('active_genre'); // Переключаем класс при клике
                    });
                });

            }
        }
        Vue.createApp(app).mount('#registrationPage');
    </script>
@endsection
