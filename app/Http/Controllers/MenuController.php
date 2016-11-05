<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use Illuminate\Http\Request;
use App\Menu;

class MenuController extends Controller
{
    protected $mainMenu;

    public function __construct(){
        $this->middleware('auth');
        $this->mainMenu = Menu::getPublishedMenuItems();
    }

    public function create(){

        return view('menu.create',[
            'mainMenu' => $this->mainMenu,
        ]);
    }

    public function store(MenuRequest $request){

        $menu = new Menu($request->all());
        $menu->setMaxWeight();
        $menu->save();

        return redirect()->back()->with('message', 'Success');
    }

    public function edit(Menu $menu){

        return view('menu.edit',[
            'menu' => $menu,
            'mainMenu' => $this->mainMenu,
        ]);
    }

    public function update(Menu $menu, MenuRequest $request){

        $menu->fill($request->all());
        $menu->save();

        return redirect()->back()->with('message', 'Success');
    }

    public function remove(Menu $menu){

        $menu->delete();
        return redirect()->back()->with('message', 'Success');
    }

    public function adminIndex(){

        return view('menu.admin_index',[
            'main_menus' => $this->buildNestedMenu(),
            'mainMenu' => $this->mainMenu,
        ]);
    }

    public function ajaxReorder(Request $request){

        $orderedArray = $this->unserializeNestedString($request->menudata);
        $i = 0;
        foreach($orderedArray as $key=>$parent){
            $i++;
            $main_menu = Menu::find($key);
            $main_menu->weight = $i;
            if($parent == 'null'){ $parent = 0; } //converting from js 'null' to php 0
            $main_menu->parent_id = $parent;
            $main_menu->save();
        }

        $response = array(
            'status' => 'success',
            'msg' => 'Success',
        );
        return \Response::json($response);

    }

    /**
     * For admin index page we have to build some kind of nested array
     */
    private function buildNestedMenu(){
        $main_menus = Menu::where('parent_id', 0)->orderBy('weight')->get();
        $main_menus = $main_menus->toArray();
        foreach ($main_menus as $key => $main_menu){
            $sub = Menu::where('parent_id', $main_menu['id'])->orderBy('weight')->get();
            if(!empty($sub)){
                $main_menus[$key]['subtypes'] = $sub->toArray();
            }
        }
        return $main_menus;
    }

    /**
     * nestedSortable unserialization
     * @param $string
     * @return array
     */
    private function unserializeNestedString($string){
        $pieces = explode("&", $string);
        $result = array();
        foreach ($pieces as $peace){
            $pic = explode('=',$peace);
            $pic[0] = str_replace('list[', '', $pic[0]);
            $pic[0] = str_replace(']', '', $pic[0]);
            if(is_numeric($pic[0])){
                $result[$pic[0]] = $pic[1];
            }
        }
        return $result;
    }

}
