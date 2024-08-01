@extends('layout.app')

@section('title')
    Поиск
@endsection

@section('content')
    <style>
        input {
            color: white;
            padding-left: 15px;
        }

        .image-container {
            position: relative;
            width: 60px;
            /* Замените этот размер на ширину вашей картинки */
        }

        .image {
            width: 100%;
            height: auto;
            display: block;
        }

        .overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.5);
            /* Задает затемнение (замените 0.5 для изменения прозрачности) */
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .overlay:hover {
            opacity: 1;
        }

        .play-button {
            background-color: white;
            color: black;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .add-playlist-btn {
            background-color: #282933;
            border-radius: 5px;
            border: 1px solid #950FFF;
            color: #950FFF;
            font-size: 20px;
            font-weight: 700;
        }

        a.card_track:hover {
            background-color: #970fff81 !important;
            border-radius: 10px;
        }
    </style>
    <div class="container" id="searchPage" style="margin-bottom: 250px;">
        <div class="header_search d-flex justify-content-between gap-2">
            <p class="col-auto" style="color: white; font-size: 20px; font-weight:500;">Поиск</p>
            <input v-model="searchValue" :change="Search" style="border-radius: 10px; height:35px;" type="text"
                class="col-11">
            <p style="color: white; font-size: 20px;" class="col-auto"><i class="bi bi-search"></i></p>
        </div>
        <div class="my-5">
            <div class="mb-3">
                <h5 style="color: white;">Треки</h5>
                <div class="" v-for="(music, key) in searchTracks">
                    <a class="d-flex card_track justify-content-between align-items-center col-12"
                        :href="`{{ route('show_page_play') }}/${music.id}`"
                        style="text-decoration: none; color:#A9A8AA !important;">
                        <div class="d-flex gap-3 align-items-center">
                            <p style="color: #A9A8AA !important; font-size: 18px; font-weight: 900;">@{{ key + 1 }}
                            </p>
                            <div class="image-container">
                                <img :src="'/public' + music.img" alt=""
                                    style="width: 60px; height:60px; object-fit:cover; border-radius: 5px;">
                                <div class="overlay">
                                    <button :id="`pause_${music.id}`" type="button"@click.stop.prevent="pause(music)"
                                        class="btn btn-light d-none pauses"
                                        style="font-size: 20px; border-radius: 50px; width: 80; height: 80;"><i
                                            class="bi bi-pause-fill"></i></button>
                                    <button :id="`play_${music.id}`" type="button"@click.stop.prevent="play(music, key)"
                                        class="btn btn-light plays"
                                        style="font-size: 20px; border-radius: 50px; width: 80; height: 80;"><i
                                            class="bi bi-play-fill"></i></button>
                                </div>
                            </div>
                            <div class="">
                                <p style="color: white; font-size: 18px; font-weight: 700;">@{{ music.title }}</p>
                                <p style="color: white; font-size: 16px; font-weight: 300; margin-top: -15px;">
                                    @{{ music.authors }}</p>
                                <audio @ended="addCountListen(music.id)" :src="'/public' + music.song"></audio>
                            </div>
                        </div>
                        <div class="d-flex gap-3 align-items-center">
                            <p class="mt-2" style="color: white;">@{{ music.view_time }}</p>
                            @auth
                                <button class="add-playlist-btn" @click.stop.prevent data-bs-toggle="modal" :data-bs-target="'#exampleModal'+music.id"><i
                                    class="bi bi-plus"></i></button>
                                    <div @click.stop.prevent class="modal fade" :id="'exampleModal'+music.id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Добавить в плейлист</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="d-flex justify-content-center">
                                                    <button class="btn" @click.stop.prevent="show_create_playlist_form(music.id)" :id="'create_playlist_btn'+music.id"
                                                        style="border: 1px solid #950FFF; color:#950FFF; font-weight:500;">Создать
                                                        плейлист <i class="bi bi-plus"></i></button>
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                    <form @submit.prevent="createPlaylist(music.id)" class="d-none" :id="'create_playlist_form'+music.id" enctype="multipart/form-data" style="background-color: white !important;">
                                                        <div class="mb-3">
                                                            <label for="title" class="form-label">Название</label>
                                                            <input type="text" class="form-control" id="title" name="title" style="background-color: white !important;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="text" class="form-label">Описание</label>
                                                            <textarea class="form-control" id="text" name="text"></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="img" class="form-label">Обложка</label>
                                                            <input type="file" class="form-control" id="img" name="img" style="background-color: white !important;">
                                                        </div>
                                                        <div class="d-flex justify-content-center">
                                                            <button type="submit" class="btn" style="color: white !important; background-color: #950FFF; font-size: 16px; padding: 5px 30px; font-weight: 500;">Создать и добавить трек</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <p class="d-block" style="font-weight: 500; font-size: 20px;" class="mt-3">Мои плейлисты</p>
                                                <div class="d-flex flex-column gap-3">
                                                    <div class="d-flex justify-content-between align-items-center" v-for="playlist in myPlaylists">
                                                        <div class="d-flex gap-2 align-items-center">
                                                            <img v-if="playlist.img" style="width: 75px; height:75px; object-fit:cover;" :src="'/public'+playlist.img" alt="">
                                                            <img v-else style="width: 75px; height:75px; object-fit:cover;" v-else src="https://i.pinimg.com/564x/08/5d/31/085d31e38e0d651ca5f1118fa7d80748.jpg" alt="">
                                                        <p style="font-size: 20px; font-weight:700;">@{{ playlist.title }}</p> 
                                                        </div>
                                                        <button style="background-color: white !important;" @click.stop.prevent="addPlaylistTrack(playlist.id,music.id)" class="add-playlist-btn"><i class="bi bi-plus"></i></button>
                                                    </div>
                                            </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                            @endauth
                        </div>
                    </a>
                </div>
            </div>
            <div class="mb-3">
                <h5 style="color: white;">Альбомы</h5>
                <div class="" v-for="(album, key) in searchAlbums">
                    <a class="d-flex card_track justify-content-between align-items-center col-12" href=""
                        style="text-decoration: none; color:#A9A8AA !important;">
                        <div class="d-flex gap-3 align-items-center">
                            <p style="color: #A9A8AA !important; font-size: 18px; font-weight: 900;">@{{ key + 1 }}
                            </p>
                            <div class="image-container">
                                <img :src="'/public' + album.img" alt=""
                                    style="width: 60px; height:60px; object-fit:cover; border-radius: 5px;">
                            </div>
                            <div class="">
                                <p style="color: white; font-size: 18px; font-weight: 700;">@{{ album.title }}</p>
                                <p style="color: white; font-size: 16px; font-weight: 300; margin-top: -15px;">
                                    @{{ album.author }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="mb-3">
                <h5 style="color: white;">Плейлисты</h5>
                <div class="" v-for="(playlist, key) in searchPlaylists">
                    <a class="d-flex card_track justify-content-between align-items-center col-12" href=""
                        style="text-decoration: none; color:#A9A8AA !important;">
                        <div class="d-flex gap-3 align-items-center">
                            <p style="color: #A9A8AA !important; font-size: 18px; font-weight: 900;">@{{ key + 1 }}
                            </p>
                            <div class="image-container">
                                <img :src="'/public' + playlist.img" alt=""
                                    style="width: 60px; height:60px; object-fit:cover; border-radius: 5px;">
                            </div>
                            <div class="">
                                <p style="color: white; font-size: 18px; font-weight: 700;">@{{ playlist.title }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="fixed-bottom py-3" style="background-color: #535156 !important;">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="d-flex gap-2 align-items-center col-3">
                    <img :src="'/public' + track_inf.img" alt=""
                        style="width: 70px; height: 70px; object-fit:cover; border-radius: 50%;">
                    <div class="">
                        <p style="color:white !important; margin-top: 10px !important;font-weight:700; font-size:18px;">
                            @{{ track_inf.title }}</p>
                        <p style="color:white !important; margin-top: -15px;">@{{ track_inf.authors }}</p>
                    </div>
                </div>

                <div class="">
                    <button type="button" class="btn btn-light" id="button_back" @click="back"
                        style="font-size: 25px;border: none !important; width: 80px; height: 80px; background-color: #535156 !important; color:#950FFF;"><i
                            class="bi bi-skip-backward-fill"></i></button>
                    <button type="button" @click="pause_this_bar" class="btn btn-light play_btn d-none" id="pause_progress"
                        style="font-size: 40px; border-radius: 50px; width: 80px; height: 80px; border: 4px #950FFF solid; background-color: #535156 !important; color:#950FFF;"><i
                            class="bi bi-pause-fill pause_btn"></i></button>
                    <button type="button" @click="play_this_bar" class="btn btn-light" id="play_progress"
                        style="font-size: 40px; border-radius: 50px; width: 80px; height: 80px; border: 4px #950FFF solid; background-color: #535156 !important; color:#950FFF;"><i
                            class="bi bi-play-fill"></i></button>
                    <button type="button" @click="next" class="btn btn-light"
                        style="font-size: 25px;border: none !important; width: 80px; height: 80px; background-color: #535156 !important; color:#950FFF;"><i
                            class="bi bi-skip-forward-fill"></i></button>
                </div>
                <div class="progress col-6" style="height: 5px; cursor: pointer;"
                    style="background-color: #950FFF !important;">
                    <div class="progress-bar" role="progressbar" id="progress" :style="{ width: progress + '%' }"
                        style="color: #950FFF !important; background-color: #950FFF !important;" aria-valuemin="0" :aria-valuenow="progress" aria-valuemax="100">
                    </div>
                </div>
                <p style="color: white; font-size:16px; font-weight: 500; margin-top:10px;">@{{ track_inf.view_time }}</p>
            </div>
        </div>
    </div>
    <script>
        const app = {
            data() {
                return {
                    results: [],
                    searchValue: '',
                    tracks: [],
                    albums: [],
                    playlists: [],
                    searchTracks: [],
                    searchAlbums: [],
                    searchPlaylists: [],
                    track_inf: [],
                    myPlaylists: [],
                    track: '',
                    time: '',
                    progress: '',
                    button_play_bar: '',
                    button_pause_bar: '',
                    key: 0,
                }
            },
            methods: {
                async addPlaylistTrack(playlist_id, track_id) {
                    console.log(playlist_id, track_id);
                    const response = await fetch('{{ route('add_track_my_playlist') }}', {
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            playlist: playlist_id,
                            track:track_id,
                        })
                    });
                },
                async getData() {
                    const responseTracks = await fetch('{{ route('get_all_tracks') }}');
                    this.tracks = await responseTracks.json();
                    const responseAlbums = await fetch('{{ route('get_all_albums') }}');
                    this.albums = await responseAlbums.json();
                    const responsePlaylists = await fetch('{{ route('get_all_playlists') }}');
                    this.playlists = await responsePlaylists.json();
                    this.inicializationTracks;
                    const responseGetPlaylistUser = await fetch('{{ route('get_all_userPlaylists') }}');
                    this.myPlaylists = await responseGetPlaylistUser.json();
                },
                play(music, key) {
                    // если включаем новый (не тот, который играет/играл до этого)
                    if (this.track != music || !this.track) {
                        this.track.pause();
                        this.track = new Audio('/public' + music.song);
                        this.track.id = music.id;
                        this.track.play();
                    this.saveSearchResultsToLocalStorage;

                        // включаем тот, который играл
                    } else {
                        this.track.currentTime = Math.round(this.time);
                        this.track.play();
                    this.saveSearchResultsToLocalStorage;

                        // console.log(this.track);
                    }
                    this.currentTimeTrack;

                    this.button_play_bar.classList.add('d-none');
                    this.button_pause_bar.classList.remove('d-none');

                    const array_plays = document.querySelectorAll('.plays');
                    const array_pauses = document.querySelectorAll('.pauses');

                    array_plays.forEach(a => {
                        if (a.id == 'play_' + this.track.id) {
                            a.classList.add('d-none');
                        } else {
                            a.classList.remove('d-none');
                        }
                    });
                    array_pauses.forEach(a => {
                        if (a.id == 'pause_' + this.track.id) {
                            a.classList.remove('d-none');
                        } else {
                            a.classList.add('d-none');
                        }
                    });
                    this.track_inf = this.searchTracks.filter(a => a.id == music.id)[0];
                    this.nextAutoplay(key);
                },
                async addCountListen(id) {
                    const responseAddCountListen = await fetch(`{{ route('addCountListen') }}/${id}`);
                    // this.message = await responseAddCountListen.json();
                    setTimeout(() => {
                        this.message = '';
                    }, 1000);
                },
                async nextAutoplay(key) {
                    let that = this;
                    this.track.addEventListener('ended', function() {
                        const play = document.getElementById('play_' + that.track.id).classList.remove(
                            'd-none');
                        const pause = document.getElementById('pause_' + that.track.id).classList.add(
                            'd-none');
                        if (key !== parseInt(that.searchTracks.length) - 1) {
                            that.play(that.searchTracks[key + 1], key + 1);
                        } else {
                            that.play(that.searchTracks[0], 0);
                        }
                        this.button_play_bar.classList.remove('d-none');
                        this.button_pause_bar.classList.add('d-none');
                    });
                },
                back() {
                    console.log('Сюда поподаю');
                    let back_track = {};
                    this.searchTracks.find((m, key) => {
                        if (parseInt(key) === 0 && parseInt(this.track.id) === parseInt(this.searchTracks[key]
                                .id)) {
                            return back_track = this.searchTracks[parseInt(this.searchTracks.length) - 1];
                        }
                        if (parseInt(this.track.id) === parseInt(this.searchTracks[key].id)) {
                            return back_track = this.searchTracks[parseInt(key) - 1]
                        }
                    });
                    this.play(back_track);
                },
                next() {
                    let next_track = {};
                    this.searchTracks.find((m, key) => {
                        if (parseInt(this.track.id) === parseInt(this.searchTracks[key].id) && parseInt(this
                                .searchTracks.length) - 1 !== parseInt(key)) {
                            return next_track = this.searchTracks[parseInt(key) + 1];
                        }
                        if (parseInt(this.searchTracks.length) - 1 == parseInt(key)) {
                            return next_track = this.searchTracks[0];
                        }
                    });
                    this.play(next_track);
                },
                
                pause() {
                    this.track.pause();
                    this.time = this.track.currentTime;
                    localStorage.setItem('status', JSON.stringify(this.track.paused));
                    const play = document.getElementById('play_' + this.track.id);
                    const pause = document.getElementById('pause_' + this.track.id);

                    play.classList.remove('d-none');
                    pause.classList.add('d-none');


                    this.button_play_bar.classList.remove('d-none');
                    this.button_pause_bar.classList.add('d-none');
                },
                play_this_bar() {
                    this.button_play_bar.classList.add('d-none');
                    this.button_pause_bar.classList.remove('d-none');
                    localStorage.setItem('status', JSON.stringify(this.track.paused));
                    const play = document.getElementById('play_' + parseInt(this.track.id));
                    const pause = document.getElementById('pause_' + parseInt(this.track.id));

                    play.classList.add('d-none');
                    pause.classList.remove('d-none');

                    this.track.currentTime = this.time;
                    this.track.play();

                },
                pause_this_bar() {
                    const button_play = document.getElementById('play_progress');
                    const button_pause = document.getElementById('pause_progress');
                    localStorage.setItem('status', JSON.stringify(this.track.paused));
                    button_pause.classList.add('d-none');
                    button_play.classList.remove('d-none');
                    const play = document.getElementById('play_' + parseInt(this.track.id));
                    const pause = document.getElementById('pause_' + parseInt(this.track.id));

                    play.classList.remove('d-none');
                    pause.classList.add('d-none');

                    this.time = this.track.currentTime;
                    this.track.pause();
                },
                show_create_playlist_form(id) {
                    console.log(id);
                    let form = document.getElementById('create_playlist_form'+id);
                    console.log(form);
                    let btn = document.getElementById('create_playlist_btn'+id);
                    form.classList.remove('d-none');
                    btn.classList.add('d-none');
                },
                async createPlaylist(id) {
                    let form = document.getElementById('create_playlist_form'+id);
                    let form_data = new FormData(form);
                    const response = await fetch(`{{ route('createPlaylist') }}/${this.id}`, {
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        },
                        body:form_data,
                    });
                    if (response.status == 400) {
                        this.errors = await response.json();
                        setTimeout(() => {
                            this.errors = [];
                        }, 10000);
                    }
                    if (response.status == 200) {
                        form.reset();
                        this.message = await response.json();
                        setTimeout(() => {
                            this.message = '';
                        }, 10000);
                        window.location = `{{ route('show_page_play') }}/${this.id}`;
                    }
                },
            },
            computed: {
                inicializationTracks() {
                    if (this.getSearchResultsFromLocalStorage) {
                        let last = this.getSearchResultsFromLocalStorage;
                        console.log(last[0]);
                        this.track = new Audio(last[0]);
                        this.track.src = '/public' + last[0].song;
                        this.track.id = last[0].id;
                        console.log(this.track);
                        this.track_inf = last[0];
                        const storedResults = localStorage.getItem('duration');
                        this.track.currentTime = JSON.parse(storedResults);
                        this.time = this.track.currentTime;
                        let progress = this.progress;
                        this.currentTimeTrack;
                        const button_play = document.getElementById('play_progress');
                        const button_pause = document.getElementById('pause_progress');
                        const statusTrack = localStorage.getItem('status');
                        console.log(statusTrack);
                        if (statusTrack === 'false') {
                            this.button_play_bar.classList.remove('d-none');
                            this.button_pause_bar.classList.add('d-none');
                            this.track.play();
                            button_pause.classList.remove('d-none');
                            button_play.classList.add('d-none');
                        } else {
                            this.button_play_bar.classList.add('d-none');
                            this.button_pause_bar.classList.remove('d-none');
                            this.track.pause();
                            button_pause.classList.add('d-none');
                            button_play.classList.remove('d-none');
                        }
                    } else {
                        this.track = new Audio(this.tracks[0]);
                        this.track.src = '/public' + this.tracks[0].song;
                        this.track.id = this.tracks[0].id;
                    this.tracks.forEach((track, key) => {
                        let t = new Audio(track);
                        t.src = '/public' + track.song;
                        t.addEventListener('loadedmetadata', function() {
                            let duration = t.duration;
                            let minutes = Math.floor(duration / 60);
                            let seconds = Math.round(duration % 60);
                            track.view_time = minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
                            track.duration = t.duration;
                        });
                    });
                    this.track_inf = this.searchTracks[0];
                    }
                    // console.log(this.newTracks);
                },
                currentTimeTrack() {
                    let progress = this.progress;
                    let width = 1510;
                    this.track.addEventListener('timeupdate', function() {
                        localStorage.setItem('duration', JSON.stringify(this.currentTime));
                        localStorage.setItem('status', JSON.stringify(this.paused));
                        this.progress = (this.currentTime / this.duration) * 100;
                        console.log(this.progress);
                        progress.style.width = this.progress + '%';
                    });
                },
                globalParametrs() {
                    this.progress = document.getElementById('progress');
                    // console.log(this.progress);
                    this.button_play_bar = document.getElementById('play_progress');
                    this.button_pause_bar = document.getElementById('pause_progress');
                },
                Search() {
                    // if (this.searchValue == '') {
                    //     this.searchTracks = this.tracks;
                    //     this.searchAlbums = this.albums;
                    //     this.searchPlaylists = this.playlists;
                    //     return this.searchAlbums, this.searchTracks, this.searchPlaylists;
                    // } else {
                    this.searchTracks = this.tracks.filter(a => a.title.toLowerCase().includes(this.searchValue
                        .toLowerCase()) || a.authors.toLowerCase().includes(this.searchValue.toLowerCase()));
                    this.searchAlbums = this.albums.filter(a => a.title.toLowerCase().includes(this.searchValue
                        .toLowerCase()));
                    this.searchPlaylists = this.playlists.filter(a => a.title.toLowerCase().includes(this
                        .searchValue.toLowerCase()));
                    // this.saveSearchResultsToLocalStorage;
                    return this.searchTracks, this.searchAlbums, this.searchPlaylists;
                    // }
                },
                saveSearchResultsToLocalStorage() {
                    let currentTrack = this.tracks.filter(a=>a.id == this.track.id);
                    localStorage.setItem('currentTrack', JSON.stringify(currentTrack));
                },
                getSearchResultsFromLocalStorage() {
                    const storedResults = localStorage.getItem('currentTrack');
                    return storedResults ? JSON.parse(storedResults) : [];
                },
            },
            mounted() {
                this.getData();
                // this.getSearchResultsFromLocalStorage;
                this.globalParametrs;
            }
        }
        Vue.createApp(app).mount('#searchPage');
    </script>
@endsection
