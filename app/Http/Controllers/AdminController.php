<?php

namespace App\Http\Controllers;

use App\used;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \App\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::select('*')->orderBy('id','desc')->paginate(10);
        return view('users.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Request $request, $id)
    {
        $data = User::findOrFail($id);
        return view('users.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request = $request->all();
        User::findOrFail($id)->update($request);
        return redirect('user')->with(['message'=>'تم تعديل العضو بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with(['message'=>'تم حذف العضو بنجاح']);
    }


    public function edit_password(Request $request, $id)
    {
        $request = $request->all();
        $old_passowrd = User::findOrFail($id);

        if (Hash::check($request['old_password'], $old_passowrd->password)) {
            $hash = Hash::make($request['new_password']);
            $old_passowrd->password = $hash;
            $old_passowrd->save();
            return redirect()->back()->with(['message' => 'تم تعديل كلمة السر']);
        } else {
            $message = 'عفوا كلمة السر غير صحيحة';
            return redirect()->back()->with(['message' => $message]);
        }

    }
}
