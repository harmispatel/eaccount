<?php

use App\Notification;

function createActivitySelectBox($items=[],$selectedOption=""){
    $html = '<option value="0">Main Activity</option>';
    
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

function getUserNotification(){
    $id = Auth()->user()->id;
    $getlist = Notification::where('receiver_id',$id)->where('is_read',0)->get();
    $html = '';

    if(count($getlist)>0){
        foreach($getlist as $getlistone){
            $icon = "fa fa-mail";
            $bgcolor = "grey";
            $getType = $getlistone->hasOneType ? $getlistone->hasOneType : []; 
            if(!empty($getType)){
                $icon = $getType->icon;
                $bgcolor = $getType->bg_color;
            }

            $html .= '<li>
                    <a href="javascript:void(0);">
                        <div class="icon-circle bg-light-green">
                            <i class="'.$icon.'"></i>
                        </div>
                        <div class="menu-info">
                            <h4>'.$getlistone->title.'</h4>
                            <p>
                                <i class="material-icons">access_time</i> '.$getlistone->created_at.'
                            </p>
                        </div>
                    </a>
                </li>';
        }
    }
    return $html;
}

function getUserNotificationCount(){
    $id = Auth()->user()->id;
    $getlist = Notification::where('receiver_id',$id)->where('is_read',0)->count();
    return $getlist;
}