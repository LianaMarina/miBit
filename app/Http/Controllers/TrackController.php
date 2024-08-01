<?php

namespace App\Http\Controllers;

use App\Models\Albom;
use App\Models\personTrack;
use App\Models\Track;
use App\Models\User;
use Faker\Provider\ar_EG\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Track $track)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Track $track)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Track $track)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Track $track)
    {
        //
    }

    //добавить трек
    public function add_track(Request $request) {
        // dd($request->all());
        $valid = Validator::make($request->all(), [
            'img_track'=>['required', 'mimes:png,jpg'],
            'track_title'=>['required'],
            'genre'=>['required'],
            'track_date_relize'=>['required'],
            'track_lyrics'=>['nullable'],
            'file_track'=>['required',],
        ]);
        if ($valid->fails()) {
            return response()->json($valid->errors(), 400);
        }
        $track = new Track();
        $track->title = $request->track_title;
        $file = $request->file('img_track')->store('/public/img');
        $track->img = '/storage/'.$file;
        $track->genre_id = $request->genre;
        $track->date = $request->track_date_relize;
        $track->text = $request->track_lyrics;
        if($request->cenz == 'on') {
            $track->cenz = 1;
        } else {
            $track->cenz = 0;
        }
        $file = $request->file('file_track')->store('/public/music');
        $track->song = '/storage/'.$file;
        $track->save();
        $person_track = new personTrack();
        $person_track->user_id = Auth::id();
        $person_track->track_id = $track->id;
        $person_track->save();
        if($request->choose_authors_select) {
            foreach($request->choose_authors_select as $author) {
                $track_author = new personTrack();
                $track_author->user_id = $author;
                $track_author->track_id = $track->id;
                $track_author->save();
            }
        }
        return response()->json('Трек добавлен. Ожидайте подтверждения администратора.');
    }

    // получить все треки пользователя
    public function get_all_user_tracks() {
        $user_tracks = personTrack::with(['track'])->where('user_id', Auth::id())->get(); 
        return response()->json($user_tracks);
    }

    //получить 4 новых трека
    public function get_new_tracks() {
        $newTracks = Track::query()->where('status', 'В доступе')->orderBy('created_at', 'desc')->take(5)->get();
        foreach($newTracks as $track) {
            $tracks = '';
            $personsTrack = personTrack::query()->where('track_id', $track->id)->get();
            foreach($personsTrack as $person) {
                $nickname = User::query()->where('id', $person->user_id)->first();
                $tracks = $tracks. $nickname->nickname . ' & ' ;
            }
            $tracks = substr($tracks, 0, -3);
            $track->authors = $tracks;
            // array_push($nicknames, $nickname->nickname);
        }
        return response()->json($newTracks);
    }

    //получить информацию для страницы трека
    public function get_detail_track($id) {
        $track = Track::query()->where('id', $id)->first();
        // dd($track);
        return response()->json($track);
    }
    
    //добавить количество прослушивания
    public function addCountListen($id) {
        $track = Track::query()->where('id', $id)->first();
        // dd($track);
        $track->count_listen += 1;
        $track->update();
        return response()->json();
    }

    //получить все треки в доступе
    public function get_all_tracks() {
        $tracks = Track::query()->where('status', 'В доступе')->get();
        foreach($tracks as $track) {
            $persons = '';
            $personsTrack = personTrack::query()->where('track_id', $track->id)->get();
            foreach($personsTrack as $person) {
                $nickname = User::query()->where('id', $person->user_id)->first();
                $persons = $persons. $nickname->nickname . ' & ' ;
            }
            $persons = substr($persons, 0, -3);
            $track['authors'] = $persons;
            // array_push($nicknames, $nickname->nickname);
        }
        return response()->json($tracks);
    }

    //получить все мои треки
    public function get_my_tracks() {
        $tracks = [];
        $tracksPerson = personTrack::query()->where('user_id', Auth::id())->get();
        foreach($tracksPerson as $trackPerson) {
            $track = Track::query()->where('id', $trackPerson->track_id)->first();
            array_push($tracks, $track);
        }
        return response()->json($tracks);
    }
}
