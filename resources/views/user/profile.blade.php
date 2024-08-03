@extends('layout/app')

@section('title')
    Мой профиль
@endsection

@section('content')
    <style>
        h3 {
            color: white;
        }

        .be_artist_btn {
            border-radius: 10px;
            border: #950FFF 2px solid;
            color: #950FFF;
            font-weight: 500;
        }

        .be_artist_btn:hover {
            border-radius: 10px;
            border: #680baf 2px solid;
            color: #5b0c97;
            font-weight: 500;
        }

        input[type="file"] {
            color: white !important;
        }

        input[type="checkbox"] {
            background-color: #950FFF !important;
        }

        input[type="checkbox"]:checked {
            background-color: #950FFF !important;
        }

        .checkbox {
            color: #950FFF !important;
        }

        select {
            background-color: #282933 !important;
            border: #950FFF 1px solid !important;
        }

        p,
        h2,
        h3,
        h4,
        h5,
        h6,
        label {
            color: white !important;
        }

        .genre-btn,
        .genre-btn:hover {
            padding: 3px 35px;
            margin: 5px;
            cursor: pointer;
            background-color: #535156;
            border-radius: 50px;
            color: white;
        }

        .genre-btn.active_genre {
            background-color: #950FFF !important;
            color: #fff;
        }

        .modal input {
            background-color: white !important;
            color: black !important;
        }

        .modal label {
            color: black !important;
        }
       
        .options {
            margin-top: 10px;
            max-height: 100px;
            overflow-y: auto;
            padding: 0;
        }
        .options li {
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            border-bottom: 1px solid gray;
        }
        .options li:hover {
            background-color: #d8d8d8;
        }
        .my_works_btn {
            border-radius: 10px;
            border: #950FFF 2px solid;
            background-color: #950FFF !important;
            font-weight: 500;
            color: #ffffff !important;
        }
        .my_works_btn:hover {
            border-radius: 10px;
            border: #680baf 2px solid;
            background-color: #5b0c97 !important;
            color: rgba(255, 255, 255, 0.692) !important;
        }
    </style>
    <div id="userProfile">

        <div class="container" :class="message ? 'alert alert-success' : ''">
            @{{ message }}
        </div>
        <div class="container d-flex mb-5">
            <div class="col-3">
                <div class="">
                    @if ($user->img)
                        <img src="{{ asset('/public') . $user->img }}" alt=""
                            style="width: 250px; height: 250px; object-fit:cover; border-radius: 50%; object-position: center !important;">
                    @else
                        <img src="https://www.ilcn.pt/documents/19/631211/Photo+Placeholder/b00ab739-5b07-4031-b971-9c9c37f0a77c?t=1550504068121"
                            alt="" style="width: 280px; height: 280px; object-fit:cover; border-radius: 50%; object-position: center center;">
                    @endif
                    <div class="mt-3 d-grid gap-2" style="width: 280px;">
                        @if ($user->status == 'исполнитель')
                            <h5 style="text-align: center;">{{ $user->nickname }}</h5>
                            <button class="btn be_artist_btn" data-bs-toggle="modal" data-bs-target="#addModal">Добавить
                                трек/альбом</button>
                            <a href="{{ route('show_works_page') }}" class="btn my_works_btn">Мои работы</a>
                            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel"
                                                style="color: rgb(0, 0, 0) !important;">Добавление трека/альбома</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="choose_track_albom">Что вы хотите добавить</label>
                                                <select style="background-color: white !important;"
                                                    name="choose_track_albom" id="choose_track_albom"
                                                    :change="chooseFormat()" v-model="chooseForm" class="form-control">
                                                    <option selected value="0">Трек</option>
                                                    <option value="1">Альбом</option>
                                                </select>
                                            </div>
                                            <form id="add_track_form" style="background-color: white !important;"
                                                enctype="multipart/form-data" v-if="show_add_track"
                                                @submit.prevent="addTrack">
                                                <div class="mb-3">
                                                    <label for="img_track" class="form-label">Обложка трека</label>
                                                    <input type="file" class="form-control" id="img_track"
                                                        name="img_track" :class="errors.img_track ? 'is-invalid' : ''">
                                                    <div class="invalid-feedback" v-for="error in errors.img_track">
                                                        @{{ error }}
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="track_title" class="form-label">Название трека</label>
                                                    <input type="text" class="form-control" id="track_title"
                                                        name="track_title" :class="errors.track_title ? 'is-invalid' : ''">
                                                    <div class="invalid-feedback" v-for="error in errors.track_title">
                                                        @{{ error }}
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="choose_authors" class="form-label">Выбрать
                                                        исполнителей</label>
                                                        <select v-for="num in choose_authors" name="choose_authors_select[]" id="choose_authors" class="form-control mb-2" style="background-color: white !important; color: black !important;">
                                                            <option style="color:black !important;" class="option" v-for="author in authors" :id="author.id" :value="author.id">@{{ author.nickname }}</option>
                                                        </select> 
                                                        <div class="d-flex justify-content-center" @click="addField">
                                                            <button type="button" class="btn btn-dark mt-3"><i class="bi bi-plus"></i></button>
                                                        </div>
                                                </div>        
                                                <div class="mb-3">
                                                    <label for="genre" class="form-label">Жанр</label>
                                                    <select name="genre" id="genre" class="form-control"
                                                        style="background-color: white !important;">
                                                        @foreach ($genres as $genre)
                                                            <option value="{{ $genre->id }}">{{ $genre->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="track_date_relize" class="form-label">Дата релиза</label>
                                                    <input type="date" class="form-control" id="track_date_relize"
                                                        name="track_date_relize"
                                                        :class="errors.track_date_relize ? 'is-invalid' : ''">
                                                    <div class="invalid-feedback" v-for="error in errors.track_date_relize">
                                                        @{{ error }}
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="track_lyrics" class="form-label">Текст песни</label>
                                                    <textarea class="form-control" id="track_lyrics" name="track_lyrics" :class="errors.track_lyrics ? 'is-invalid' : ''"></textarea>
                                                    <div class="invalid-feedback" v-for="error in errors.track_lyrics">
                                                        @{{ error }}
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="file_track" class="form-label">Трек</label>
                                                    <input type="file" class="form-control" id="file_track"
                                                        name="file_track" :class="errors.file_track ? 'is-invalid' : ''">
                                                    <div class="invalid-feedback" v-for="error in errors.file_track">
                                                        @{{ error }}
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="cenz" class="form-label">Ценз</label>
                                                    <input type="checkbox" class="checkbox form-check-input mx-2"
                                                        style="color:#950FFF !important;" id="cenz" name="cenz"
                                                        :class="errors.cenz ? 'is-invalid' : ''">
                                                    <div class="invalid-feedback" v-for="error in errors.cenz">
                                                        @{{ error }}
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" class="btn"
                                                        style="background-color: #950FFF; color: white; font-weight: 500;">Добавить</button>
                                                </div>
                                            </form>
                                            <form id="add_album_form" @submit.prevent="addAlbum" style="background-color: white !important;"
                                                v-if="show_add_albom">
                                                <div class="mb-3">
                                                    <label for="img_albom" class="form-label">Обложка альбома</label>
                                                    <input type="file" class="form-control" id="img_albom"
                                                        name="img_albom" :class="errors.img_albom ? 'is-invalid' : ''">
                                                    <div class="invalid-feedback" v-for="error in errors.img_albom">
                                                        @{{ error }}
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Название альбома</label>
                                                    <input type="text" class="form-control" id="albom"
                                                        name="title" :class="errors.title ? 'is-invalid' : ''">
                                                    <div class="invalid-feedback" v-for="error in errors.title">
                                                        @{{ error }}
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="genre_album" class="form-label">Жанр</label>
                                                    <select name="genre_album" id="genre_album" class="form-control"
                                                        style="background-color: white !important;">
                                                        @foreach ($genres as $genre)
                                                            <option value="{{ $genre->id }}">{{ $genre->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="album_date_relize" class="form-label">Дата релиза</label>
                                                    <input type="date" class="form-control" id="album_date_relize"
                                                        name="album_date_relize"
                                                        :class="errors.album_date_relize ? 'is-invalid' : ''">
                                                    <div class="invalid-feedback" v-for="error in errors.album_date_relize">
                                                        @{{ error }}
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="choose_tracks" class="form-label">Треки</label>
                                                        <select v-for="num in choose_tracks" name="album_tracks[]" id="albul_tracks" class="form-control mb-2" style="background-color: white !important; color: black !important;">
                                                            <option style="color:black !important;" class="option" v-for="track in tracks_user" :id="track.track_id" :value="track.track_id">@{{ track.track.title }}</option>
                                                        </select> 
                                                        <div class="d-flex justify-content-center" @click="addTrackField">
                                                            <button type="button" class="btn btn-dark mt-3"><i class="bi bi-plus"></i></button>
                                                        </div>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" class="btn"
                                                        style="background-color: #950FFF; color: white; font-weight: 500;">Добавить</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <button class="btn be_artist_btn" data-bs-toggle="modal" data-bs-target="#exampleModal">Стать
                                исполнителем</button>
                        @endif
                        {{-- start modal --}}
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Заявка на роль исполнителя
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="be_artist_form" @submit.prevent="applicationArtist"
                                            style="background-color: white !important; color: black !important;">
                                            <div class="mb-3">
                                                <label for="category" style="color:black !important;"
                                                    class="form-label">Категория</label>
                                                <select class="form-control" style="background-color: white !important;"
                                                    id="category" name="category"
                                                    :class="errors.category ? 'is-invalid' : ''">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback" v-for="error in errors.category">
                                                    @{{ error }}
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="title" style="color:black !important;"
                                                    class="form-label">Никнейм</label>
                                                <input type="text" class="form-control"
                                                    style="background-color: white !important;" id="title"
                                                    name="title" :class="errors.title ? 'is-invalid' : ''">
                                                <div class="invalid-feedback" v-for="error in errors.title">
                                                    @{{ error }}
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="text" style="color:black !important;"
                                                    class="form-label">Описание (укажите лейбл, муз.продюссера (если
                                                    есть))</label>
                                                <textarea type="text" class="form-control" style="background-color: white !important;" id="text"
                                                    name="text" :class="errors.text ? 'is-invalid' : ''"></textarea>
                                                <div class="invalid-feedback" v-for="error in errors.text">
                                                    @{{ error }}
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn"
                                                    style="background-color: #950FFF; color: white; font-weight: 500;">Сохранить
                                                    изменения</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end modal --}}
                    </div>
                </div>
            </div>
            <div class="col-9 p-5 mb-5 rounded" style="background-color: #282933;">
                <h3>Мой профиль</h3>
                <form id="formChange" @submit.prevent="saveChange">
                    <div class="mb-3">
                        <label for="photo" class="form-label">Фото</label>
                        <input type="file" class="form-control" id="photo" name="photo"
                            :class="errors.photo ? 'is-invalid' : ''" style="color:white !important;">
                        <div class="invalid-feedback" v-for="error in errors.photo">
                            @{{ error }}
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="mb-3" style="width: 49%;">
                            <label for="login" class="form-label">Логин</label>
                            <input type="text" class="form-control" id="login" name="login"
                                :class="errors.login ? 'is-invalid' : ''" value="{{ $user->login }}"
                                style="color:white !important;">
                            <div class="invalid-feedback" v-for="error in errors.login">
                                @{{ error }}
                            </div>
                        </div>
                        <div class="mb-3" style="width: 49%;">
                            <label for="birthday" class="form-label">День Рождения</label>
                            <input type="date" class="form-control" id="birthday" name="birthday"
                                value="{{ $user->birthday }}" :class="errors.birthday ? 'is-invalid' : ''"
                                style="color:white !important;">
                            <div class="invalid-feedback" v-for="error in errors.birthday">
                                @{{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="mb-3" style="width: 49%;">
                            <label for="phone" class="form-label">Телефон</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                :class="errors.phone ? 'is-invalid' : ''" value="{{ $user->phone }}"
                                style="color:white !important;">
                            <div class="invalid-feedback" v-for="error in errors.phone">
                                @{{ error }}
                            </div>
                        </div>
                        <div class="mb-3" style="width: 49%;">
                            <label for="gender" class="form-label">Пол</label>
                            <select name="gender" id="gender" class="form-control" style="color:white !important;">
                                @if ($user->gender == 1)
                                    <option selected hidden value="">Мужской</option>
                                @elseif($user->gender == 2)
                                    <option selected hidden value="">Женский</option>
                                @endif
                                <option value="1">Мужской</option>
                                <option value="2">Женский</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="mb-3" style="width: 49%;">
                            <label for="password" class="form-label">Пароль</label>
                            <input type="password" class="form-control" id="password" name="password"
                                :class="errors.password ? 'is-invalid' : ''" style="color:white !important;">
                            <div class="invalid-feedback" v-for="error in errors.password">
                                @{{ error }}
                            </div>
                        </div>
                        <div class="mb-3" style="width: 49%;">
                            <label for="password_confirmation" class="form-label">Повторите пароль</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" :class="errors.password ? 'is-invalid' : ''"
                                style="color:white !important;">
                            <div class="invalid-feedback" v-for="error in errors.password">
                                @{{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="p-3 col-12 rounded my-5" style="background-color: #282933;" id="block_choose_favorite">
                        <p>Любимые жанры</p>
                        <div class="genre-selector">
                            @foreach ($genres as $genre)
                                <button type="button" class="genre-btn btn"
                                    :class="{ 'active_genre': genres.includes({{ $genre->id }}) }"
                                    data-genre="{{ $genre->id }}">{{ $genre->title }}</button>
                            @endforeach
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button id="submit-btn" class="btn"
                            style="background-color: #950FFF; font-size: 16px; padding: 5px 30px; font-weight: 500; color: white;">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>
        const app = {
            data() {
                return {
                    errors: [],
                    message: '',
                    genres: [],
                    chooseForm: '',
                    show_add_track: false,
                    show_add_albom: false,
                    authors: [],
                    choose_authors: [],
                    tracks_user: [],
                    choose_tracks: [],
                }
            },
            methods: {
                addField() {
                    this.choose_authors.push('');
                },
                addTrackField() {
                    this.choose_tracks.push('');
                },
                async getUserGenres() {
                    const response = await fetch('{{ route('getGenres') }}');
                    this.genres = await response.json();
                    console.log(this.genres);
                },
                async saveChange() {
                    let genreBtns = document.querySelectorAll('.genre-btn');
                    let genres = [];
                    genreBtns.forEach(function(btn) {
                        if (btn.classList.contains('active_genre')) {
                            genres.push(btn.getAttribute(
                                'data-genre')); // Добавляем выбранный жанр в массив
                        }
                    });

                    let form = document.getElementById('formChange');
                    let form_data = new FormData(form);
                    form_data.append('genres', genres);
                    const response = await fetch('{{ route('save_profile_changes') }}', {
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
                        this.message = await response.json();
                        setTimeout(() => {
                            this.message = '';
                        }, 1000);
                        form.reset();
                        window.location = '{{ route('show_profile') }}';
                    }
                },
                async applicationArtist() {
                    let form = document.getElementById('be_artist_form');
                    let form_data = new FormData(form);
                    const response = await fetch('{{ route('applicationArtist') }}', {
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
                        this.message = await response.json();
                        setTimeout(() => {
                            this.message = '';
                        }, 10000);
                        form.reset();
                    }
                },
                chooseFormat() {
                    if (this.chooseForm == 1) {
                        this.show_add_albom = true;
                        this.show_add_track = false;
                        console.log('альбом');
                    }
                    if (this.chooseForm == 0) {
                        this.show_add_track = true;
                        this.show_add_albom = false;
                        console.log('трек');
                    }
                },
                async addTrack() {
                    let form = document.getElementById('add_track_form');
                    let form_data = new FormData(form);
                    const response = await fetch('{{ route('add_track') }}', {
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
                        this.message = await response.json();
                        setTimeout(() => {
                            this.message = '';
                        }, 10000);
                        form.reset();
                    }
                },
                async addAlbum() {
                    let form = document.getElementById('add_album_form');
                    let form_data = new FormData(form);
                    const response = await fetch('{{ route('add_album') }}', {
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
                        this.message = await response.json();
                        setTimeout(() => {
                            this.message = '';
                        }, 10000);
                        form.reset();
                    }
                },
                async getArtistsandTracks() {
                    const response = await fetch('{{ route('get_all_artists') }}');
                    this.authors = await response.json();
                    const responseTracks = await fetch('{{ route('get_all_user_tracks') }}');
                    this.tracks_user = await responseTracks.json();
                    console.log(this.tracks_user);
                }
            },
          
            mounted() {   
                this.getArtistsandTracks();
                this.getUserGenres();
                let genreBtns = document.querySelectorAll('.genre-btn');
                genreBtns.forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        this.classList.toggle('active_genre'); // Переключаем класс при клике
                    });
                });

            }
        }
        Vue.createApp(app).mount('#userProfile');
    </script>
@endsection
