@extends('layouts.app')
@section('content')
<div class="container pt-4" ng-controller="publication">
<div class="card shadow-md" >
<div class="card-header bg-info text-white">
    <center>
        <fieldset>
            <i class="fa fa-reply fa-2x float-left"></i>
            Publication
        </fieldset>
    </center>
</div>
  <div class="row py-3 px-3">
      <div class="col-md-2">
          <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
          <p class="text-secondary text-center">{{$publication->created_at}}</p>
        @if ($publication->user_id=Auth()->user()->id)
          <p ><a href="{{ route('publication.edit',$publication) }}">Modifier</a></p>
        @endif
      </div>
      <div class="col-md-10">
          <p class="pt-2">
              <a class="text-capitalize p-0" href=""><strong>{{$publication->user->name}}</strong></a>
              {{-- <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                <span class="float-right"><i class="text-warning fa fa-star"></i></span>
              <span class="float-right"><i class="text-warning fa fa-star"></i></span>
              <span class="float-right"><i class="text-warning fa fa-star"></i></span> --}}

         </p>
         <div class="text-justify">
           <h4>{{$publication->url}}</h4>
         </div>
          <p>{{$publication->body}}</p>
          <p>
              <a class="float-right btn btn-outline-primary ml-2"> <i class="badge">{{ count($publication->comments) }}</i> Reponse</a>
         </p>
      </div>
  </div>
</div>
    <div>

    </div>
<div class="card">
<div class="bg-gradient-primary p-0 text-center py-3">
<h2>  Commentaire <i class="fa fa-comment fa-2x"></i> </h2>
</div>
    <hr>
<div class="card-body comment-card">
    @php

    @endphp
  @if ($publication->comments->count()>0)
      @php
      $comment=\App\Comment::where('publication_id',$publication->id)->orderBy('created_at','desc')->paginate(2);
      @endphp
                @foreach ($comment as $comments)
                    <div class="row pb-2">
                        <div class="col-md-12 row">
                            <div  class="col-md-2">
                                <img src="" class="img-fluid">
                            </div>
                            <div class="col-md-10">
                                <p class="text-secondary "><a class="author"><h2 class="text-capitalize">{{ $comments->user->name }}</h2></a>
                                <div class="metadata float-right">
                                    <span class="date">{{ $comments->created_at }}</span>
                                </div></p>
                                <div class="text">
                                    <p>
                                        {{$comments->body}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                  <div class="justify-content-lg-start float-none">
                      {{$comment->links()}}
                  </div>
              @else
                <div class="">
                    Aucun commentaire pour linstant
                </div>
            @endif
</div>
<div class="card-footer">
<form class="form-group" action="{{route('comments',$publication)}}" method="post">
          {{ csrf_field() }}
<fieldset>
    <legend>Nouveau commentaire</legend>
    <div class="form-inline">
        <label for="Commentaire"></label>
        <textarea  rows="3" name="body"  class="form-control col"></textarea>
    </div>
    <div class="actions p-3">
        <button type="submit" name="button" class="btn btn-primary float-right"> <i class="fa fa-paper-plane pr-2"></i>Commenter</button>
    </div>
</fieldset>
</form>
</div>
</div>
</div>
@endsection
