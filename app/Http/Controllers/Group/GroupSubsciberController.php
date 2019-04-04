<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupSubsciberController extends Controller
{
    public function subscribe(Request $request){
        $group=null;
        try{
            $group=\App\Group::findOrFail($request->group_id);
        }catch(ModelNotFoundException $e){
            abort(404,'ciao');
        }
        $group->users()->attach(\Auth::user()->id,["privilege"=>4]);
        return json_encode("");
    }


    public function addUser(Request $request){
        $group=\App\Group::find(1)->users()->updateExistingPivot($request->user,["privilege"=>3]);
        return json_encode("");
    }
    public function denyUser(Request $request){
        $group=\App\Group::find(1)->users()->updateExistingPivot($request->user,["privilege"=>5]);
        return json_encode("");
    }
}
