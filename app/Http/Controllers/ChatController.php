<?php

namespace App\Http\Controllers;
use App\Conversation;
use App\Conversation_user;
use App\Events\Event;
use App\Message;
use App\Message_notification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function get_conversation()
    {
        $fabien=[];
        $data=Conversation_user::where("user_id",Auth::user()->id)->get();
        foreach ($data as $user) {
            $data1=$user;
            array_add($data1,"user_information",json_decode($user->conversation));
            $i=(int) $user->conversation->id;
            $toto=Conversation::find($i)->last_message;
/*            array_add($data1,"last_message",json_encode($toto));*/
            if ($user->conversation->private==true){
                $id=Conversation_user::where("user_id","<>",Auth::user()->id)->where('conversation_id',$user->conversation->id)->get();
                array_add($data1,"users2",json_decode(User::find($id)));
            }
            array_add($data1,"message",json_decode($user->conversation->last_message));
            array_add($data1,"users",json_decode($user->conversation->users));
            array_push($fabien,$data1);
        }
        return $fabien;
    }
    public function get_user_conversation()
    {
      $fabien=[];
      $data=Conversation_user::where("user_id",Auth::user()->id)->get();
      foreach ($data as $user) {
          $data1=["fabien"];
          $i=(int) $user->conversation->id;
          $toto=Conversation::find($i)->last_message;
/*            array_add($data1,"last_message",json_encode($toto));*/
          if ($user->conversation->private==true){
              $id=Conversation_user::where("user_id","<>",Auth::user()->id)->where('conversation_id',$user->conversation->id)->get();
              array_add($data1,"users_conversation",json_decode(User::where("id","<>",$id)->get()));
          }
          array_push($fabien,$data1);
          array_push($fabien,$id);
      }
      return $fabien;
    }

    public function get_message_conversation(Request $request)
    {
        $id= $request->input("data");
        $data=Conversation::find($id)->messages;
        return $data;
    }

    public function envoi_message(Request $request)
    {
        $body=$request->input("data");
/*        $conversation_id=$request->input("data")['conversation_id'];
        $user_id=$request->input("data")['user_id'];
        $type=$request->input("data")['type'];*/

        Message::create($body);
        $data=Conversation::find($request->input("data")['conversation_id'])->last_message;
        Message_notification::create([
            "message_id"=>$data->id,
            "conversation_id"=>$data->conversation_id,
            "user_id"=>Auth::user()->id
        ]);
        event(new Event($data));
        return $data;
    }

    public function get_notification(Request $request)
    {
        $notification=[];
        $data=Conversation_user::where(['user_id'=>Auth::user()->id])->get();
        foreach ($data as $u){
            $mes=Message_notification::where(["conversation_id"=>$u->conversation_id])->where("user_id","<>",Auth::user()->id)->get();
            foreach ($mes as $m){
                array_add($m,"user",$m->sender);
            }
            array_push($notification,$mes);

        }
        return $notification;
    }

    public function get_groupe_conversation()
    {
        $fabien=[];
        $data=Conversation_user::where("user_id",Auth::user()->id)->get();
        foreach ($data as $user) {
            $data1=$user;
            array_add($data1,"user_information",json_encode($user->conversation));
            array_add($data1,"last_message1",json_encode(Conversation::find($user->conversation->id)->last_message));
            array_push($fabien,$data1);
        }
        return $fabien;
    }
}
