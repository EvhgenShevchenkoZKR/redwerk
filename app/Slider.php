<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';

    protected $fillable = [
        'image',
        'weight',
        'body',
        'link_text',
        'url',
        'published',
    ];

    /**
     * Every new Slide should get maximum weight
     */
    public function setMaxWeight(){
        $weight = \DB::table($this->table)
            ->select('weight')
            ->orderBy('weight', 'desc')
            ->limit(1)
            ->get();
        if(isset($weight[0])){
            $this->weight = $weight[0]->weight + 1;
        }
    }

    public static function orderedSliders(){
        return self::select('*')->orderBy('weight', 'asc')->get();
    }

    public static function getPublishedSlides(){
        return self::where('published', true)->orderBy('weight', 'asc')->get();
    }
}
