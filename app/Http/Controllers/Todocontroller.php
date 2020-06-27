<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\T1;

class Todocontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('readTable');
    }
    public function readTable()
    {
        $data = T1::all();
        return  view('todo_index', ['data' =>$data]);
    }

    public function update(Request $update)
    {
        $id = $update->input('no');
        $item = $update->input('item');
        T1::find($id)->update(['item'=>"$item",'update_user'=>'admin']);
        //return redirect()->back()->with('message', 'please login');
        //return 'please login';
        return redirect('todolist');
    }
    public function delete(Request $delete)
    {
        $id = $delete->input('no');
        T1::find($id)->delete();
        return redirect('todolist');
        // return $delete;
    }
    public function create(Request $create)
    {
        $item = $create->input('item');
        T1::create(['item'=>"$item",'status'=>'未完成','update_user'=>'admin']);
        //return 'create successfully';
        return redirect('todolist');
    }
}
