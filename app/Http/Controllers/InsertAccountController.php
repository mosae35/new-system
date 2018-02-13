<?php

namespace App\Http\Controllers;

use App\total_account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\process;
use \App\get_money;
use Validator;

class InsertAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = process::orderby('id','desc')->paginate(10);
        $get_money = get_money::select('*')->orderby('id','desc')->paginate('10');
        $account = DB::table('processes')->sum('cash');
        $in_account = DB::table('processes')->sum('not_cash');
        $total_get_money = DB::table('get_moneys')->sum('money');

        $payments = $account - $total_get_money;

        return view('insert_account.index',compact('total_get_money','payments','get_money','data','account','in_account'));
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
        $only_process = process::findOrFail($id);
        $info = DB::table('info')->where('process_id',$id)->get();
        $info_used = DB::table('useds')->where('process_id',$id)->get();
        return view('insert_account.process_info',compact(['info','info_used','only_process']));
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
    public function pay(Request $request,$id){
        $request = $request->all();

        $rules = [
            'pay'    => 'required|numeric|integer|min:0',
        ];

        $messages = [
            'required' => 'عفوا لابد من كتابه البيانات كامله ',
            'numeric' => 'عفوا هذا العنصر لابد ان يكون رقم',
            'integer' => 'عفوا هذا العنصر لابد ان يكون رقم',
            'min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
        ];
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);

        }else{
            $pay = process::findOrFail($id);
            if($pay->not_cash != 0){
                if($request['pay'] <= $pay->not_cash){
                    $pay->not_cash =   $pay->not_cash  -  $request['pay'];
                    $pay->cash = $request['pay'] + $pay->cash;
                    $pay->save();
                    return redirect()->back()->with(['message' => ' تم الدفع بنجاح ']);;
                }else{
                    return redirect()->back()->with(['message' => ' عفوا هذا المبلغ اكبر من المتبقى ']);
                }
            }
            else{
                return redirect()->back()->with(['message' => 'لا يوجد مبلغ متبقى لهذه الحاله  !!']);
            }
        }

    }

    public function pop_money(Request $request)
    {
        $request = $request->all();
        $request['user_id'] = \Auth::user()->id;

        $rules = [
            'money'    => 'required|numeric|integer|min:0',
            'object'     => 'required|string|min:3|max:500',
        ];

        $messages = [
            'required' => 'عفوا لابد من كتابه البيانات كامله ',
            'numeric' => 'عفوا هذا العنصر لابد ان يكون رقم',
            'money.min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',
            'min'=>'عفوا هذا العنصر لا يمكن ان يكون اقل من 3 احرف',
            'max'=>'عفوا هذا الغرض كبير للغايه',

        ];
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);

        }else{

            $total = DB::table('processes')->sum('cash');
            $total_get = DB::table('get_moneys')->sum('money');
            if( $request['money']+ $total_get <= $total){
                get_money::create($request);
                $message = 'تم سحب القيمه المحددة بنجاح';
            }
            else{
                $message = 'لا يوجد رصيد كافى لتنفيذ عمليه السحب';
            }

            return redirect('/insert_account')->with(['message' => $message]);
        }
    }


    public function ajax(Request $request)
    {
        $search = $request['search'];

        if(!empty($search)){
            $data = DB::table('processes')
                ->where('name', 'like' , '%'.$search.'%')
                ->get();
            return view('insert_account.search',compact('data','search'));
        }else{
            $data = process::select('*')->paginate(10);
            return view('insert_account.replace_search',compact('data'));
        }
    }

}
