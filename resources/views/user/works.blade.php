@extends('layout/app')

@section('title')
    Мои работы
@endsection

@section('content')
<style>.image-container {
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
    background-color: #535156;
    border-radius: 5px;
    border: 1px solid #950FFF;
    color: #950FFF;
    font-size: 20px;
    font-weight: 700;
}

</style>
    <div class="container" id="worksPage">
        <div class="container" :class="message ? 'alert alert-success' : ''">
            @{{ message }}
        </div>
        <div class="d-flex justify-content-between gap-2">
            <div class="col-6 p-4" style="background-color: #282933; border-radius: 10px;">
                <h4 style="color: white;" class="mb-3">Треки</h4>
                <div class="d-flex justify-content-between align-items-center col-12 mt-2" v-for="(music, key) in tracks">
                    <a class="d-flex card_track justify-content-between align-items-center col-12"
                        :href="`{{ route('show_page_play') }}/${music.id}`"
                        style="text-decoration: none; color:#A9A8AA !important;">
                        <div class="d-flex col-12 gap-3 align-items-center justify-content-between">
                            <div class="d-flex gap-3 align-items-center">
                                <p style="color: #A9A8AA !important; font-size: 18px; font-weight: 900;">@{{ key + 1 }}</p>
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
                                <audio :src="'/public' + music.song" @ended="addCountListen"></audio>
                            </div>
                            </div>
                            <div class="d-flex gap-3">
                               <button @click.stop.prevent class="btn" style="border-radius: 10px; border:#950FFF 2px solid; color:#950FFF; font-weight:500;" data-bs-toggle="modal" :data-bs-target="'#exampleModal'+music.id">Ограничить доступ</button>
                               <div @click.stop.prevent class="modal fade" :id="'exampleModal'+music.id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="exampleModalLabel">Ограничение доступа трека</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form :id="'be_artist_form'+music.id" @submit.prevent="applicationArtist(music.id)"
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
                                                    class="form-label">Тема</label>
                                                <input type="text" class="form-control"
                                                    style="background-color: white !important;" id="title"
                                                    name="title" :class="errors.title ? 'is-invalid' : ''">
                                                <div class="invalid-feedback" v-for="error in errors.title">
                                                    @{{ error }}
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="text" style="color:black !important;"
                                                    class="form-label">Комментарий</label>
                                                <textarea type="text" class="form-control" style="background-color: white !important;" id="text"
                                                    name="text" :class="errors.text ? 'is-invalid' : ''"></textarea>
                                                <div class="invalid-feedback" v-for="error in errors.text">
                                                    @{{ error }}
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn" @click="applicationArtist(music.id)"
                                                    style="background-color: #950FFF; color: white; font-weight: 500;">Сохранить изменения</button>
                                            </div>
                                        </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                                <button class="btn" style="border-radius: 10px; color:white; font-weight:500; background-color:#950FFF;">Удалить <i class="bi bi-trash"></i></button> 
                            </div>
                        </div>
                        <div class="">
                            <p style="color: white;">@{{ music.view_time }}</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-6 p-4" style="background-color: #282933; border-radius: 10px;">
                <h4 style="color: white;" class="mb-3">Альбомы</h4>
                <div class="mt-2" v-for="(album, key) in albums">
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
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="fixed-bottom py-3" style="background-color: #535156 !important;">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="d-flex gap-2 align-items-center">
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

                <div class="progress col-6" style="height: 5px; cursor: pointer; width: 1510;"
                    style="background-color: #950FFF !important;" @click="seekTrack($event)">
                    <div class="progress-bar" role="progressbar" id="progress" :style="{ width: progress + '%' }"
                        style="color: #950FFF !important; background-color: #950FFF !important;" aria-valuemin="0"
                        :aria-valuenow="progress" aria-valuemax="100"></div>
                </div>
                <p style="color: white; font-size:16px; font-weight: 500; margin-top:10px;">@{{ track_inf.view_time }}</p>

            </div>

        </div>
    </div> 

    <script>
        const app = {
            data() {
                return {
                    errors: [],
                    message: '',
                    tracks: [],
                    albums: [],
                    track: '',
                    time: '',
                    progress: '',
                    button_play_bar: '',
                    button_pause_bar: '',
                    key: 0,
                    track_inf: [],
                }
            },
            methods: {
                async getData() {
                    const responseTracks = await fetch('{{ route('get_my_tracks') }}');
                    this.tracks = await responseTracks.json();
                    const responseAlbums = await fetch('{{ route('get_my_albums') }}');
                    this.albums = await responseAlbums.json();
                    this.inicializationTracks;
                },
                async applicationArtist(id) {
                    console.log(id);
                    let form = document.getElementById('be_artist_form'+id);
                    let form_data = new FormData(form);
                    form_data.append('id', id);
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
                    this.track_inf = this.tracks.filter(a => a.id == music.id)[0];
                    this.nextAutoplay(key);
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
                async nextAutoplay(key) {
                    let that = this;
                    this.track.addEventListener('ended', function() {
                        const play = document.getElementById('play_' + that.track.id).classList.remove(
                            'd-none');
                        const pause = document.getElementById('pause_' + that.track.id).classList.add(
                            'd-none');
                        if (key !== parseInt(that.tracks.length) - 1) {
                            that.play(that.tracks[key + 1], key + 1);
                        } else {
                            that.play(that.tracks[0], 0);
                        }
                        this.button_play_bar.classList.remove('d-none');
                        this.button_pause_bar.classList.add('d-none');
                    });
                },
                back() {
                    let back_track = {};
                    this.tracks.find((m, key) => {
                        if (parseInt(key) === 0 && parseInt(this.track.id) === parseInt(this.tracks[key]
                                .id)) {
                            return back_track = this.tracks[parseInt(this.tracks.length) - 1];
                        }
                        if (parseInt(this.track.id) === parseInt(this.tracks[key].id)) {
                            return back_track = this.tracks[parseInt(key) - 1]
                        }
                    });
                    this.play(back_track);
                },
                async addCountListen(id) {
                    const responseAddCountListen = await fetch(`{{ route('addCountListen') }}/${id}`);
                    // this.message = await responseAddCountListen.json();
                    setTimeout(() => {
                        this.message = '';
                    }, 1000);
                },
                next() {
                    let next_track = {};
                    this.tracks.find((m, key) => {
                        if (parseInt(this.track.id) === parseInt(this.tracks[key].id) && parseInt(this
                                .tracks.length) - 1 !== parseInt(key)) {
                            return next_track = this.tracks[parseInt(key) + 1];
                        }
                        if (parseInt(this.tracks.length) - 1 == parseInt(key)) {
                            return next_track = this.tracks[0];
                        }
                    });
                    this.play(next_track);
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
                    console.log(this.track);

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
                        const statusTrack = localStorage.getItem('status');
                        console.log(statusTrack);
                        const button_play = document.getElementById('play_progress');
                        const button_pause = document.getElementById('pause_progress');
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
                            })
                        });
                        this.track_inf = this.tracks[0];
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
                        progress.style.width = this.progress + '%';
                    });
                },
                globalParametrs() {
                    this.progress = document.getElementById('progress');
                    console.log(this.progress);
                    this.button_play_bar = document.getElementById('play_progress');
                    this.button_pause_bar = document.getElementById('pause_progress');
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
                this.globalParametrs;
            }
        }
        Vue.createApp(app).mount('#worksPage');
    </script>
@endsection