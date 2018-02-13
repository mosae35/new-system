<?php

namespace App\Http\Controllers;

use App\add_sort_a;
use App\add_sort_b;
use App\add_sort_c;
use App\OutMachien;
use App\requirement;
use App\machien;
use Illuminate\Http\Request;
use App\process;
use App\info;
use App\used;
use App\total_account;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function Sodium\compare;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $process = process::select('*')->orderby('id','desc')->paginate(10);
        return view('main.process.all_process',compact('process'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('main.process.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'doctor'      => 'required|min:3|max:100|string',
            'name'        => 'required|min:3|max:100|string',
            'type'        => 'required|min:3|max:100|string',
            'client'      => 'required|min:3|max:100|string',
            'place'       => 'required|min:3|max:100|string',
            'cash'        => 'required|numeric|integer|min:0',
            'not_cash'    => 'required|numeric|integer|min:0',
            'created_at'  => 'required|date',
        ];

        $messages = [
            'required' => 'عفوا لابد من كتابه البيانات كامله ',
            'created_at.date' => 'هذا التاريخ غير صحيح',
            'numeric' => 'عفوا هذا العنصر لابد ان يكون رقم',
            'min'=>'عفوا هذا العنصر لا يمكن ان يكون اقل من 3 احرف',
            'cash.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'not_cash.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'string'=>'عفوا هذا العنصر لابد ان لا يحتوى على ارقام'

        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{
            $request['created_at'] = $request['created_at'];
            process::create($request->all());
            $name = $request['name'];
            $user = DB::table('processes')->where('name', $name)->max('id');
            return redirect('/process/'.$user)->with(['message' => 'تم تسجيل الحاله بنجاح']);
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
        $out_machien = OutMachien::select('*')->where('process_id',$id)->get();
        $only_process = process::findOrFail($id);
        $data = info::all();
        $info = DB::table('info')->where('process_id',$id)->paginate(10);
        $info_used = DB::table('useds')->where('process_id',$id)->paginate(10);
        return view('main.process.only_process',compact(['info','info_used','only_process','out_machien']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = process::findOrFail($id);
        return view('main.process.edit',compact('data'));
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
            'not_cash'    => 'required|numeric|integer|min:0',
            'created_at'  => 'required|date',
        ];

        $messages = [
            'required' => 'عفوا لابد من كتابه البيانات كامله ',
            'date' => 'هذا التاريخ غير صحيح',
            'numeric' => 'عفوا هذا العنصر لابد ان يكون رقم',
            'min'=>'عفوا هذا العنصر لا يمكن ان يكون اقل من 3 احرف',
            'not_cash.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'cash.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'string'=>'عفوا هذا العنصر لابد ان لا يحتوى على ارقام'

        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{
            $request =$request->all();
            process::findOrFail($id)->update($request);
            return redirect('/process/'.$id)->with(['message' => 'تم تعديل البيانات بنجاح']);
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
        process::findOrFail($id)->delete();
        return redirect()->back()->with(['message'=>'تم حذف الحاله بنجاح']);
    }





    public function save_details(Request $request) {
        $request = $request->all();
        if($request['process'] == 2){
            $request['size'] = 'No Size';
        }
        $request['process_id']= $request['id'];
        if($request['process'] == 1) {
            $request['cic'] = '0.0';
                info::create($request);
        }

        if($request['process'] == 2) {
            $request['cic'] = '0.0';
                info::create($request);
        }

        if($request['process'] == 3) {
            info::create($request);
        }
        $info = DB::table('info')->where('process_id',$request['id'])->paginate(10);
        return view('main.out_with.output',compact('info'));


    }

    public function save_used(Request $request,$id){
        $request = $request->all();
        $request['process_id'] = $id;

        $rules = [
            'size' => 'required|numeric|integer|min:0',
            'num'  => 'required|numeric|integer|min:0',
            'cic'  => 'numeric|integer|min:0',
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
                $check = add_sort_a::where('sort',$request['type'])->where('size',$request['size'])->first();
                if(count($check) != 0){
                    if ($check->num >= $request['num']) {
                        $check->num = $check->num - $request['num'];
                        $check->save();
                        used::create($request);
                        return redirect('/process/' . $id)->with(['message' => 'تم تسجيل المستخدم بنجاح']);
                    } else {
                        return redirect('/process/' . $id)->with(['message' => 'العدد المستخدم غير مسجل فى المخزن ']);
                    }
                }else{
                    return redirect('/process/' . $id)->with(['message' => 'هذا النوع غير مسجل فى المخزن ']);
                }
            }

            if($request['process'] == 2){
                $request['cic'] = '0.0';
                $check = add_sort_b::where('sort',$request['type'])->where('size',$request['size'])->first();
                if(count($check) != 0) {
                    if ($check->num >= $request['num']) {
                        $check->num = $check->num - $request['num'];
                        $check->save();
                        used::create($request);
                        return redirect('/process/' . $id)->with(['message' => 'تم تسجيل المستخدم بنجاح']);
                    } else {
                        return redirect('/process/' . $id)->with(['message' => 'العدد المستخدم غير مسجل فى المخزن ']);
                    }
                }else{
                    return redirect('/process/' . $id)->with(['message' => 'هذا النوع غير مسجل فى المخزن ']);
                }
            }

            if($request['process'] == 3){
                $check = add_sort_c::where('sort',$request['type'])->where('size',$request['size'])->where('cic',$request['cic'])->first();
                if(count($check) != 0) {
                    if ($check->num >= $request['num']) {
                        $check->num = $check->num - $request['num'];
                        $check->save();
                        used::create($request);
                        return redirect('/process/' . $id)->with(['message' => 'تم تسجيل المستخدم بنجاح']);
                    } else {
                        return redirect('/process/' . $id)->with(['message' => 'العدد المستخدم غير مسجل فى المخزن ']);
                    }
                }else{
                    return redirect('/process/' . $id)->with(['message' => 'هذا النوع غير مسجل فى المخزن ']);
                }
            }

        }


    }

    public function edit_out($id){
        $edit_used = info::findOrFail($id);
        return view('main.out_with.edit_used',compact('edit_used'));
    }

    public function update_used(Request $request,$id){


        $request = $request->all();
        $process = info::findOrFail($id);

        $rules = [
            'type'      => 'required|min:3|max:100|string',
            'size'      => 'required|numeric|min:0',
            'num'       => 'required|numeric|min:0',
        ];

        $messages = [
            'required' => 'عفوا لابد من كتابه البيانات كامله ',
            'numeric' => 'عفوا هذا العنصر لابد ان يكون رقم',
            'min'=>'عفوا هذا العنصر لا يمكن ان يكون اقل من 3 احرف',
            'size.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'num.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'string'=>'عفوا هذا العنصر لابد ان لا يحتوى على ارقام'

        ];
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{
           if($process->process == 2){
                $request['size'] = 'No Size';
            }
            info::findOrFail($id)->update($request);
            return redirect('process/'.$process->process_id)->with(['message'=>'تم التعديل على الخارج بنجاح ']);
        }
    }

    public function edit_used_2($id){
        $used = used::findOrFail($id);
        return view('main.used.edit_used_2',compact('used'));
    }

    public function change_used(Request $request ,$id){
        $request = $request->all();
        $process = used::findOrFail($id);
        used::findOrFail($id)->update($request);
        return redirect('process/'.$process->process_id)->with(['message'=>'تم التعديل على المستخدم بنجاح']);
    }

    public function delete_used($id){
        info::findOrFail($id)->delete();
        return redirect()->back()->with(['message'=>'تم حذف الخارج معالحاله بنجاح']);
    }

    public function delete_another_used($id){
        used::findOrFail($id)->delete();
        return redirect()->back()->with(['message'=>'تم حذف المستخدم مع الحاله بنجاح']);
    }

    public function ajax(Request $request)
    {
        $search = $request['search'];

        if(!empty($search)){
            $data = DB::table('processes')
                ->where('name', 'like' , '%'.$search.'%')
                ->get();
            return view('main.process.search',compact('data','search'));
        }else{
            $data = process::select('*')->paginate(10);
            return view('main.process.replace_search',compact('data'));
        }
    }


    public function ajax_k1()
    {
        $data = add_sort_a::all();
        $datas= array_pluck($data,'sort','sort');
       return view('main.out_with.kind_1',compact('datas'));
    }
    public function ajax_k2()
    {
        $data = add_sort_b::all();
        $datas= array_pluck($data,'sort','sort');
        return view('main.out_with.kind_2',compact('datas'));
    }
    public function ajax_k3()
    {
        $data = add_sort_c::all();
        $datas= array_pluck($data,'sort','sort');
        return view('main.out_with.kind_3',compact('datas','sort'));
    }


    public function machien(Request $request){

        $data = $request['machien_name'];
        if($data == null){
            $this->validate($request,[
               'machien_name'=>'required',
                'num'=>'required'
            ]);
        }else{
            $this->validate($request,[
                'machien_name'=>'required|min:2|max:150'
            ]);
            OutMachien::create([
                'machien_name'=>$data,
                'num'=>$request->num,
                'process_id'=>$request['id']
            ]);

            $machien = OutMachien::select('*')->where('process_id',$request['id'])->get();

            return view('main.out_with.out_machien',compact('machien'));
        }

    }
    public function machien_edit($id,$process_id){
        $data = OutMachien::find($id);
        return view('main.out_with.edite_out_machien',compact('data','process_id'));
    }
    public function machien_update($id,Request $request ,$process_id){
        $rules = [
            'machien_name'      => 'required|min:3|max:150|string',
            'num'               => 'required|numeric|integer|min:0',
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
            OutMachien::find($id)->update($request->all());
            return redirect('process/'.$process_id)->with('message',' تم تعديل الالة');
        }
    }


    public function machien_delete($id){
        OutMachien::find($id)->delete();
        return redirect()->back()->with('message','تم حذف الالة');
    }
    public function all_name_machiens(){
        $machiens = requirement::all();
        $data = array_pluck($machiens,'name','name');
        return view('out_work.out_with.all_machiens',compact('data'));
    }
    public function all_name_required(){
        $machiens = machien::all();
        $data = array_pluck($machiens,'name','name');
        return view('main.out_with.all_required',compact('data'));
    }

    public function ajax_get_sort_used_1(Request $request){
        $id = request('id');
        $machiens = info::where('process',1)->where('process_id',$id)->get();
        $data = array_pluck($machiens,'type','type');
        return view('main.used.ajax_get_used',compact('data'));
    }
    public function ajax_get_sort_used_2(Request $request){
        $id = request('id');
        $machiens = info::where('process',2)->where('process_id',$id)->get();
        $data = array_pluck($machiens,'type','type');
        return view('main.used.ajax_get_used',compact('data'));
    }
    public function ajax_get_sort_used_3(Request $request){
        $id = request('id');
        $machiens = info::where('process',3)->where('process_id',$id)->get();
        $data = array_pluck($machiens,'type','type');
        return view('main.used.ajax_get_used',compact('data'));
    }

}
