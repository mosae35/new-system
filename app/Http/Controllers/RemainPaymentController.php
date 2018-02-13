<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\process;
use \App\out_process;

class RemainPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $in_process = process::where('not_cash','!=',0)->orderby('id','desc')->paginate(10);
        $out_process = out_process::where('in_cash','!=',0)->orderby('id','desc')->paginate(10);
        return view('remain_payment.index', compact('in_process','out_process'));
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function doctor_search(Request $request){
        $in_data = process::where('not_cash','!=',0)->where('doctor',$request['name'])->get();
        $out_data = out_process::where('in_cash','!=',0)->where('doctor',$request['name'])->get();
       // $in_out = array_collapse([$in_data,$out_data]);
        $data = $request->name;
        return view('remain_payment.doctor_process',compact('in_out','data','in_data','out_data'));

    }

    public function ajax(Request $request)
    {
        $search = $request['search'];

        if(!empty($search)){
            $data = DB::table('processes')
                ->where('not_cash','!=',0)->orderby('id','desc')
                ->where('name', 'like' , '%'.$search.'%')
                ->get();
            return view('remain_payment.search_in',compact('data','search'));
        }else{
            $data = process::select('*')
                ->where('not_cash','!=',0)->orderby('id','desc')
                ->paginate(10);
            return view('remain_payment.replace_in',compact('data'));
        }
    }


    public function ajax_out(Request $request)
    {

        $search = $request['search_out'];
        if(!empty($search)){
            $data = DB::table('out_processes')
                ->where('in_cash','!=',0)->orderby('id','desc')
                ->where('name', 'like' , '%'.$search.'%')
                ->get();
            return view('remain_payment.search_out',compact('data','search'));
        }else{
            $data = out_process::select('*')
                ->where('in_cash','!=',0)
                ->orderby('id','desc')
                ->paginate(10);
            return view('remain_payment.replace_out',compact('data'));
        }
    }

}
