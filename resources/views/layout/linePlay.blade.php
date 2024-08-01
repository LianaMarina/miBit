<div class="fixed-bottom py-5 d-flex justify-content-center" style="background-color: #535156 !important;">
    <button type="button" class="btn btn-light" id="button_back"
        style="font-size: 25px;border: none !important; width: 80px; height: 80px; background-color: #535156 !important; color:#950FFF;"><i
            class="bi bi-skip-backward-fill"></i></button>
    <button type="button" @click="pause_this_bar" class="btn btn-light play_btn d-none"
        style="font-size: 40px; border-radius: 50px; width: 80px; height: 80px; border: 4px #950FFF solid; background-color: #535156 !important; color:#950FFF;"><i
            class="bi bi-pause-fill pause_btn" :id="`pause_${music.id}`"></i></button>
    <button type="button" @click="play_this_bar" class="btn btn-light"
        style="font-size: 40px; border-radius: 50px; width: 80px; height: 80px; border: 4px #950FFF solid; background-color: #535156 !important; color:#950FFF;"><i
            class="bi bi-play-fill" :id="`play_${music.id}`"></i></button>
    <button type="button" @click="next" class="btn btn-light"
        style="font-size: 25px;border: none !important; width: 80px; height: 80px; background-color: #535156 !important; color:#950FFF;"><i
            class="bi bi-skip-forward-fill"></i></button>
    <div class="progress col-6" id="progress" style="height: 5px; cursor: pointer;" style="background-color: #950FFF !important;"
        @click="seekTrack($event)">
        <div class="progress-bar" role="progressbar" :style="{ width: progress + '%' }"
            style="color: #950FFF !important; background-color: #950FFF !important;" aria-valuemin="0"
            :aria-valuenow="progress" aria-valuemax="100"></div>
    </div>
</div>
