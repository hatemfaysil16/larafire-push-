<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\SendPushNotification;
use Illuminate\Http\Request;
use Kutia\Larafirebase\Facades\Larafirebase;
use Notification;

class HomeController extends Controller
{

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
        return view('home');
    }

    public function go(Request $request)
    {
        $title = 'is titsadsadle';
        $message = 'is titasdsadsad le';
        $fcmToken = 'faXqMhxqeVPEvNjQDVJp9z:APA91bFn_cBSyl4k1p6pRRKBZ2ZQ1zO8g6ZQIIcPWseW5_Lt5E1wiLnzJV9w4MuIDR5zv0xu5_j3jLtyAweCCZdSfrGsNuiyvUcUzbureW4lTbR1FxXQCjQFWua78QS6zq4nKYEbqZFk';
         $a =  Notification::send('null',new SendPushNotification('$title','$message',$fcmToken));

        dd($a);
    }

    public function updateToken(Request $request){
        try{
            $request->user()->update(['fcm_token'=>$request->token]);
            return response()->json([
                'success'=>true
            ]);
        }catch(\Exception $e){
            report($e);
            return response()->json([
                'success'=>false
            ],500);
        }
    }


    public function notification(Request $request){
        $request->validate([
            'title'=>'required',
            'message'=>'required'
        ]);

            $fcmTokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

            //Notification::send(null,new SendPushNotification($request->title,$request->message,$fcmTokens));

            /* or */

            //auth()->user()->notify(new SendPushNotification($title,$message,$fcmTokens));

            /* or */

            Larafirebase::withTitle($request->title)
                ->withBody($request->message)
                ->sendMessage($fcmTokens);

            return redirect()->back()->with('success','Notification Sent Successfully!!');


    }


}
