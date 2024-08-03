<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\UserGenre;
use App\Models\Playlist;
use App\Models\UserPlaylist;

class UserController extends Controller
{
    //регистрация пользователя
    public function registration(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'phone' => ['required'],
            'password' => ['required', 'confirmed'],
            'rule' => ['required'],
        ]);
        if ($valid->fails()) {
            return response()->json($valid->errors(), 400);
        }
        // dd($request->all());
        $user = new User();
        $user->phone = $request->phone;
        $user->password = md5($request->password);
        $user->save();
        Auth::login($user);
        $playlist = new Playlist();
        $playlist->title = 'Мои биты';
        $playlist->user_id = $user->id;
        $playlist->text = '';
        $playlist->img = '';
        $playlist->save();
        $user_playlist = new UserPlaylist();
        $user_playlist->user_id = $user->id;
        $user_playlist->playlist_id = $playlist->id;
        $user_playlist->save();
        return response()->json('Вы зарегистрированы');
        // dd($request->all());
    }

    //выход
    public function exit()
    {
        Auth::logout();
        return redirect()->route('welcome');
    }

    //авторизация
    public function auth(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'phone' => ['required'],
            'password' => ['required'],
        ]);
        if ($valid->fails()) {
            return response()->json($valid->errors(), 400);
        }
        $user = User::query()->where('phone', $request->phone)->where('password', md5($request->password))->first();
        if ($user) {
            Auth::login($user);
            return response()->json();
        } else {
            return response()->json('Пользователь не найден', 401);
        }
    }

    //сохранить изменения в профиле
    public function save_profile_changes(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'login' => [Rule::unique('users', 'login')->ignore(Auth::id()), 'nullable'],
            'phone' => [Rule::unique('users', 'phone')->ignore(Auth::id())],
            'password' => ['nullable', 'confirmed'],
        ]);
        if ($valid->fails()) {
            return response()->json($valid->errors(), 400);
        }
        $user = User::query()->where('id', Auth::id())->first();
        if ($request->file('photo')) {
            $file = $request->file('photo')->store('/public/img');
            $user->img = '/storage/' . $file;
        }
        $user->login = $request->login;
        $user->birthday = $request->birthday;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        if ($request->password) {
            $user->password = $request->password;
        }
        $genres = UserGenre::query()->where('user_id', Auth::id())->get();
        foreach ($genres as $genre) {
            $genre->delete();
        }
        $genres_change = explode(',', $request->genres); //разделить по запятой пришедшую строку
        foreach ($genres_change as $genre) {
            $userGenre = new UserGenre();
            $userGenre->user_id = Auth::id();
            $userGenre->genre_id = $genre;
            $userGenre->save();
        }
        $user->update();
        return response()->json('Данные сохранены');
        // dd($request->all());
        // dd($request->all());
    }

    //подтвердить заявку пользователя на исполнителя
    public function confirm_artist($application)
    {
        // dd($application);
        $applic = Application::query()->where('id', $application)->first();
        $user = User::query()->where('id', $applic->user_id)->first();
        $user->status = 'исполнитель';
        $applic->status = 'одобрена';
        $applic->update();
        $user->update();
        return redirect()->back();
    }

    //отменить заявку пользователя на исполнителя
    public function cancel_artist($application)
    {
        $applic = Application::query()->where('id', $application)->first();
        $user = User::query()->where('id', $applic->user_id)->first();
        $user->status = '';
        $user->nackname = '';
        $applic->status = 'отклонена';
        $applic->update();
        $user->update();
        return redirect()->back();
    }

    //получить всех исполнителей
    public function get_all_artists()
    {
        $artists = User::query()->where('status', 'исполнитель')->where('id', '!=', Auth::id())->get();
        // dd($artists);
        return response()->json($artists);
    }
}
