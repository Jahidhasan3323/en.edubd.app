<?php

namespace App\Http\Controllers;

use App\Chatting;
use App\User;
use App\Events\NewMessage;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Auth;
use DB;
class ChattingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contacts($data=null)
    {
        if($data != null){
            $contacts=User::with('school','student','staff','group', 'committee')
                        ->where('name','like',$data.'%')
                        ->where('group_id','!=',2)
                        ->where('id','!=',Auth::id())
                        ->get();
            $unreadIds= Chatting::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
                        ->where('to', Auth::id())
                        ->where('read',false)
                        ->groupby('from')
                        ->get();
            $contacts = $contacts->map(function($contact) use ($unreadIds){
                $contactUnread= $unreadIds->where('sender_id', $contact->id)->first();
                $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
                return $contact;
            });
            return response()->json($contacts);
        }
        $contacts=User::with('school','student','staff','group', 'committee')
                        ->where('group_id','!=',1)
                        ->where('group_id','!=',2)
                        ->where('id','!=',Auth::id())
                        ->limit(300)
                        ->get();
        $unreadIds= Chatting::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
                    ->where('to', Auth::id())
                    ->where('read',false)
                    ->groupby('from')
                    ->get();
        $contacts = $contacts->map(function($contact) use ($unreadIds){
            $contactUnread= $unreadIds->where('sender_id', $contact->id)->first();
            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
            return $contact;
        });
        /*foreach ($contacts as $contact ) {
            echo $contact->student->photo;
            
        }
        exit;*/
        return response()->json($contacts);
    }
    public function index($reciver_id)
    {
        // mark all message with the selected contact as read 
        Chatting::where('from', $reciver_id)->where('to', Auth::id())->update(['read'=>true]);
        
        $messages=Chatting::where(function($q) use ($reciver_id) {
                        $q->where('from', Auth::id());
                        $q->where('to',$reciver_id);
                    })->orWhere(function($q) use ($reciver_id) {
                        $q->where('from', $reciver_id);
                        $q->where('to',Auth::id());
                    })
                    ->get();
        return response()->json($messages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile_image()
    {
        $photo = LoginController::getUserPhoto();
        //$photo = substr($photo, 7);
        return response()->json($photo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chatting=Chatting::create([
            'to' =>$request->contact_id,
            'messasge' =>$request->text
        ]);
        broadcast(new NewMessage($chatting));
        return response()->json($chatting);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chating  $chating
     * @return \Illuminate\Http\Response
     */
    public function show(Chating $chating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chating  $chating
     * @return \Illuminate\Http\Response
     */
    public function edit(Chating $chating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chating  $chating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chating $chating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chating  $chating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chating $chating)
    {
        //
    }
}


