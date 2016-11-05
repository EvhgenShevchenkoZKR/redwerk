<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Slider;

class HomeController extends Controller
{


    public function __construct() {

    }


    public function index()
    {
        $menus = Menu::buildMainMenu();
        $sliders = Slider::getPublishedSlides();
        return view('pages.home', [
            'menus' => $menus,
            'sliders' => $sliders,
        ]);
    }

    public function  terms(){
        $menus = Menu::buildMainMenu();
        $sliders = Slider::getPublishedSlides();
        return view('pages.terms', [
            'menus' => $menus,
            'sliders' => $sliders,
        ]);
    }


}
