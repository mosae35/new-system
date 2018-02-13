<?php

namespace App\Http\Controllers;


use App\add_sort_a;
use App\add_sort_b;
use App\add_sort_c;
use App\machien;
use App\out_add_sort_a;
use App\out_add_sort_b;
use App\out_add_sort_c;
use App\OutWorkMachien;
use App\requirement;
use Illuminate\Http\Request;
use \App\out_process;
use \App\out_info;
use \App\out_used;
use \App\OutMachien;
use Illuminate\Support\Facades\DB;
use Validator;


class OutProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data = out_process::select('*')->orderby('id','desc')->paginate(10);
        return view('out_work.process.all_process',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('out_work.process.form');
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
        $request['user_id'] = \Auth::user()->id;

        $rules = [
            'doctor'      => 'required|min:3|max:100|string',
            'name'        => 'required|min:3|max:100|string',
            'type'        => 'required|min:3|max:100|string',
            'client'      => 'required|min:3|max:100|string',
            'place'       => 'required|min:3|max:100|string',
            'cash'        => 'required|numeric|min:0',
            'in_cash'    => 'required|numeric|min:0',
            'created_at'  => 'required|date',
        ];

        $messages = [
            'required' => 'عفوا لابد من كتابه البيانات كامله ',
            'created_at.date' => 'هذا التاريخ غير صحيح',
            'numeric' => 'عفوا هذا العنصر لابد ان يكون رقم',
            'min'=>'عفوا هذا العنصر لا يمكن ان يكون اقل من 3 احرف',
            'cash.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'in_cash.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'string'=>'عفوا هذا العنصر لابد ان لا يحتوى على ارقام'

        ];
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{

            out_process::create($request);

            $name = $request['name'];
            $user = DB::table('out_processes')->where('name', $name)->max('id');

            return redirect('out_process/'.$user)->with(['message'=>'تم تسجيل الحاله بنجاح']);
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
        $out_machien = OutWorkMachien::select('*')->where('out_process_id',$id)->get();
        $only_process = out_process::findOrFail($id);
        $data = out_info::all();
        $info = DB::table('out_infos')->where('process_id',$id)->paginate(10);
        $info_used = DB::table('out_useds')->where('process_id',$id)->paginate(10);
        return view('out_work.process.only_process',compact(['info','info_used','only_process','out_machien']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = out_process::findOrFail($id);
        return view('out_work.process.edit',compact('data'));
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

        $rules = [
            'doctor'      => 'required|min:3|max:100|string',
            'name'        => 'required|min:3|max:100|string',
            'type'        => 'required|min:3|max:100|string',
            'client'      => 'required|min:3|max:100|string',
            'place'       => 'required|min:3|max:100|string',
            'cash'        => 'required|numeric|integer|min:0',
            'in_cash'    => 'required|numeric|integer|min:0',
            'created_at'  => 'required|date',
        ];

        $messages = [
            'required' => 'عفوا لابد من كتابه البيانات كامله ',
            'created_at.date' => 'هذا التاريخ غير صحيح',
            'numeric' => 'عفوا هذا العنصر لابد ان يكون رقم',
            'min'=>'عفوا هذا العنصر لا يمكن ان يكون اقل من 3 احرف',
            'cash.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'in_cash.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'string'=>'عفوا هذا العنصر لابد ان لا يحتوى على ارقام'

        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{
            $request = $request->all();
            out_process::findOrFail($id)->update($request);
            return redirect('/out_process')->with(['message' => 'تم تعديل البيانات بنجاح']);
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
        out_process::findOrFail($id)->delete();
        return redirect('/out_process')->with(['message'=>'تم حذف الحاله بنجاح']);
    }


    public function save_details(Request $request) {
        $request = $request->all();
        if($request['process'] == 2){
            $request['size'] = 'No Size';
        }
        $request['process_id']= $request['id'];


        if($request['process'] == 1) {
            $request['cic'] = '0.0';
            out_info::create($request);
        }

        if($request['process'] == 2) {
            $request['cic'] = '0.0';
                out_info::create($request);
        }

        if($request['process'] == 3) {
                out_info::create($request);
        }
        $info = DB::table('out_infos')->where('process_id',$request['id'])->get();
        return view('out_work.out_with.output',compact('info'));
    }

    public function save_used(Request $request,$id){
        $request = $request->all();
        $request['process_id'] = $id;

        $rules = [
            'size'    => 'required|numeric|integer|min:0',
            'num'     => 'required|numeric|integer|min:0',
            'cic'     => 'numeric|integer|min:0',
        ];

        $messages = [
            'required' => 'عفوا لابد من كتابه البيانات كامله ',
            'numeric' => 'عفوا هذا العنصر لابد ان يكون رقم',
            'num.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'size.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'cic.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',

        ];
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);

        }else{

            if($request['process'] == 1) {
                $request['cic'] = '0.0';
                $check = out_add_sort_a::where('sort',$request['type'])->where('size',$request['size'])->first();
                if(count($check) != 0) {
                    if ($check->num >= $request['num']) {
                        $check->num = $check->num - $request['num'];
                        $check->save();
                        out_used::create($request);
                        return redirect('/out_process/' . $id)->with(['message' => 'تم تسجيل المستخدم بنجاح']);
                    } else {
                        return redirect('/out_process/' . $id)->with(['message' => 'العدد المستخدم غير مسجل فى المخزن ']);
                    }
                }else{
                    return redirect('/out_process/' . $id)->with(['message' => 'هذا النوع غير مسجل فى المخزن ']);
                }
            }

            if($request['process'] == 2){
                $request['cic'] = '0.0';
                $check = out_add_sort_b::where('sort',$request['type'])->where('size',$request['size'])->first();
                if(count($check) != 0) {
                    if ($check->num >= $request['num']) {
                        $check->num = $check->num - $request['num'];
                        $check->save();
                        out_used::create($request);
                        return redirect('/out_process/' . $id)->with(['message' => 'تم تسجيل المستخدم بنجاح']);
                    } else {
                        return redirect('/out_process/' . $id)->with(['message' => 'العدد المستخدم غير مسجل فى المخزن ']);
                    }
                }else{
                    return redirect('/out_process/' . $id)->with(['message' => 'هذا النوع غير مسجل فى المخزن ']);
                }
            }

            if($request['process'] == 3) {
                $check = out_add_sort_c::where('sort', $request['type'])->where('size', $request['size'])->where('cic',$request['cic'])->first();
                if (count($check) != 0) {
                    if ($check->num >= $request['num']) {
                        $check->num = $check->num - $request['num'];
                        $check->save();
                        out_used::create($request);
                        return redirect('/out_process/' . $id)->with(['message' => 'تم تسجيل المستخدم بنجاح']);
                    } else {
                        return redirect('/out_process/' . $id)->with(['message' => 'العدد المستخدم غير مسجل فى المخزن ']);
                    }
                }else{
                    return redirect('/out_process/' . $id)->with(['message' => 'هذا النوع غير مسجل فى المخزن ']);
                }
            }
        }
    }



    public function edit_out($id){
        $edit_used = out_info::findOrFail($id);
        return view('out_work.out_with.edit_out',compact('edit_used'));
    }

    public function update_out(Request $request,$id){
        $request = $request->all();

        $rules = [
            'type'      => 'required|min:3|max:100|string',
            'size'        => 'required|numeric|integer|min:0',
            'num'    => 'required|numeric|integer|min:0',
        ];

        $messages = [
            'required' => 'عفوا لابد من كتابه البيانات كامله ',
            'numeric' => 'عفوا هذا العنصر لابد ان يكون رقم',
            'min'=>'عفوا هذا العنصر لا يمكن ان يكون اقل من 3 احرف',
            'num.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'siaze.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'string'=>'عفوا هذا العنصر لابد ان لا يحتوى على ارقام'

        ];
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{

            $process = out_info::findOrFail($id);
            if($process->process == 2){
                $request['size'] = 'No Size';
            }
            out_info::findOrFail($id)->update($request);
            return redirect('out_process/'.$process->process_id)->with(['message'=>'تم التعديل على المستخدم بنجاح']);
        }
    }

    public function edit_used($id){
        $used = out_used::findOrFail($id);
        return view('out_work.used.edit_used',compact('used'));
    }

    public function change_used(Request $request ,$id){
        $request = $request->all();
        $process = out_used::findOrFail($id);
        out_used::findOrFail($id)->update($request);
        return redirect('out_process/'.$process->process_id)->with(['message'=>'تم التعديل على المستخدم بنجاح']);
    }

    public function delete_used($id){
        out_info::findOrFail($id)->delete();
        return redirect()->back()->with(['message'=>'تم حذف الخارج معالحاله بنجاح']);
    }

    public function delete_another_used($id){
        out_used::findOrFail($id)->delete();
        return redirect()->back()->with(['message'=>'تم حذف المستخدم مع الحاله بنجاح']);
    }

    public function ajax(Request $request)
    {
        $search = $request['search'];
        // $data = machien::all();

        if(!empty($search)){
            $data = DB::table('out_processes')
                ->where('name', 'like' , '%'.$search.'%')
                ->get();
            return view('out_work.process.search',compact('data','search'));
        }else{
            $data = out_process::select('*')->paginate(10);
            return view('out_work.process.replace_search',compact('data'));
        }
    }


    public function ajax_k1()
    {
        $data = out_add_sort_a::all();
        $datas= array_pluck($data,'sort','sort');
        return view('out_work.out_with.kind_1',compact('datas'));
    }
    public function ajax_k2()
    {
        $data = out_add_sort_b::all();
        $datas= array_pluck($data,'sort','sort');
        return view('out_work.out_with.kind_2',compact('datas'));
    }
    public function ajax_k3()
    {
        $data = out_add_sort_c::all();
        $datas= array_pluck($data,'sort','sort');
        return view('out_work.out_with.kind_3',compact('datas'));
    }


    public function out_machien(Request $request)
    {
        $data = $request['machien_name'];
        if ($data == null) {
            $this->validate($request, [
                'machien_name' => 'required',
                'num'=>'required'
            ]);
        } else {
            $this->validate($request, [
                'machien_name' => 'required|min:2|max:150'
            ]);
            OutWorkMachien::create([
                'machien_name' => $data,
                'num'=>$request->num,
                'out_process_id'=>$request['id']
            ]);

            $machien = OutWorkMachien::select('*')->where('out_process_id',$request['id'])->get();
            return view('out_work.out_with.out_machien', compact('machien'));
        }
    }

    public function out_machien_edit($id,$out_process_id){
        $data = OutWorkMachien::find($id);
        return view('out_work.out_with.edite_out_machien',compact('data','out_process_id'));
    }

    public function out_machien_update($id,Request $request,$out_process_id){

        $rules = [
            'machien_name'    => 'required|min:3|max:100|string',
            'num'             => 'required|numeric|integer|min:0',
        ];

        $messages = [
            'required' => 'عفوا لابد من كتابه البيانات كامله ',
            'numeric' => 'عفوا هذا العنصر لابد ان يكون رقم',
            'min'=>'عفوا هذا العنصر لا يمكن ان يكون اقل من 3 احرف',
            'num.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'string'=>'عفوا هذا العنصر لابد ان لا يحتوى على ارقام'

        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);

        }else{

            OutWorkMachien::find($id)->update($request->all());
            return redirect('out_process/'.$out_process_id)->with('message','تم تعديل الالة');
        }

    }

    public function out_machien_delete($id){
        OutWorkMachien::find($id)->delete();
        return redirect()->back()->with('message','تم حذف الالة');
    }


    public function all_machiens(){
        $machiens = requirement::all();
        $data = array_pluck($machiens,'name','name');
        return view('out_work.out_with.all_machiens',compact('data'));
    }
    public function all_required(){
        $machiens = machien::all();
        $data = array_pluck($machiens,'name','name');
        return view('out_work.out_with.all_required',compact('data'));
    }

    public function ajax_get_sort_out_used_1(Request $request){
        $id = request('id');
        $machiens = out_info::where('process',1)->where('process_id',$id)->get();
        $data = array_pluck($machiens,'type','type');
        return view('main.used.ajax_get_used',compact('data'));
    }
    public function ajax_get_sort_out_used_2(Request $request){
        $id = request('id');
        $machiens = out_info::where('process',2)->where('process_id',$id)->get();
        $data = array_pluck($machiens,'type','type');
        return view('main.used.ajax_get_used',compact('data'));
    }
    public function ajax_get_sort_out_used_3(Request $request){
        $id = request('id');
        $machiens = out_info::where('process',3)->where('process_id',$id)->get();
        $data = array_pluck($machiens,'type','type');
        return view('main.used.ajax_get_used',compact('data'));
    }


}