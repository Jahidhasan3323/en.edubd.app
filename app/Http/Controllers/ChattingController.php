<?php

namespace App\Http\Controllers;

use App\Chatting;
use App\User;
use App\UserDb2;
use App\UserDb3;
use App\UserDb4;
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
            
            $contacts1['user1']=UserDb4::with('school','student','staff','group', 'committee')
                        ->where('name','like',$data.'%')
                        ->where('group_id','!=',2)
                        ->where('id','!=',Auth::id())
                        ->get();
            $contacts1['user2']=UserDb4::with('school','student','staff','group', 'committee')
                        ->where('name','like',$data.'%')
                        ->where('group_id','!=',2)
                        ->where('id','!=',Auth::id())
                        ->get();
            $contacts1['user3']=UserDb4::with('school','student','staff','group', 'committee')
                        ->where('name','like',$data.'%')
                        ->where('group_id','!=',2)
                        ->where('id','!=',Auth::id())
                        ->get();
            $contacts1['user4']=UserDb4::with('school','student','staff','group', 'committee')
                        ->where('name','like',$data.'%')
                        ->where('group_id','!=',2)
                        ->where('id','!=',Auth::id())
                        ->get();
            $unreadIds= Chatting::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
                        ->where('to', Auth::id())
                        ->where('read',false)
                        ->groupby('from')
                        ->get();
            $contacts[] = $contacts1['user1']->map(function($contact) use ($unreadIds){
                $contactUnread= $unreadIds->where('sender_id', $contact->id)->first();
                $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
                $contact['db']=1;
                return $contact;
            });

            $contacts[] = $contacts1['user2']->map(function($contact) use ($unreadIds){
                $contactUnread= $unreadIds->where('sender_id', $contact->id)->first();
                $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
                $contact['db']=2;
                return $contact;
            });
            $contacts[] = $contacts1['user3']->map(function($contact) use ($unreadIds){
                $contactUnread= $unreadIds->where('sender_id', $contact->id)->first();
                $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
                $contact['db']=3;
                return $contact;
            });
            $contacts[] = $contacts1['user4']->map(function($contact) use ($unreadIds){
                $contactUnread= $unreadIds->where('sender_id', $contact->id)->first();
                $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
                $contact['db']=4;
                return $contact;
            });
            return response()->json($contacts);
        }
            $contacts1['user1']=User::with('school','student','staff','group', 'committee')
                        ->where('name','like',$data.'%')
                        ->where('group_id','!=',2)
                        ->where('id','!=',Auth::id())
                        ->limit(500)
                        ->get();
            $contacts1['user2']=UserDb4::with('school','student','staff','group', 'committee')
                        ->where('name','like',$data.'%')
                        ->where('group_id','!=',2)
                        ->where('id','!=',Auth::id())
                        ->get();
            $contacts1['user3']=UserDb4::with('school','student','staff','group', 'committee')
                        ->where('name','like',$data.'%')
                        ->where('group_id','!=',2)
                        ->where('id','!=',Auth::id())
                        ->get();
            $contacts1['user4']=UserDb4::with('school','student','staff','group', 'committee')
                        ->where('name','like',$data.'%')
                        ->where('group_id','!=',2)
                        ->where('id','!=',Auth::id())
                        ->get();
             
        $unreadIds= Chatting::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
                    ->where('to', Auth::id())
                    ->where('read',false)
                    ->groupby('from')
                    ->get();
        $contacts[] = $contacts1['user1']->map(function($contact) use ($unreadIds){
            $contactUnread= $unreadIds->where('sender_id', $contact->id)->first();
            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
             $contact['db']=1;
            return $contact;
        });
        $contacts[] = $contacts1['user2']->map(function($contact) use ($unreadIds){
            $contactUnread= $unreadIds->where('sender_id', $contact->id)->first();
            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
            $contact['db']=2;
            return $contact;
        });
        $contacts[] = $contacts1['user3']->map(function($contact) use ($unreadIds){
            $contactUnread= $unreadIds->where('sender_id', $contact->id)->first();
            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
            $contact['db']=3;
            return $contact;
        });
        $contacts[] = $contacts1['user4']->map(function($contact) use ($unreadIds){
            $contactUnread= $unreadIds->where('sender_id', $contact->id)->first();
            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
            $contact['db']=4;
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
            'messasge' =>$request->text,
            'to_db' =>$request->to_db,
            'from_db' =>1
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

    public function allConvertation()
    {
        $convertations=Chatting::with('user','user2','user3','user4','to_user','to_user2','to_user3','to_user4')->withTrashed()->get();
        return view('backEnd/chatApp/all_convertation',compact('convertations'));

    }
}


