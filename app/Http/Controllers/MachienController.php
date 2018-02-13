<?php

namespace App\Http\Controllers;

use App\machien;
use Illuminate\Http\Request;

class MachienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $process = machien::select('*')->orderby('id','desc')->paginate(10);
        return view('machien.index',compact('process'));
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
        $request = $request->all();
        $request['user_id'] = \Auth::id();
        machien::create($request);
        return redirect()->back()->with(['message'=>'تمت عمليه الاضافه بنجاح']);
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
    public function edit($id)
    {
        $data = machien::findOrFail($id);
        return view('machien.edit',compact('data'));
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
        machien::findOrFail($id)->update($request);
        return redirect('/machien')->with(['message'=>'تم التعديل على الحاله بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        machien::findOrFail($id)->delete();
        return redirect()->back()->with(['message'=>'تم الحذف بنجاح']);
    }
}
