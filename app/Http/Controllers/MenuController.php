<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\Recusive;
use App\Components\MenuRecusive;
use App\Models\Menu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
class MenuController extends Controller
{
    private $menu;
public function __construct(Menu $menu){
    $this->menu = $menu;
}
public function AuthLog(){
    $admin_id = Session::get('id');
    if($admin_id){
        return redirect()->to(path:'home');
    }else{
        return redirect()->route(route:'back')->send();
    }
}

public function list(){
    $this->AuthLog();
    $list = $this->menu->latest()->paginate(5);

    return view('menu.list' , compact('list'));

}
    public function create(){
        $this->AuthLog();
        $htmlOption = $this->getMenu($parentid='');
        return view('menu.add' , compact('htmlOption'));
    }
    public function store(Request $request){
        $this->AuthLog();
        $this->menu->create(
            [
                'name' =>$request->txtName,
                'parent_id'=>$request->txtParent_id ,
                'slug' => Str::slug($request->txtName)
                
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
    public function edit($id){
        $this->AuthLog();
        $menu = $this->menu->findOrFail($id);
        $htmlOption = $this->getMenu($menu->parent_id);
        
        
        
        return view('menu.edit' , compact('menu','htmlOption'));
    }
    public function update($id , Request $request){
        $this->AuthLog();
        $this->menu->findOrFail($id)->update(
            [
                'name' =>$request->txtName,
                'parent_id'=>$request->txtParent_id ,
                'slug' => Str::slug($request->txtName)
                
            ]
            );
            return redirect()->route(route:'menus.list');

    }
    public function delete($id){
        $this->AuthLog();
$this->menu->find($id)->delete();
return redirect()->route(route:'menus.list');
    }
}
