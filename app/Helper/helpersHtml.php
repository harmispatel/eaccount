<?php 

function createActivitySelectBox($items=[],$selectedOption=""){
    $html = '<option value="0" class="font-custom-bold">Main Activity</option>';
    if(count($items)){
        foreach($items as $item){
           
            $html .= '<option value="'.$item->id.'"';
            if($item->parent_id == $selectedOption){
                $html .= 'selected';    
            }
            $html .= '>'.$item->title.'</option>';
            $subActivities = $item->hasManySubActivity ? $item->hasManySubActivity : [];   
            if(count($subActivities)){
                $html .= createSubActivity($subActivities,'sub',$selectedOption);
            }
            
        }
    }
    return $html;
}
function createSubActivity($items=[], $type = "subOne",$selectedOption=""){
    $html = "";
    if(count($items)){
        foreach($items as $key => $item){
            $subActivities = [];
            $html .= '<option value="'.$item->id.'"';
            if($item->parent_id == $selectedOption){
                $html .= 'selected';    
            }
            $html .= '>';
            if($type == 'sub'){
                $html .= ' - '.$item->title;
            }
            elseif($type == 'subOne'){
                $html .= '- - '.$item->title;
            }
            $html .= '</option>';
            $subActivities = $item->hasManySubActivity ? $item->hasManySubActivity : [];  
            if(count($subActivities)>0){
                $html .= createSubActivity($subActivities,'subOne');
            }
        }
    }
    return $html;
}
