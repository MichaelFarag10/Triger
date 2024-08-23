<?php

namespace App\Http\Controllers;

use App\Http\Requests\CallRequest;
use App\Http\Requests\CallUpdateRequest;
use App\Models\Governorate;
use App\Models\InqueryType;
use App\Models\Inquiry;
use App\Models\Representative;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class CallsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user()->name;
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/view.log'),
            'days' => 14,
        ])->info($user . ' visit this page at ' .date('Y-m-d H:i:s'));

        $InqueryType =  InqueryType::all();
        $cities = Governorate::all();
        $codes = Representative::all();
        $main = Lang::get('main.calls');
        $inquiries = Inquiry::with('user')->latest()->paginate(10);

            return view('inquiries.allCalls',compact('inquiries','cities','codes','InqueryType','main',));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $inquiries =  InqueryType::all();
        $cities = Governorate::all();
        $codes = Representative::all();
        return view('inquiries.newCall',compact('inquiries','cities','codes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CallRequest $request)
    {

        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $data['date_out'] =request('date_out');
        $status = request('status');

        $date = request('date_pending');

        if($status === "Cancelled" || $status === "Credit" || $status === "Postponed"){
            $data['reason']  = $request->reason ;
        }else{
            $data['reason']  = null ;

        }

        if($date == null){

            $data['code']  = "none";
        }else{
            $data['code']  = $request->code;

        }

       Inquiry::create($data);

       $user = Auth::user()->name;
       Log::build([
           'driver' => 'single',
           'path' => storage_path('logs/create.log'),
           'days' => 14,
       ])->info($user . ' Created a new record ' .$data['customer_name']." ". $data['national_id']." ".date('Y-m-d H:i:s'));


        return redirect()->back()->with('message', 'Query Added Successful')->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show($trigger = false)
    {

        $user = Auth::user()->name;
       Log::build([
           'driver' => 'single',
           'path' => storage_path('logs/ground.log'),
           'days' => 14,
       ])->info($user . ' saw how many records in the filed ' .date('Y-m-d H:i:s'));


        $InqueryType =  InqueryType::all();
        $cities = Governorate::all();
        $codes = Representative::all();
        $inquiries = Inquiry::where('status', 'Pending')->with('user')->latest()->paginate(1000);
        /* dd($trigger); */
        if(isset($trigger) && $trigger == "pending"){

            $tomorrow = Carbon::tomorrow()->toDateString();
        }else{

            $tomorrow = Carbon::today()->toDateString();
        }

        // تصفية السجلات بحيث لا يتم عرض السجلات التي لا تحتوي على تاريخ الغد
        $records = $inquiries->filter(function ($record) use ($tomorrow) {
            return $record->date_pending === $tomorrow; // تأكد من اسم الحقل الخاص بالتاريخ
        });



        return view('inquiries.pending',compact('records','cities','codes','InqueryType'));

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $inquiryId = Inquiry::findOrFail($id);
        $inquiries =  InqueryType::all();
        $cities = Governorate::all();
        $codes = Representative::all();
        return view('inquiries.editNewCall',compact('inquiries','cities','codes','inquiryId'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CallUpdateRequest $request, string $id)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $data['date_out'] =request('date_out');
        $data['code'] =request('code');
        $data['status'] =request('status');

       $update = Inquiry::where('id', $id)->update($data);

       $updatedRecord = Inquiry::find($id);
        $user = Auth::user()->name;
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/update.log'),
            'days' => 14,
        ])->info($user . ' Updates that record '.$data['customer_name']." ".$data['national_id']." " .date('Y-m-d H:i:s'));


       return response()->json([
        'id' => $updatedRecord->id,
        'customer_name' => $updatedRecord->customer_name,
        'phone' => $updatedRecord->phone,
        'phone2' => $updatedRecord->phone2,
        'national_id' => $updatedRecord->national_id,
        'date_in' => $updatedRecord->date_in,
        'date_pending' => $updatedRecord->date_pending,
        'date_out' => $updatedRecord->date_out,
        'code' => $updatedRecord->code,
        'address' => $updatedRecord->address,
        'address2' => $updatedRecord->address2,
        'city' => $updatedRecord->city,
        'status' => $updatedRecord->status,
        'code2' => $updatedRecord->code2
    ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
