<?php 
namespace App\Components;
use App\Models\Category ;
class Recusive {
    private $data;
    private $htmlSelect = '';
    public function __construct($data)
    {
        $this->data = $data;
    }
    function categoryRecusive($parentid,$id=0 , $text = ''){
     //   $data = Category :: all();
        foreach($this->data as $value){
            if($value['parent_id']== $id){
                if(! empty($parentid) && $parentid == $value['id']){
                    $this->htmlSelect .= "<option selected  value='". $value['id'] ."'>" .$text. $value['name'] . "</option>";
                }else{
                    $this->htmlSelect .= "<option value='". $value['id'] ."'>" .$text. $value['name'] . "</option>"; 
                }
                
              $this->categoryRecusive($parentid,$value['id'] , text: $text.' '.'-');
            }
        }
        return $this->htmlSelect;
    }
}