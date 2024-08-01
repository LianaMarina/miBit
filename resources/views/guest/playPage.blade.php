@extends('layout/app')

@section('title')
    {{ $track->title }}
@endsection

@section('content')
    <style>
        h3 {
            color: white;
        }

        .title_track {
            font-size: 32px;
            color: white;
            font-weight: 700;
        }

        .add-playlist-btn {
            background-color: #282933;
            border-radius: 5px;
            border: 1px solid #950FFF;
            color: #950FFF;
            font-size: 20px;
            font-weight: 700;
        }

        .nickname {
            font-size: 16px;
            color: #BABFC4 !important;
            margin-top: -15px;
        }
    </style>
    <div class="container" style="margin-bottom: 100px;" id="trackPage">
        <div :class="message ? 'alert alert-success' : ''">
            @{{ message }}
        </div>
        <div class="d-flex gap-2">
            <div class="col-6">
                <img src="{{ asset('/public' . $track->img) }}" alt=""
                    style="width: 100%; height:640px; object-fit:cover; border-radius: 10px 10px 0 0;">
                <div class="px-4 pt-2 pb-4" style="background-color: #282933;">
                    <div class="col-12 d-flex justify-content-between align-items-start">
                        <div class="">
                            <p style="text-transform: lowercase;" class="title_track">{{ $track->title }}</p>
                            <p class="nickname">@{{ nicknames }}</p>
                        </div>
                        @auth
                            <div class="mt-3">
                                <button class="add-playlist-btn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                        class="bi bi-plus"></i></button>
                            </div>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Добавить в плейлист</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="d-flex justify-content-center">
                                                <button class="btn" @click="show_create_playlist_form" id="create_playlist_btn"
                                                    style="border: 1px solid #950FFF; color:#950FFF; font-weight:500;">Создать
                                                    плейлист <i class="bi bi-plus"></i></button>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <form @submit.prevent="createPlaylist" class="d-none" id="create_playlist_form" enctype="multipart/form-data" style="background-color: white !important;">
                                                    <div class="mb-3">
                                                        <label for="title" class="form-label">Название</label>
                                                        <input type="text" class="form-control" id="title" name="title"
                                                            :class="errors.title ? 'is-invalid' : ''" style="background-color: white !important;">
                                                        <div class="invalid-feedback" v-for="error in errors.title">
                                                            @{{ error }}
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="text" class="form-label">Описание</label>
                                                        <textarea class="form-control" id="text"
                                                            name="text" :class="errors.text ? 'is-invalid' : ''"></textarea>
                                                        <div class="invalid-feedback" v-for="error in errors.text">
                                                            @{{ error }}
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="img" class="form-label">Обложка</label>
                                                        <input type="file" class="form-control" id="img" name="img"
                                                            :class="errors.img ? 'is-invalid' : ''" style="background-color: white !important;">
                                                        <div class="invalid-feedback" v-for="error in errors.img">
                                                            @{{ error }}
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-center">
                                                        <button type="submit" class="btn" style="color: white !important; background-color: #950FFF; font-size: 16px; padding: 5px 30px; font-weight: 500;">Создать и добавить трек</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <p class="d-block" style="font-weight: 500; font-size: 20px;" class="mt-3">Мои плейлисты</p>
                                                <div class="d-flex flex-column gap-3">
                                                        <div class="d-flex justify-content-between col-12 align-items-center" v-for="playlist in playlists">
                                                            <div class="d-flex gap-2 align-items-center">
                                                                <img v-if="playlist.img" style="width: 75px; height:75px; object-fit:cover;" :src="'/public'+playlist.img" alt="">
                                                                <img v-else style="width: 75px; height:75px; object-fit:cover;" v-else src="https://i.pinimg.com/564x/08/5d/31/085d31e38e0d651ca5f1118fa7d80748.jpg" alt="">
                                                            <p style="font-size: 20px; font-weight:700;">@{{ playlist.title }}</p> 
                                                            </div>
                                                            <a style="background-color: white !important;" :href="`{{ route('add_track_playlist') }}/${playlist.id}/${track.id}`" class="add-playlist-btn"><i
                                                                class="bi bi-plus"></i></a>
                                                        </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endauth
                    </div>
                    <div class="progress" style="height: 5px; cursor: pointer;"
                        style="background-color: #950FFF !important;" @click="seekTrack($event)">
                        <div class="progress-bar" role="progressbar" :style="{ width: progress + '%' }"
                            style="color: #950FFF !important; background-color: #950FFF !important;" aria-valuemin="0"
                            :aria-valuenow="progress" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p style="color:#ffffff !important; font-size: 12px; color: #BABFC4 !important;" class="pt-1">
                            @{{ currentTime }}</p>
                        <p style="color:#ffffff !important; font-size: 12px; color: #BABFC4 !important;" class="pt-1">
                            @{{ time }}</p>
                    </div>
                    <audio ref="audioPlayer" id="audio" src="{{ asset('/public' . $track->song) }}"
                        @ended="restartTrack"></audio>
                    <div class="d-flex justify-content-between align-items-center">
                        <button v-if="restart" class="btn"><img src="{{ asset('public\img\repeat-active.png') }}"
                                @click="restartActive" alt=""></button>
                        <button v-else class="btn"><img src="{{ asset('public\img\repeat.png') }}" @click="restartActive"
                                alt=""></button>
                        <button v-if="show_pause_btn" type="button" @click="pause" class="btn btn-light"
                            style="font-size: 30px; border-radius: 50px; width: 80; height: 80;"><i class="bi bi-pause-fill"
                                style="width:20px; height: 30px;"></i></button>
                        <button v-else type="button" @click="play" class="btn btn-light"
                            style="font-size: 30px; border-radius: 50px; width: 80; height: 80;"><i
                                class="bi bi-play-fill" style="width:20px; height: 30px;"></i></button>
                        <button v-if="volume" class="btn" style="color: white !important; font-size: 30px;"><i
                                class="bi bi-volume-up-fill" @click="OnOffVolume"></i></button>
                        <button v-else class="btn" style="color: white !important; font-size: 30px;"><i
                                class="bi bi-volume-mute" @click="OnOffVolume"></i></button>
                    </div>
                </div>
                <p style="color:#BABFC4;" class="mt-3">Количество прослушиваний: @{{ track.count_listen }}</p>
            </div>
            <div class="p-4" style="background-color: #282933;">
                <p style="color:#BABFC4 !important; font-size: 25px; font-weight: 700;">Текст</p>
                <div class="">
                    <p style="color: white; font-size: 18px;" v-for="str in lyrics">@{{ str }}</p>
                </div>

            </div>
        </div>
    </div>
    <script>
        const app = {
            data() {
                return {
                    errors: [],
                    message: '',
                    id: {{ $track->id }},
                    nicknames: '',
                    lyrics: [],
                    track: [],
                    time: '',
                    currentTime: '0:00',
                    audio: null,
                    show_pause_btn: false,
                    progress: 0,
                    seekInProgress: false,
                    seekTime: 0,
                    restart: false,
                    volume: true,
                    playlists: [],
                }
            },
            methods: {
                async Data() {
                    const responseTrack = await fetch(`{{ route('get_detail_track') }}/${this.id}`);
                    this.track = await responseTrack.json();
                    const response = await fetch(`{{ route('getNicknameForTrack') }}/${this.id}`);
                    this.nicknames = await response.json();
                    this.nicknames = this.nicknames.join(' & ');
                    this.lyrics = this.track.text.split('\r\n');
                    const responseGetPlaylistUser = await fetch('{{ route('get_all_userPlaylists') }}');
                    this.playlists = await responseGetPlaylistUser.json();
                    console.log(this.playlists);
                },
                onLoadedMetadata() {
                    let duration = audio.duration;
                    let minutes = Math.floor(duration / 60);
                    let seconds = Math.round(duration % 60);
                    time = minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
                    this.time = time;
                },
                play() {
                    this.audio.play();
                    this.show_pause_btn = true;
                    this.currentTime = this.time;
                },
                pause() {
                    this.audio.pause();
                    this.show_pause_btn = false;
                },
                formatTime(time) {
                    const minutes = Math.floor(time / 60);
                    const seconds = Math.floor(time % 60);
                    return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
                },
                updateTime() {
                    this.currentTime = Math.floor(this.audio.currentTime);
                    this.duration = Math.floor(this.audio.duration);
                    if (this.currentTime == this.duration) {
                        this.show_pause_btn = false;
                    }
                    this.progress = (this.currentTime / this.duration) * 100;
                    this.currentTime = this.formatTime(this.currentTime);
                },
                seekTrack(event) {
                    const audio = this.$refs.audioPlayer;
                    const boundingRect = event.target.getBoundingClientRect();
                    const offsetX = event.clientX - boundingRect.left;
                    const barWidth = boundingRect.width;
                    const progress = (offsetX / barWidth);
                    this.seekTime = progress * audio.duration; // Установить seekTime равное прогрессу
                    audio.currentTime = this.seekTime; // Установить текущее время воспроизведения
                },
                async restartTrack() {
                    if (this.restart) {
                        this.currentTime = 0;
                        this.show_pause_btn = true;
                        this.audio.play();
                    }
                    const responseAddCountListen = await fetch(`{{ route('addCountListen') }}/${this.id}`);
                    // this.message = await responseAddCountListen.json();
                    setTimeout(() => {
                        this.message = '';
                    }, 1000);
                },
                restartActive() {
                    if (this.restart == true) {
                        this.restart = false;
                    } else {
                        this.restart = true;
                    }
                },
                OnOffVolume() {
                    if (this.volume == true) {
                        this.volume = false;
                        this.audio.volume = 0;
                    } else {
                        this.audio.volume = 1;
                        this.volume = true;
                    }
                },
                show_create_playlist_form() {
                    let form = document.getElementById('create_playlist_form');
                    let btn = document.getElementById('create_playlist_btn');
                    form.classList.remove('d-none');
                    btn.classList.add('d-none');
                },
                async createPlaylist() {
                    let form = document.getElementById('create_playlist_form');
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
            mounted() {
                this.Data();
                let audio = document.getElementById('audio');
                audio.onloadedmetadata = this.onLoadedMetadata.bind(this);
                this.audio = audio;
                this.audio.addEventListener('timeupdate', this.updateTime);
                console.log(this.audio);
            }
        }
        Vue.createApp(app).mount('#trackPage');
    </script>
@endsection
