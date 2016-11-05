<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SliderRequest;
use App\Slider;
use App\Menu;
use Intervention\Image\Facades\Image; //it could be used if we decide to crop or resize images
use File;

class SliderController extends Controller
{
    protected $mainMenu;

    public function __construct(){
        $this->middleware('auth');
        $this->mainMenu = Menu::getPublishedMenuItems();
    }

    public function create(){

        return view('slider.create',[
            'mainMenu' => $this->mainMenu,
        ]);
    }

    public function store(SliderRequest $request){

        $slider = new Slider($request->all());
        $slider->setMaxWeight();
        $slider->save();

        //we have to save slider twice, because we need it`s id to create folder for images
        $this->addImage($slider, $request);
        $slider->save();

        return redirect()->back()->with('message', 'Success');
    }

    public function edit(Slider $slider){

        return view('slider.edit',[
            'slider' => $slider,
            'mainMenu' => $this->mainMenu,
        ]);
    }

    public function update(Slider $slider, SliderRequest $request){

        $currentImage = $slider->image;
        $slider->fill($request->all());

        if($request->file('image')){
            $this->dropImage($slider, $currentImage);
            $this->addImage($slider, $request);
        }
        $slider->save();

        return redirect()->back()->with('message', 'Success');
    }

    public function remove(Slider $slider){
        $dir = base_path() . "/public/images/slides/$slider->id/";
        File::deleteDirectory($dir);
        $slider->delete();
        return redirect()->back()->with('message', 'Success');
    }

    public function adminIndex(){

        return view('slider.admin_index',[
            'sliders' => Slider::orderedSliders(),
            'mainMenu' => $this->mainMenu,
        ]);
    }

    public function ajaxReorder(Request $request){

        $orderedArray = $this->unserializeNestedString($request->menudata);
        $i = 0;
        foreach($orderedArray as $key=>$value){
            $i++;
            $slider = Slider::find($key);
            $slider->weight = $i;
            $slider->save();
        }

        $response = array(
            'status' => 'success',
            'msg' => 'Success',
        );
        return \Response::json($response);

    }

    private function addImage($slider, $request){
        $file = $request->file('image');
        if($file){
            $slider->image = $file->getClientOriginalName();
            $this->createImage($file, $slider->id);
        }
    }

    /**
     * Removing file
     */
    private function dropImage($slider, $currentImage){

        $file = base_path() . "/public/images/slides/$slider->id/$currentImage";
        File::delete($file);
    }


    /**
     * Saving image file
     */
    protected function createImage($file, $materialId){

        $fileName = $file->getClientOriginalName();
        $file->move(
            base_path() . "/public/images/slides/$materialId/", $fileName
        );
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
