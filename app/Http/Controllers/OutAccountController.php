<?php

namespace App\Http\Controllers;

use App\out_get_money;
use App\out_process;
use Illuminate\Http\Request;

use App\total_account;
use Illuminate\Support\Facades\DB;
use \App\process;
use \App\get_money;
use Validator;


class OutAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = out_process::orderBy('id','desc')->paginate(10);
        $get_money = out_get_money::select('*')->orderBy('id','desc')->paginate('10');
        $account = DB::table('out_processes')->sum('cash');
        $in_account = DB::table('out_processes')->sum('in_cash');
        $total_get_money = DB::table('out_get_moneys')->sum('money');
        $payments = $account - $total_get_money;

        return view('out_account.index',compact('total_get_money','payments','get_money','data','account','in_account'));
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
        $only_process = out_process::findOrFail($id);
        $info = DB::table('out_infos')->where('process_id',$id)->get();
        $info_used = DB::table('out_useds')->where('process_id',$id)->get();
        return view('out_account.process_info',compact(['info','info_used','only_process']));
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
            'min'=>'عفوا هذا العنصر لا يمكن ان يكون رقم سالب',

        ];
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{

            $pay = out_process::findOrFail($id);
            if($pay->in_cash != 0){

                if($request['pay'] <= $pay->in_cash )
                {
                    $pay->in_cash =   $pay->in_cash  -  $request['pay'] ;
                    $pay->cash = $request['pay'] + $pay->cash;
                    $pay->save();
                    return redirect()->back()->with(['message' => ' تم الدفع بنجاح ']);
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

            $total = DB::table('out_processes')->sum('cash');
            $total_get = DB::table('out_get_moneys')->sum('money');
            if( $request['money']+ $total_get <= $total){
                out_get_money::create($request);
                $message = 'تم سحب القيمه المحددة بنجاح';
            }
            else{
                $message = 'لا يوجد رصيد كافى لتنفيذ عمليه السحب';
            }

            return redirect('/out_account')->with(['message' => $message]);
        }
    }


    public function ajax(Request $request)
    {
        $search = $request['search'];
        if(!empty($search)){
            $data = DB::table('out_processes')
                ->where('name', 'like' , '%'.$search.'%')
                ->get();
            return view('out_account.search',compact('data','search'));
        }else{
            $data = out_process::select('*')->paginate(10);
            return view('out_account.replace_search',compact('data'));
        }
    }


}
