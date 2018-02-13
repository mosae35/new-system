<?php

namespace App\Http\Controllers;

use App\out_add_sort_a;
use App\out_add_sort_b;
use App\out_add_sort_c;
use Illuminate\Http\Request;
use Illuminate\support\facades\DB;
use Validator;

class OutStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $in_data = out_add_sort_a::select('*')->orderby('id','desc')->paginate('10');
        $data_b = out_add_sort_b::select('*')->orderby('id','desc')->paginate('10');
        $data_c = out_add_sort_c::select('*')->orderby('id','desc')->paginate('10');
        return view('out_store.index',compact('in_data','data_b','data_c'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('out_store.out_sort_add_a');
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
        $rules = [
            'sort'    => 'required|min:2|max:100|string',
            'size'   => 'required|numeric|min:0',
            'num'    => 'required|numeric|min:0',
        ];

        $messages = [
            'required' => 'عفوا لابد من كتابه البيانات كامله ',
            'numeric' => 'عفوا هذا العنصر لابد ان يكون رقم',
            'min'=>'عفوا هذا العنصر لا يمكن ان يكون اقل من 2 احرف',
            'num.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'size.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'string'=>'عفوا هذا العنصر لابد ان لا يحتوى على ارقام'
        ];
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{

            out_add_sort_a::create($request);
            return redirect('/out_store')->with(['message'=>'تم اضافه عنصر جديد الى المخزن']);
        }
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
        $sort_a = out_add_sort_a::FindOrfail($id);
        return view('out_store.edit_a',compact('sort_a'));
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

        $rules = [
            'sort'    => 'required|min:2|max:100|string',
            'size'   => 'required|numeric|min:0',
            'num'    => 'required|numeric|min:0',
        ];

        $messages = [
            'required' => 'عفوا لابد من كتابه البيانات كامله ',
            'numeric' => 'عفوا هذا العنصر لابد ان يكون رقم',
            'min'=>'عفوا هذا العنصر لا يمكن ان يكون اقل من 2 احرف',
            'num.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'size.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'string'=>'عفوا هذا العنصر لابد ان لا يحتوى على ارقام'
        ];
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{
            out_add_sort_a::findOrFail($id)->update($request);
            return redirect('/out_store')->with(['message'=>'تم تعديل العنصر بنجاح ']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        out_add_sort_a::FindOrfAIL($id)->delete();
        return redirect()->back()->with(['message'=>'تم حذف العنصر بنجاح ']);
    }

    //add sort b
    public function show_sort_b(){
        return view('out_store.sort_b.add_sort_b');
    }
    public function add_sort_b(Request $request){
        $request = $request->all();
        $request['user_id'] = \Auth::id();


        $rules = [
            'sort'    => 'required|min:2|max:100|string',
            'size'   => 'required|numeric|min:0',
            'num'    => 'required|numeric|min:0',
        ];

        $messages = [
            'required' => 'عفوا لابد من كتابه البيانات كامله ',
            'numeric' => 'عفوا هذا العنصر لابد ان يكون رقم',
            'min'=>'عفوا هذا العنصر لا يمكن ان يكون اقل من 2 احرف',
            'num.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'size.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'string'=>'عفوا هذا العنصر لابد ان لا يحتوى على ارقام'
        ];
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{
            out_add_sort_b::create($request);
            return redirect('/out_store')->with(['message'=>'تم اضافه عنصر جديد الى المخزن']);
        }
    }
    public function remove_sort_b($id){
        out_add_sort_b::findOrFail($id)->delete();
        return redirect()->back()->with(['message'=>'تم حذف العنصر بنجاح ']);
    }
    public function edit_sort_b($id){
        $edit_sort_b = out_add_sort_b::findOrFail($id);
        return view('out_store.sort_b.edit_b',compact('edit_sort_b'));
    }
    public function sort_b_update(Request $request,$id){
        $request = $request->all();

        $rules = [
            'sort'    => 'required|min:2|max:100|string',
            'size'   => 'required|numeric|min:0',
            'num'    => 'required|numeric|min:0',
        ];

        $messages = [
            'required' => 'عفوا لابد من كتابه البيانات كامله ',
            'numeric' => 'عفوا هذا العنصر لابد ان يكون رقم',
            'min'=>'عفوا هذا العنصر لا يمكن ان يكون اقل من 2 احرف',
            'num.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'size.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'string'=>'عفوا هذا العنصر لابد ان لا يحتوى على ارقام'
        ];
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{
            out_add_sort_b::findOrFail($id)->update($request);
            return redirect('/out_store')->with(['message'=>'تم تعديل العنصر بنجاح ']);
        }
    }


    //add sort c
    public function show_sort_c(){
        return view('out_store.sort_c.add_sort_c',compact([ 'var' =>'mosa']));
    }
    public function add_sort_c(Request $request){
        $request = $request->all();
        $request['user_id'] = \Auth::id();

        $rules = [
            'sort'    => 'required|min:2|max:100|string',
            'size'   => 'required|numeric|min:0',
            'num'    => 'required|numeric|min:0',
            'cic'    => 'required|numeric|min:0',
        ];

        $messages = [
            'required' => 'عفوا لابد من كتابه البيانات كامله ',
            'numeric' => 'عفوا هذا العنصر لابد ان يكون رقم',
            'min'=>'عفوا هذا العنصر لا يمكن ان يكون اقل من 2 احرف',
            'num.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'size.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'cic.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'string'=>'عفوا هذا العنصر لابد ان لا يحتوى على ارقام'
        ];
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{
            out_add_sort_c::create($request);
            return redirect('/out_store')->with(['message'=>'تم اضافه عنصر جديد الى المخزن']);
        }

    }
    public function remove_sort_c($id){
        out_add_sort_c::findOrFail($id)->delete();
        return redirect()->back()->with(['message'=>'تم حذف العنصر بنجاح ']);
    }
    public function edit_sort_c($id){
        $edit_sort_c = out_add_sort_c::findOrFail($id);
        return view('out_store.sort_c.edit_c',compact('edit_sort_c'));
    }
    public function sort_c_update(Request $request,$id){
        $request = $request->all();

        $rules = [
            'sort'    => 'required|min:2|max:100|string',
            'size'   => 'required|numeric|min:0',
            'num'    => 'required|numeric|min:0',
            'cic'    => 'required|numeric|min:0',
        ];

        $messages = [
            'required' => 'عفوا لابد من كتابه البيانات كامله ',
            'numeric' => 'عفوا هذا العنصر لابد ان يكون رقم',
            'min'=>'عفوا هذا العنصر لا يمكن ان يكون اقل من 2 احرف',
            'num.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'size.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'cic.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'string'=>'عفوا هذا العنصر لابد ان لا يحتوى على ارقام'
        ];
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{
            out_add_sort_c::findOrFail($id)->update($request);
            return redirect('/out_store')->with(['message'=>'تم تعديل العنصر بنجاح ']);
        }
    }



    public function ajax_a(Request $request)
    {
        $search = $request['search'];

        if(!empty($search)){
            $data = DB::table('out_add_sort_as')
                ->where('sort', 'like' , '%'.$search.'%')
                ->get();
            return view('out_store.search.search',compact('data','search'));
        }else{
            $data = out_add_sort_a::select('*')->orderBy('id','desc')->paginate(10);
            return view('out_store.search.replace_search',compact('data'));
        }
    }
    public function ajax_b(Request $request)
    {
        $search = $request['search'];
        if(!empty($search)){
            $data = DB::table('out_add_sort_bs')
                ->where('sort', 'like' , '%'.$search.'%')
                ->get();
            return view('out_store.search.search_b',compact('data','search'));
        }else{
            $data = out_add_sort_b::select('*')->orderBy('id','desc')->paginate(10);
            return view('out_store.search.replace_b',compact('data'));
        }
    }
    public function ajax_c(Request $request)
    {
        $search = $request['search'];

        if(!empty($search)){
            $data = DB::table('out_add_sort_cs')
                ->where('sort', 'like' , '%'.$search.'%')
                ->get();
            return view('out_store.search.search_c',compact('data','search'));
        }else{
            $data = out_add_sort_c::select('*')->orderBy('id','desc')->paginate(10);
            return view('out_store.search.sear_rep_c',compact('data'));
        }
    }


}
