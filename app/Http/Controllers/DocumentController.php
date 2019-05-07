<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $document_receive=Document::where('receive_id',Auth::user()->id)->get();
      $document_envoyer=Document::where('envoi_id',Auth::user()->id)->get();
      return view('document.index',compact('document_receive',"document_envoyer"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'document' => 'required',
            'receive_id' => 'required',
            // 'files'=>'file'
          ]);

          $document = $request->input('document');
          $receive_id=$request->input('receive_id');
          // $url=$request->input('url');
          $document=new Document;
          $document->document=$request->input('document');
          $document->receive_id=$request->input("receive_id+");
          // if ($file) {
          //   $path = $request->file('files')->store(
          //       'publication/'.$request->user()->id, 'files'
          //   );
          //   $publication->photo=$path;
          // }
          $document->envoi_id=Auth::user()->id;
          $document->save();

          return redirect('document');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function show(c $c)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function edit(c $c)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, c $c)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function destroy(c $c)
    {
        //
    }
}
