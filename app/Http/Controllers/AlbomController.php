<?php

namespace App\Http\Controllers;

use App\Models\Albom;
use App\Models\GenreAlbom;
use App\Models\User;
use App\Models\trackAlbom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AlbomController extends Controller
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
    public function show(Albom $albom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Albom $albom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Albom $albom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Albom $albom)
    {
        //
    }

    //добавить альбом
    public function add_album(Request $request) {
        // dd($request->all());
        $valid = Validator::make($request->all(), [
            'img_albom'=>['required', 'mimes:png,jpg'],
            'title'=>['required'],
            'genre_album'=>['required'],
            'album_date_relize'=>['required'],
            'description'=>['nullable'],
        ]);
        if ($valid->fails()) {
            return response()->json($valid->errors(), 400);
        }
        $album = new Albom();
        $album->title = $request->title;
        $file = $request->file('img_albom')->store('/public/img');
        $album->img = '/storage/'.$file;
        $album->user_id = Auth::id();
        $album->date = $request->album_date_relize;
        $album->save();
        $genre = new GenreAlbom();
        $genre->genre_id = $request->genre_album;
        $genre->albom_id = $album->id;
        $genre->save();
        foreach($request->album_tracks as $track) {
            $album_track = new trackAlbom();
            $album_track->track_id = $track;
            $album_track->albom_id = $album->id;
            $album_track->save();
        }
        return response()->json('Альбом создан');
    }

    //получить все альбомы
    public function get_all_albums() {
        $albums = Albom::all();
        foreach($albums as $album) {
            $author = User::query()->where('id', $album->user_id)->first();
            $album['author'] = $author->nickname;
        }
        return response()->json($albums);
    }

    //получить все мои альбомы
    public function get_my_albums() {
        $albums = Albom::query()->where('user_id', Auth::id())->get();
        return response()->json($albums);
    }
}
