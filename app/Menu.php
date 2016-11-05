<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'title',
        'url',
        'weight',
        'parent_id',
        'published',
    ];

    public static function getPublishedMenuItems(){
        return self::where('published', true)->get();
    }

    /**
     * Every new Menu element should get maximun weight
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

    public static function buildMainMenu(){
        $mainMenu = self::where('published', true)
            ->where('parent_id', 0)
            ->orderBy('weight', 'asc')
            ->get();

        foreach($mainMenu as $key => $menuItem) {
            $subMenus = [];
            $sub = self::where('published', true)
                ->where('parent_id', $menuItem->id)
                ->orderBy('weight', 'asc')
                ->get();
            if(count($sub)){
                foreach($sub as $subMenuItem){
                    $subMenus[] = $subMenuItem;
                }
                $mainMenu[$key]['submenus'] = $subMenus;
            }
        }
        return $mainMenu;
    }

}
