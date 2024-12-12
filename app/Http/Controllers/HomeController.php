<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $apartment = $user->apartment;
        if(!$apartment) {
            return view('welcome');
        }
        $users = app(User::class)->pluck('name', 'id');
        $residents = $apartment->residents->pluck('id')->toArray();

        return view('home', compact('apartment', 'users', 'residents'));
    }
}
