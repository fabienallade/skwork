<?php

namespace App\Http\Controllers;

use App\Publication;
use App\Comment;
use App\Tache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $publication=Publication::orderBy('created_at', 'desc')->paginate(5);
        return view("publication.index", ['publication' => $publication]);
    }

    public function rapport()
    {
        return view('Rapport');
    }
    public function messages()
    {
      return view("messages");
    }
    public function commentaire($id)
    {
      $publication=Publication::find($id);
      return view("comments",['pub'=>$publication,'id'=>$id]);
    }
    public function discussion($id)
    {
      return view('messages',['id'=>$id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('publication.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
              $request->validate([
          'url' => 'bail|max:255',
          'body' => 'required',
          'files'=>'file'
        ]);

        $file = $request->file('files');
        $body=$request->input('body');
        $url=$request->input('url');
        $publication=new Publication;
        $publication->body=$body;
        $publication->url=$url;
        if ($file) {
          $path = $request->file('files')->store(
              'publication/'.$request->user()->id, 'files'
          );
          $publication->photo=$path;
        }
        $publication->user_id=Auth::user()->id;
        $publication->save();
        return redirect('api/publication');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function show(Publication $publication)
    {
        $publication=Publication::where('id',$publication->id)->first();
        return view('publication.show',compact('publication'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function edit(Publication $publication)
    {
      $publication=Publication::where('id',$publication->id)->first();
      return view('publication.edit',compact('publication'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publication $publication)
    {
      $file = $request->file('files');
      $body=$request->input('body');
      $url=$request->input('url');
      $pub=Publication::where('id',$publication->id)
      ->update(
      [  'body'=>$body,
        'url'=>$url]
      );
      return redirect('Publication');
    }
    public function comments(Request $request,Publication $publication)
    {
      $comments=new Comment;
      $comments->body=$request->input('body');
      $comments->user_id=Auth()->user()->id;
      $comments->publication_id=$publication->id;
      $comments->save();
      return redirect("api/publication/$publication->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publication $publication)
    {
        //
    }
}
