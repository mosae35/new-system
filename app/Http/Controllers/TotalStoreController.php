<?php

namespace App\Http\Controllers;

use App\Total_sort_a;
use App\Total_sort_b;
use App\Total_sort_c;
use Illuminate\Http\Request;
use Validator;

class TotalStoreController extends Controller
{
    public function add_sort_a(Request $request){


        $rules = [
            'sort'    => 'required|min:2|max:100|string',
            'num'    => 'required|numeric|min:0',
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
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{
            $data = $request->sort;
            $old_sort = Total_sort_a::where('sort',$data)->count();

            if($old_sort == 1){
                $upd_sort = Total_sort_a::where('sort',$data)->first();
                $upd_sort->num = $upd_sort->num + $request->num;
                $upd_sort->save();
            }else{
                Total_sort_a::create([
                    'sort'=>$request->sort,
                    'num'=>$request->num
                ]);
            }
            return redirect('store')->with('message','تم تسجيل البيانات ');
        }
    }
    public function add_sort_b(Request $request){

        $rules = [
            'sort'    => 'required|min:2|max:100|string',
            'num'    => 'required|numeric|min:0',
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
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{

            $data = $request->sort;
            $old_sort = Total_sort_b::where('sort',$data)->count();

            if($old_sort == 1){
                $upd_sort = Total_sort_b::where('sort',$data)->first();
                $upd_sort->num = $upd_sort->num + $request->num;
                $upd_sort->save();
            }else{
                Total_sort_b::create([
                    'sort'=>$request->sort,
                    'num'=>$request->num
                ]);
            }
            return redirect('store')->with('message','تم تسجيل البيانات ');
        }
    }
    public function add_sort_c(Request $request){


        $rules = [
            'sort'    => 'required|min:2|max:100|string',
            'num'    => 'required|numeric|min:0',
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
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{

            $data = $request->sort;
            $old_sort = Total_sort_c::where('sort',$data)->count();

            if($old_sort == 1){
                $upd_sort = Total_sort_c::where('sort',$data)->first();
                $upd_sort->num = $upd_sort->num + $request->num;
                $upd_sort->save();
            }else{
                Total_sort_c::create([
                    'sort'=>$request->sort,
                    'num'=>$request->num
                ]);
            }
            return redirect('store')->with('message','تم تسجيل البيانات ');
        }
    }

    public function edit_sort_a($id){
        $sort_a = Total_sort_a::find($id);
        return view('store.edit_total_a',compact('sort_a'));
    }
    public function edit_sort_b($id){
        $sort_b = Total_sort_b::find($id);
        return view('store.sort_b.edit_total_b',compact('sort_b'));
    }
    public function edit_sort_c($id){
        $sort_c = Total_sort_c::find($id);
        return view('store.sort_c.edit_total_c',compact('sort_c'));
    }


    public function update_sort_a($id,Request $request){
        $request = $request->all();

        $rules = [
            'sort'    => 'required|min:2|max:100|string',
            'num'    => 'required|numeric|min:0',
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

            Total_sort_a::find($id)->update($request);
            return redirect('store')->with('message','تم تعديل البيانات ');
        }
    }
    public function update_sort_b(Request $request,$id){
        $request = $request->all();

        $rules = [
            'sort'    => 'required|min:2|max:100|string',
            'num'    => 'required|numeric|min:0',
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
            Total_sort_b::find($id)->update($request);
            return redirect('store')->with('message','تم تعديل البيانات ');
        }
    }
    public function update_sort_c(Request $request,$id){
        $request = $request->all();

        $rules = [
            'sort'    => 'required|min:2|max:100|string',
            'num'    => 'required|numeric|min:0',
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

            Total_sort_c::find($id)->update($request);
            return redirect('store')->with('message','تم تعديل البيانات ');
        }
    }

}
