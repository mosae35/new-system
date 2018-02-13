<?php

namespace App\Http\Controllers;

use App\add_hour;
use App\employ;
use App\employ_balancy;
use App\employ_money;
use App\employeeAbcent;
use App\get_money;
use App\out_get_money;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;

class EmployController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $process = employ::select('*')->orderby('id','desc')->paginate(10);
        return view('employe.index',compact('process'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employe.form');
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
            'name'        => 'required|min:3|max:100|string',
            'address'     => 'required|min:3|max:150|string',
            'telephone'   => 'required|min:3|max:100|digits:11',
            'place'       => 'required',
            'mobile'      => 'required|numeric|min:0|digits:11',
            'number'      => 'required|numeric|digits:14',
        ];

        $messages = [
            'required' => 'عفوا لابد من كتابه البيانات كامله ',
            'numeric' => 'عفوا هذا العنصر لابد ان يكون رقم',
            'min'=>'عفوا هذا العنصر لا يمكن ان يكون اقل من 3 احرف',
            'string'=>'عفوا هذا العنصر لابد ان لا يحتوى على ارقام',
            'digits'=>'عفوا هذا العنصر لابد ان يكون 14 رقم',
            'mobile.digits'=>'عفوا هذا العنصر لابد ان يكون 11 رقم',
            'telephone.digits'=>'عفوا هذا العنصر لابد ان يكون 11 رقم'

        ];
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{
            employ::create($request);
            return redirect('/employ')->with(['message' => 'تم اضافه العامل بنجاح']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $request = $request['month'];
        //total month info

        $num_day = employeeAbcent::where('employee_id',$id)
            ->where('month',$request)
            ->where('year',date('Y'))
            ->count('day');

        $num_hour = DB::table('add_hours')->where('employ_id',$id)
            ->where('month',$request)
            ->whereYear('created_at', date('Y'))
            ->sum('hour');

        $money = DB::table('employ_balancies')
            ->where('employ_id',$id)
            ->where('month',$request)
            ->whereYear('created_at', date('Y'))
            ->sum('amount');

        ///  final  accounts
        $info = DB::table('employ_moneys')
            ->where('month',$request)
            ->where('employ_id',$id)
            ->where('year',date('Y'))->first();

        if(count($info) == 0 ){
            $employ_account =  ' هذا العامل لم يكتمل حسابه خلال هذا الشهر لابد من اضافه البيانات السابقه ' ;
        }else{

            $total_hours = $num_hour * $info->hour;
            $total_days = $num_day * $info->day;
            $employ_account = $total_hours + $info->account;
            $employ_account = $employ_account - $total_days;
            $employ_account = $employ_account - $money;
        }
        //data in tables for show
        $month = employeeAbcent::where('employee_id',$id)->where('month',$request)->get();
        $month_hour = add_hour::where('employ_id',$id)->where('month',$request)->get();
        $month_balance = employ_balancy::where('employ_id',$id)->where('month',$request)->get();

        $only_process = employ::findOrFail($id);
        return view('employe.employee_info', compact('only_process','month','month_hour',
                'month_balance','num_day','num_hour','money','employ_account','info'));
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = employ::findOrFail($id);
        return view('employe.edit',compact('employee'));
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
            'name'        => 'required|min:3|max:100|string',
            'address'     => 'required|min:3|max:150|string',
            'telephone'   => 'required|min:3|max:100|digits:11',
            'place'       => 'required',
            'mobile'      => 'required|numeric|min:0|digits:11',
            'number'      => 'required|numeric|digits:14',
        ];

        $messages = [
            'required' => 'عفوا لابد من كتابه البيانات كامله ',
            'numeric' => 'عفوا هذا العنصر لابد ان يكون رقم',
            'min'=>'عفوا هذا العنصر لا يمكن ان يكون اقل من 3 احرف',
            'string'=>'عفوا هذا العنصر لابد ان لا يحتوى على ارقام',
            'digits'=>'عفوا هذا العنصر لابد ان يكون 14 رقم',
            'mobile.digits'=>'عفوا هذا العنصر لابد ان يكون 11 رقم',
            'telephone.digits'=>'عفوا هذا العنصر لابد ان يكون 11 رقم'

        ];
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{
            employ::findOrFail($id)->update($request);
            return redirect('employ')->with(['message' => 'تم تعديل بيانات العامل بنجاح']);
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
        employ::findOrFail($id)->delete();
        return redirect('employ')->with(['message' => 'تم حذف العامل بنجاح']);
    }





    public function employee_abcent(Request $request,$id){
        $request = $request->all();
        $request['employee_id'] = $id ;

        $rules = [
            'day'     => 'required|numeric|min:1|max:31',
            'month'   => 'required',
            'year'    => 'required|numeric|min:1|max:2028',
        ];

        $messages = [
            'required' => 'عفوا لابد من كتابه البيانات كامله ',
            'numeric' => 'عفوا هذا العنصر لابد ان يكون رقم',
            'min'=>'عفوا لا يوجد يوم بهذا الرقم',
            'max'=>'عفوا لا يوجد يوم بهذا الرقم',
            'year.max'=>'عفوا لا يوجد سنة بهذا الرقم',

        ];
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{

            $check_out = out_get_money::where('employ_id',$id)
                ->whereYear('created_at',date('Y'))
                ->whereMonth('created_at',date('m'))->count();

            $check_in = get_money::where('employ_id',$id)
                ->whereYear('created_at',date('Y'))
                ->whereMonth('created_at',date('m'))->count();

            if($check_out == 0 and $check_in == 0)
            {
                employeeAbcent::create($request);
                return redirect()->back()->with(['message' => 'تم تسجيل يوم الغياب  بنجاح']);
            }else{
                return redirect()->back()->with(['message' => 'عفوا لقد تم حساب راتب هذا العامل خلال هذا الشهر']);
            }
        }
    }


    public function absent_remove($id){
        employeeAbcent::findOrFail($id)->delete();
        return redirect()->back()->with(['message' => 'تم حذف عمليه الغياب بنجاح']);
    }

    public function hour_remove($id){
        add_hour::findOrFail($id)->delete();
        return redirect()->back()->with(['message' => 'تم حذف عدد الساعات بنجاح']);
    }

    public function balance_remove($id){
        employ_balancy::findOrFail($id)->delete();
        return redirect()->back()->with(['message' => 'تم حذف قيمه السلف بنجاح']);
    }



    public function add_hour(Request $request,$id){
        $request = $request->all();
        $request['employ_id'] = $id ;

        $rules = [
            'hour'     => 'required|numeric|integer|min:0',
        ];

        $messages = [
            'required' => 'عفوا لابد من كتابه البيانات كامله ',
            'numeric' => 'عفوا هذا العنصر لابد ان يكون رقم',
            'min'=>'عفوا لا يمكن تسجيل رقم سالب',
        ];
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{

            $check_out = out_get_money::where('employ_id',$id)
                ->whereYear('created_at',date('Y'))
                ->whereMonth('created_at',date('m'))->count();

            $check_in = get_money::where('employ_id',$id)
                ->whereYear('created_at',date('Y'))
                ->whereMonth('created_at',date('m'))->count();

            if($check_out == 0 and $check_in == 0)
            {
                add_hour::create($request);
                return redirect()->back()->with(['message' => 'تم تسجيل عدد الساعات الاضافيه بنجاح']);
            }else{
                return redirect()->back()->with(['message' => 'عفوا لقد تم حساب راتب هذا العامل خلال هذا الشهر']);
            }
        }
    }

    public  function employ_get_mony(Request $request  ,$id){

        $request = $request->all();
        $request['employ_id'] = $id;

        $rules = [
            'amount'   => 'required|numeric|min:0',
        ];

        $messages = [
            'required' => 'عفوا لابد من كتابه البيانات كامله ',
            'numeric' => 'عفوا هذا العنصر لابد ان يكون رقم',
            'min'=>'عفوا لا يمكن تسجيل رقم سالب',
        ];
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{



            $check_out = out_get_money::where('employ_id',$id)
                ->whereYear('created_at',date('Y'))
                ->whereMonth('created_at',date('m'))->count();

            $check_in = get_money::where('employ_id',$id)
                ->whereYear('created_at',date('Y'))
                ->whereMonth('created_at',date('m'))->count();

            if($check_out == 0 and $check_in == 0)
            {
                employ_balancy::create($request);
                return redirect()->back()->with(['message' => 'تم تسجيل قيمه السلف بنجاح']);
            }else{
                return redirect()->back()
                    ->with(['message' => date('M').'عفوا لقد تم حساب راتب هذا العامل خلال هذا الشهر ']);
            }
        }
    }

    public function employ_account(Request $request,$id){
        $request = $request->all();
        $request['employ_id'] = $id;

        $rules = [
            'hour'     => 'required|numeric|min:0',
            'day'     => 'required|numeric||min:0',
            'account'     => 'required|numeric|min:0',
            'year'     => 'required|numeric|min:0|max:2029',
        ];

        $messages = [
            'required' => 'عفوا لابد من كتابه البيانات كامله ',
            'numeric' => 'عفوا هذا العنصر لابد ان يكون رقم',
            'min'=>'عفوا لا يمكن تسجيل رقم سالب',
            'year.max'=>'عفوا لا يوجد سنه بهذا الرقم',
        ];
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{

            $additional_val = DB::table('employ_moneys')
                ->where('employ_id',$id)
                ->where('month',$request['month'])
                ->where('year',date('Y'))->get();

            if(count($additional_val)  == 0){

                $message = 'تم حساب الراتب بنجاح';
                employ_money::create($request);

                $num_day = employeeAbcent::where('employee_id',$id)
                    ->where('month',$request['month'])
                    ->where('year',date('Y'))
                    ->count('day');

                $num_hour = DB::table('add_hours')
                    ->where('employ_id',$id)
                    ->where('month',$request['month'])
                    ->whereYear('created_at', date('Y'))
                    ->sum('hour');

                $money = DB::table('employ_balancies')
                    ->where('employ_id',$id)
                    ->where('month',$request['month'])
                    ->whereYear('created_at', date('Y'))
                    ->sum('amount');

                ///  final  accounts
                $info = DB::table('employ_moneys')
                    ->where('month',$request['month'])
                    ->where('employ_id',$id)
                    ->where('year',date('Y'))->first();

                $total_hours = $num_hour * $info->hour;
                $total_days = $num_day * $info->day;
                $employ_account = $total_hours + $info->account;
                $employ_account = $employ_account - $total_days;
                $employ_account = $employ_account - $money;

                $employee = employ::findOrFail($id);

                if($employee->place  == 'داخلى'){
                    DB::table('get_moneys')->insert([
                        [
                            'money' => $employ_account ,
                            'object' => 'راتب عامل',
                            'employ_id' => $id,
                            'user_id' =>\Auth::user()->id,
                            'created_at'=> now()
                        ]
                    ]);
                }else{
                    DB::table('out_get_moneys')->insert([
                        [
                            'money' => $employ_account ,
                            'object' => 'راتب عامل',
                            'employ_id' => $id,
                            'user_id' =>\Auth::user()->id,
                            'created_at'=> now()]
                    ]);
                }
                return redirect()->back()->with(['message' => $message]);
            }else{
                $message = 'هذه القيم تم اضافتها من قبل ';
                return redirect()->back()->with(['message' => $message]);
            }


        }
    }


    public function ajax(Request $request)
    {
        $search = $request['search'];

        if(!empty($search)){
            $data = DB::table('employs')
                ->where('name', 'like' , '%'.$search.'%')
                ->get();
            return view('employe.search',compact('data','search'));
        }else{
            $data = employ::select('*')->paginate(10);
            return view('employe.replace_search',compact('data'));
        }
    }


}
