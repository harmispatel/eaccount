@php
    $department = $item->hasOneDepartment ? $item->hasOneDepartment : [];  
    $costItems = $item->hasManySubCost_item ? $item->hasManySubCost_item : [];   
@endphp
<tr @if (Auth::id()==$item->id) class="bg-tr" @endif >
    <th class="text-center">
        <input name="items[id][]" value="{{ $item->id }}"
            type="checkbox" id="md_checkbox_{{ $index }}"
            class="chk-col-cyan selects "/>
        <label for="md_checkbox_{{ $index }}"></label>
    </th>
    <td>     
        {{!empty($department) ? $department->department_code : ''}}/{{$item->activity_code ? $item->activity_code : ''}}
    </td>
    <td class="w-csm-40">
        @if($type == 'sub')
            -
        @elseif($type == 'subOne')
             -  -
        @endif
        <a href="@if(!empty($project)){{ route('cost_item',['activityId'=>$item->id,'projectId'=>$project->id])}}@else{{ route('cost_item')}}@endif"> {{$item->title }}</a><span style="color:#ff0000;margin-left: 10px;">@if($type != 'parent')({{count($costItems)}})@endif</span>
    </td>
    <td>     
        {{!empty($department) ? $department->departmentName : ''}}
    </td>
    <td>
        @php
            $activitytoquarters = $item->hasManyActivitytoquarter ? $item->hasManyActivitytoquarter : [];
            $activitytoquarterName = [];
    
            if (count($activitytoquarters)){
                foreach ($activitytoquarters as $activitytoquarter){
                    $quarter = $activitytoquarter->hasOneQuarter ? $activitytoquarter->hasOneQuarter : [];
                    $activitytoquarterName[] = $quarter->name ? $quarter->name : '';
                }
            }
        @endphp
        {{count($activitytoquarterName) ? implode(',',$activitytoquarterName) : '-' }}
    </td>
    

    <td class="tdTrashAction  w-csm-20">
        
        @if($project->status == 8)
            <a @if ($edit==0) class="dis-none" @endif class="btn btn-xs btn-info waves-effect" href="@if (!empty($project)){{ route($ParentRouteName.'.edit',['id'=>$item->id,'projectId'=>$project->id]) }}@else{{ route($ParentRouteName.'.edit',['id'=>$item->id]) }}@endif" data-toggle="tooltip" data-placement="top" title="Edit"><i class="material-icons">mode_edit</i></a>
            <a data-target="#largeModal" class="btn btn-xs btn-success waves-effect ajaxCall hidden"
            href="{{  route($ParentRouteName.'.show',['id'=>$item->id])  }}" data-toggle="tooltip" data-placement="top" title="Preview"><i class="material-icons">pageview</i></a>
            <a @if ($delete==0) class="dis-none" @endif class="btn btn-xs btn-danger waves-effect" href="@if (!empty($project)){{ route($ParentRouteName.'.destroy',['id'=>$item->id,'projectId'=>$project->id]) }}@else{{ route($ParentRouteName.'.destroy',['id'=>$item->id]) }}@endif" data-toggle="tooltip" data-placement="top" title="Trash"> <i class="material-icons">delete</i></a>
        @else
            <a @if ($edit==0) class="dis-none" @endif class="btn btn-xs waves-effect" style="background-color:#808080" data-toggle="tooltip" data-placement="top" title="Edit"><i class="material-icons" style="color:#fff">mode_edit</i></a>
            <a data-target="#largeModal" class="btn btn-xs btn-success waves-effect ajaxCall hidden" data-toggle="tooltip" data-placement="top" title="Preview"><i class="material-icons" style="color:#fff">pageview</i></a>
            <span  class="btn btn-xs waves-effect" style="background-color:#808080" ><i class="material-icons"style="color:#fff">delete</i></span>

        @endif
    </td>

</tr> 