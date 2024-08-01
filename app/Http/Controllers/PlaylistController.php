<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\trackPlaylist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
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
    public function show(Playlist $playlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Playlist $playlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Playlist $playlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Playlist $playlist)
    {
        //
    }

    //создать плейлист и добавить туда трек
    public function createPlaylist($id, Request $request) {
        // dd($request->all());
        $valid = Validator::make($request->all(), [
            'img'=>['required', 'mimes:png,jpg'],
            'title'=>['required'],
            'text'=>['nullable'],
        ]);
        if ($valid->fails()) {
            return response()->json($valid->errors(), 400);
        }
        $playlist = new Playlist();
        $playlist->title = $request->title;
        $file = $request->file('img')->store('/public/img');
        $playlist->img = '/storage/'.$file;
        $playlist->text = $request->text;
        $playlist->user_id = Auth::id();
        $playlist->save();
        $track = new trackPlaylist();
        $track->track_id = $id;
        $track->playlist_id = $playlist->id;
        $track->save();
        return response()->json('Плейлист создан. Трек добавлен');
    }

    //получить все плейлисты пользователя
    public function get_all_userPlaylists() {
        $playlists = Playlist::query()->where('user_id', Auth::id())->get();
        // dd($playlists);
        return response()->json($playlists);
    }

    //добавить трек в плейлитс
    public function add_track_playlist($playlist_id, $track_id) {
        // dd($playlist_id, $track_id);
        $playlists = trackPlaylist::query()->where('playlist_id', $playlist_id)->get();
        $isTrack = trackPlaylist::query()->where('playlist_id', $playlist_id)->where('track_id', $track_id)->first();
        if($isTrack) {
            return redirect()->back();
        } else {
            $track = new trackPlaylist();
            $track->track_id = $track_id;
            $track->playlist_id = $playlist_id;
            $track->save();
            return redirect()->back();
        }
    }

    public function add_track_my_playlist(Request $request) {
        // dd($request->all());
        $playlists = trackPlaylist::query()->where('playlist_id', $request->playlist)->get();
        $isTrack = trackPlaylist::query()->where('playlist_id', $request->playlist)->where('track_id', $request->track)->first();
        if($isTrack) {
            return redirect()->back();
        } else {
            $track = new trackPlaylist();
            $track->track_id = $request->track;
            $track->playlist_id = $request->playlist;
            $track->save();
            return redirect()->back();
        }
    }

    //получить все плейлисты
    public function get_all_playlists() {
        $playlists = Playlist::query()->where('title', '!=', 'Мои биты')->get();
        return response()->json($playlists);
    }
}
