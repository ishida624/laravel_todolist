<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TodosRequest;
use App\T1;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = T1::all();
        // return $index;
        return response($index, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodosRequest $request)
    {
        $item = $request->item;
        // $validate = $request->validate(['item' => 'required']) ;
        // if (!$item) {
        //     return response()->json(['message' =>'bad request' , 'reason' => 'item can not null' ], 400);
        // }
        // $rules=[
        //             'item' => 'required|max:255',
        //         ];
        // $messages = [
        //     'item.required' => 'item can not null.' ,
        //     'item.max' => 'item can not over 255 characters'
        // ];
        // $validator = Validator::make($request->all(), $rules, $messages);
        // if ($validator->fails()) {
        //     return response()->json(['message'=>$validator], 400);
        // }

        $store = T1::create(['item'=>$item,'status'=>'未完成','update_user'=>'admin']);
        // return $store;
        return response()->json(['message' =>'create successfully' , 'content' =>$store ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show = T1::find($id);
        if (!$show) {
            return response()->json(['message' =>'bad request' , 'reason' => 'item search not found' ], 400);
        }
        // return $show;
        return response($show, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TodosRequest $request, $id)
    {
        $item = $request->item;
        // if (!$item) {
        //     return response()->json(['message' =>'bad request' , 'reason' => 'item can not null' ], 400);
        // }
        $update = T1::find($id);
        if (!$update) {
            return response()->json(['message' =>'bad request' , 'reason' => 'item search not found' ], 400);
        }
        $update->update(['item'=>"$item",'update_user'=>'admin']);
        return response()->json(['message' =>'update successfully' , 'content' =>$update ], 201);
        // return 'update successfully';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = T1::find($id);
        if (!$delete) {
            return response()->json(['message' =>'bad request' , 'reason' => 'item search not found' ], 400);
        }
        $delete->delete();
        return response()->json(['message' =>'delete successfully'], 201);
        // return 'delete successfully';
    }
}
