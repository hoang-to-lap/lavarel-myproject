<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\Recusive;
use App\Components\MenuRecusive;
use App\Models\Menu;
class MenuController extends Controller
{
    private $menu;
public function __construct(Menu $menu){
    $this->menu = $menu;
}

public function list(){
    $list = $this->menu->latest()->paginate(5);

    return view('menu.list' , compact('list'));

}
    public function create(){
        $htmlOption = $this->getMenu($parentid='');
        return view('menu.add' , compact('htmlOption'));
    }
    public function store(Request $request){
        $this->menu->create(
            [
                'name' =>$request->txtName,
                'parent_id'=>$request->txtParent_id ,
                
            ]
            );
      return redirect()->route(route:'menus.list');

    }
    function getMenu($parentid){
        $data = $this->menu->all();
        $recusive = new MenuRecusive($data);
        
        $htmlOption =   $recusive->categoryRecusive($parentid);
        return $htmlOption;
    }
}
