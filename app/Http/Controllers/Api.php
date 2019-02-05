<?php

namespace App\Http\Controllers;

use App\Poste;
use App\Rapport;
use App\Message;
use App\Publication;
use App\Comment;
use App\Tache;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use PhpParser\Node\Expr\Array_;

class Api extends Controller
{
    public function postes(Request $request)
    {
     return Response::json(Poste::all());
    }

    public function get_task(Request $request)
    {
        $tache = Tache::where('users_id', Auth::user()->id)->where('date',now()->format("Y-m-d"))->get();
        return Response::json($tache);
    }

    public function update_task(Request $request)
    {
        $data=$request->input('name');
        $id=$request->input('id');
        $tache=Tache::find($id);
        $tache->name=$data;
        $do=$tache->save();
        return Response::json($do);
    }

    public function delete_task(Request $request)
    {
        $id=$request->input('id');
        $tache=Tache::find($id);
      if ($tache->delete()) {
        return Response::json(true);
      }else {
          return Response::json(false);
      }
    }

    public function create_task(Request $request,Array_$data)
    {
        $name=$request->input('name');
        $tache=new Tache;
        $tache->name=$name;
        $tache->date=now()->format("Y-m-d");
        $tache->users_id=Auth::user()->id;
        $do=$tache->save();
        return Response::json($do);
    }

    public function create_rapport(Request $request)
    {
        $name=$request->input('name');
        $body=$request->input('rapport');
        $id=$request->input('id');
        $tache=Tache::find($id);
        $tache->do_it=1;
        $do=$tache->save();
        $taches=$request->input('id');
        $rapport=new Rapport;
        $rapport->name=$name;
        $rapport->body=$body;
        $rapport->taches_id=$taches;
        $do=$rapport->save();
        return Response::json($do);

    }

    public function find_rapport(Request $request)
    {
        $id=$request->input('data')['id'];
        $rapport=Rapport::where('taches_id',$id)->first();
        return Response::json($rapport);
    }

    public function update_rapport(Request $request)
    {
        $id=$request->input('id');
        $name=$request->input("name");
        $body=$request->input("rapport");
        $rapport=Rapport::where('id',$id)->update(['name'=>$name,'body'=>$body]);
        return Response::json($rapport);
    }
    public function create_pub(Request $request)
    {
      $id=$request->input('id');
      $body=$request->input('body');
      $url=$request->input('url');
      $publication=new Publication;
      $publication->body=$body;
      $publication->url=$url;
      $publication->user_id=$id;
      $publication->save();
      return Response::json($id);
    }
    public function user()
    {
      $data=User::where('id','!=',Auth::user()->id)->get();
        return Response::json($data);
    }
    public function get_last(Request $request)
    {
      $id=$request->input('data');
      $data=Message::where('receiver_id',$id)->orWhere('envoi_id',$id )->where('envoi_id',Auth::user()->id)->orWhere('receiver_id',Auth::user()->id)->latest()->first();
      return Response::json($data);
    }
    public function get_user(Request $request)
    {
      $data=User::where('id','!=',Auth::user()->id)->get();
        return Response::json($data);
    }
    public function post_message(Request $request,$id,$id2)
    {
      $data=$request->input("id");
      $message=new Message;
      $message->receiver_id=$id;
      $message->messages=$data;
      $message->envoi_id=$id2;
      $message->save();
    return Response::json("ok");
    }
    public function get_message($id,$id2)
    {
      $data=Message::where('receiver_id',$id)->orWhere('envoi_id', $id)->where('envoi_id',$id2)->orWhere('receiver_id',$id2)->get();
    return Response::json($data);
    }
    public function post_commentaire(Request $request,$id)
    {
      $data= $request->input("id");
      $comment = new Comment(['body' => $data,'user_id'=>Auth::user()->id]);
      $post = Publication::find($id);
      $post->comments()->save($comment);
      return Response::json("ok");
    }
    public function get_commentaire($id)
    {
      $post =Publication::find($id);
      $comment = $post->comments();
        return Response::json($comment);
    }
}
