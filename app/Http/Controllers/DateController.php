<?php

namespace App\Http\Controllers;

use App\Exports\InqueriesExport;
use Illuminate\Http\Request;
use App\Models\Governorate;
use App\Models\InqueryType;
use App\Models\Inquiry;
use App\Models\Representative;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class DateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $InqueryType =  InqueryType::all();
        $cities = Governorate::all();
        $codes = Representative::all();
        //$inquiries = Inquiry::where('status', 'Pending')->with('user')->latest()->paginate(10);

        $today = Carbon::today()->toDateString();
        $tomorrow = Carbon::tomorrow()->toDateString();
        $yesterday = Carbon::yesterday()->toDateString();

        $records = Inquiry::where('date_pending', '>', $tomorrow)->get();

        $user = Auth::user()->name;
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/dalyinquiry.log'),
            'days' => 14,
        ])->info($user . ' visit this page at '.date('Y-m-d H:i:s'));

        return view('inquiries.dalyDate',compact('records','cities','codes','InqueryType'));

    }


    public function show()
    {
        $InqueryType =  InqueryType::all();
        $cities = Governorate::all();
        $codes = Representative::all();
        //$inquiries = Inquiry::where('status', 'Pending')->with('user')->latest()->paginate(10);

        $yesterday = Carbon::yesterday()->toDateString();

        $records = Inquiry::whereDate('date_pending', '<=' , $yesterday)->get();

        $user = Auth::user()->name;
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/arrearsInqueries.log'),
            'days' => 14,
        ])->info($user . ' visit this  page at '.date('Y-m-d H:i:s'));

        return view('inquiries.arrears',compact('records','cities','codes','InqueryType'));

    }
    public function noAnswoer()
    {

        $InqueryType =  InqueryType::all();
        $cities = Governorate::all();
        $codes = Representative::all();
      //  $records = Inquiry::where('status','NoAnsower')->with('user')->latest()->paginate(10);
        $today = Carbon::today()->toDateString();

        $records = Inquiry::whereDate('date_out' , $today)->where('status','NoAnsower')->with('user')->get();

        $user = Auth::user()->name;
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/noAnsower.log'),
            'days' => 14,
        ])->info($user . ' visit this  page at '.date('Y-m-d H:i:s'));


        return view('inquiries.NoAnswoer',compact('records','cities','codes','InqueryType'));

    }

    public function noAnswoerWithMoreThanDay()
    {

        $InqueryType =  InqueryType::all();
        $cities = Governorate::all();
        $codes = Representative::all();
        //$inquiries = Inquiry::where('status','NoAnsower')->with('user')->latest()->paginate(10);

        $yesterday = Carbon::yesterday()->toDateString();

        $records = Inquiry::whereDate('date_out', '<=' , $yesterday)->where('status','NoAnsower')->get();

        $user = Auth::user()->name;
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/noAnswoerWithMoreThanDay.log'),
            'days' => 14,
        ])->info($user . ' visit this  page at '.date('Y-m-d H:i:s'));


        return view('inquiries.noAnswoerWithMoreThanDay',compact('records','cities','codes','InqueryType'));

    }
    public function done()
    {

        $InqueryType =  InqueryType::all();
        $cities = Governorate::all();
        $codes = Representative::all();
        $records = Inquiry::where('status','Done')->where('journey','>', '0')->with('user')->latest()->paginate(10);

        $user = Auth::user()->name;
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/done.log'),
            'days' => 14,
        ])->info($user . ' visit this  page at '.date('Y-m-d H:i:s'));

        return view('inquiries.doneCustomer',compact('records','cities','codes','InqueryType'));

    }
    public function other(Request $request)
    {

        $InqueryType =  InqueryType::all();
        $cities = Governorate::all();
        $codes = Representative::all();
        //$inquiries = Inquiry::where('status', 'Pending')->with('user')->latest()->paginate(10);

        $today = Carbon::today()->toDateString();
        $tomorrow = Carbon::tomorrow()->toDateString();
        $yesterday = Carbon::yesterday()->toDateString();

         $cancelled ="Cancelled" ;
         $Credit = "Credit";
         $Postponed = "Postponed";


        $records = Inquiry::whereIn('status', [$cancelled, $Credit, $Postponed])->with('user')->latest()->paginate(10);

        $user = Auth::user()->name;
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/other.log'),
            'days' => 14,
        ])->info($user . ' visit this  page at '.date('Y-m-d H:i:s'));


        return view('inquiries.other',compact('records','cities','codes','InqueryType'));


    }
    public function blanks(Request $request)
    {

        $InqueryType =  InqueryType::all();
        $cities = Governorate::all();
        $codes = Representative::all();
        //$inquiries = Inquiry::where('status', 'Pending')->with('user')->latest()->paginate(10);

        $today = Carbon::today()->toDateString();
        $tomorrow = Carbon::tomorrow()->toDateString();
        $yesterday = Carbon::yesterday()->toDateString();

         $cancelled ="Cancelled" ;
         $Credit = "Credit";
         $Postponed = "Postponed";

         $records = Inquiry::where('code','=','none')->where('status', '=', 'Pending')
         ->where('date_pending', '=', null)->get();


/*         $records = Inquiry::whereIn('status', [$cancelled, $Credit, $Postponed])->with('user')->latest()->paginate(10);
 */
        $user = Auth::user()->name;
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/blanks.log'),
            'days' => 14,
        ])->info($user . ' visit this  page at '.date('Y-m-d H:i:s'));


        return view('inquiries.blanks',compact('records','cities','codes','InqueryType'));


    }


    public function print(Request $request){
            // تحقق من وجود قيمة للكود في الطلب
            $tomorrow = Carbon::tomorrow()->toDateString();
            if (!empty($request->code)) {
                // استعلام للبحث عن السجلات بناءً على الحالة والكود
                $records = Inquiry::where('date_pending' ,'=', $tomorrow)->
                where(function($query) use ($request) {
                    $query->where('code', '=', $request->code)
                    ->orWhere('code2', '=', $request->code);

                })
                ->get();

           //dd($records);
        // تحقق من وجود بيانات
        if ($records->isEmpty()) {
            // إعادة توجيه مع رسالة خطأ إذا لم يتم العثور على بيانات
            return redirect()->back()->with('error', 'No data found for the provided code');
        }

        // إذا كانت البيانات موجودة، قم بتنزيل الملف
        $code = $request->code;
        $today = Carbon::today()->toDateString();
        $fileName = 'inquiries_' . $code . '_' . $today . '.xlsx';

        $user = Auth::user()->name;
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/print.log'),
            'days' => 14,
        ])->info($user . ' Printed ' .$fileName ." at".date('Y-m-d H:i:s'));

        // تمرير المتغير إلى الكلاس InqueriesExport
        return Excel::download(new InqueriesExport($code), $fileName);
    }

    // إعادة توجيه مع رسالة خطأ إذا لم يتم توفير كود
    return redirect()->back()->with('error', 'Code is required');

    }

}
