<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Slider;

class HomeController extends Controller
{

    private $menus;

    private $sliders;

    public function __construct(){
        $this->menus = Menu::buildMainMenu();
        $this->sliders = Slider::getPublishedSlides();
    }
    /**
     * Homepage
     */
    public function index()
    {

        return view('pages.home', [
            'menus' => $this->menus,
            'sliders' => $this->sliders,
        ]);
    }

    /**
     * Terms of use page - it`s 100% dummy
     */
    public function  terms(){

        return view('pages.terms', [
            'menus' => $this->menus,
            'sliders' => $this->sliders,
        ]);
    }


}
