<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $inquiries = Inquiry::with('user')->latest()->paginate(10);
        $tomorrow = Carbon::tomorrow()->toDateString();
        $yesterday = Carbon::yesterday()->toDateString();
        $today = Carbon::today()->toDateString();
        $pending = Inquiry::where('status','=','Pending')->where('date_pending' ,'!=', $today)->where('date_pending' ,'=', $tomorrow)->
        count();

        $WithOutProto = Inquiry::where('status','=','Pending')->where('code','!=','proto')->where('code','!=','none')->where('date_pending' ,'=', $tomorrow)->get()->
        count();

        $proto = Inquiry::where('status','=','Pending')->where('code','=','proto')->where('code','!=','none')->orWhere('code2','=','proto')->where('date_pending' ,'=', $tomorrow)->get()->
        count();

        $ground = Inquiry::where('status','=','Pending')->where('date_pending' ,'=', $today)->where('code','!=','none')->
        count();
        $records = $inquiries->filter(function ($record) use ($tomorrow) {
            return $record->date_pending === $tomorrow; // تأكد من اسم الحقل الخاص بالتاريخ
        });

        $cancelled ="Cancelled" ;
        $Credit = "Credit";
        $Postponed = "Postponed";

        $noAnsower = Inquiry::whereDate('date_out' , $today)->where('status','NoAnsower')->with('user')->get()->count();

        $differentDay = Inquiry::where('date_pending', '>', $tomorrow)->get()->count();
        $OverdueInquiries = Inquiry::whereDate('date_pending', '<=' , $yesterday)->get()->count();
        $UnansweredDelays = Inquiry::whereDate('date_out', '<=' , $yesterday)->where('status','NoAnsower')->get()->count();
        $Inquired = Inquiry::where('status','Done')->where('journey','>', '0')->with('user')->count();
        $other = Inquiry::whereIn('status', [$cancelled, $Credit, $Postponed])->count();
        $blanks = Inquiry::where('code','=','none')->where('status', '=', 'Pending')
        ->where('date_pending', '=', null)
         ->count();


        $totalInquiries = $inquiries->total(); // للحصول على العدد الإجمالي للسجلات في قاعدة البيانات
        $totalInProcess = $pending;

        $groundCounter = $ground;

        return view('home',compact('totalInquiries',
        'totalInProcess',
        'groundCounter',
        'noAnsower',
        'differentDay',
        'OverdueInquiries','UnansweredDelays','Inquired','other','blanks','WithOutProto','proto'));
    }
}
