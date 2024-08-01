<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Track;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //показать главную страницу
    public function welcome() {
        $tracks = Track::query()->where('status', 'В доступе')->get();
        return view('welcome', ['tracks'=>$tracks]);
    }

    //показать страницу регистрации
    public function show_registration() {
        $genres = Genre::all();
        return view('guest.registration', ['genres'=>$genres]);
    }

    //показать страницу авторизации
    public function show_auth() {
        return view('guest.auth');
    }

    //показать страницу с жанрами (для админа)
    public function show_admin_genres() {
        $genres = Genre::all();
        return view('admin.genres', ['genres'=>$genres]);
    }

    //показать профиль пользователя
    public function show_profile() {
        $user = Auth::user();
        $genres = Genre::all();
        $categories = Category::all();
        return view('user.profile', ['user'=>$user, 'genres'=>$genres, 'categories'=>$categories]);
    }

    //показать страницу с заявками на исполнителей
    public function show_admin_users() {
        $category = Category::query()->where('title', 'стать исполнителем')->first();
        $applications = Application::query()->where('category_id', $category->id)->where('status', 'новый')->get();
        return view('admin.users', ['applications'=>$applications]);
    }

    //показать все треки (админ) для отметки цензуры
    public function show_admin_tracks() {
        $tracks = Track::all();
        return view('admin.tracks', ['tracks'=>$tracks]);
    }

    //показать страницу для проигрывания трека
    public function show_page_play($track) {
        $song = Track::query()->where('id', $track)->first();
        return view('guest.playPage', ['track'=>$song]);
    }

    //показать страницу поиска
    public function show_search_page() {
        return view('guest.searchPage');
    }

    //показать страницу с работами испольнителя
    public function show_works_page() {
        $categories = Category::all();
        return view('user.works', ['categories'=>$categories]);
    }
}
