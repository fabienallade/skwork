@extends('layouts.app')
@section('content')
<div class="container" ng-controller="publication">
<div class="card " >
  <div class="row pb-3">
      <div class="col-md-2">
          <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
          <p class="text-secondary text-center">{{$publication->created_at}}</p>
        @if ($publication->user_id=Auth()->user()->id)
          <p ><a href="{{ route('publication.edit',$publication) }}">Modifier</a></p>
        @endif
      </div>
      <div class="col-md-10">
          <p>
              <a class="float-left" href=""><strong>{{$publication->user->name}}</strong></a>
              {{-- <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                <span class="float-right"><i class="text-warning fa fa-star"></i></span>
              <span class="float-right"><i class="text-warning fa fa-star"></i></span>
              <span class="float-right"><i class="text-warning fa fa-star"></i></span> --}}

         </p>
         <div class="clearfix">
           <h4>{{$publication->url}}</h4>
         </div>
          <p>{{$publication->body}}</p>
          <p>
              <a class="float-right btn btn-outline-primary ml-2" href="{{ route('publication.show',$publication) }}"> <i class="badge">{{ count($publication->comments) }}</i> Reponse</a>
              <a class="float-right btn text-white btn-danger"> <i class="fa fa-heart"></i> P.J</a>
         </p>
      </div>
  </div>
</div>
<div class="card card-body card-inner ">
<div class="card-header">
  Commentaire
</div>
<div class="card-body">
  @if ($publication->comments->count()>0)
                @foreach ($publication->comments as $comments)
                  <div class="col-md-12">
                    <a class="col-md-2">
                      <img src="">
                    </a>
                    <div class="col-md-10">

                      <p class="text-secondary text-center"><a class="author">{{ $comments->user->name }}</a>
                      <div class="metadata">
                        <span class="date">{{ $comments->created_at }}</span>
                      </div></p>
                      <div class="text">
                        {{$comments->body}}
                      </div>
                      {{-- <div class="actions">
                        <a class="reply">Reply</a>
                      </div> --}}
                    </div>
                  </div>
                @endforeach
              @else
                <div class="ui segment blue inverted">
                    Aucun commentaire pour linstant
                </div>
            @endif
</div>
<div class="card-footer">
<form class="form-group" action="{{route('comments',$publication)}}" method="post">
          {{ csrf_field() }}
  <div class="form-inline">
      <label for="Commentaire"></label>
      <textarea  rows="3" name="body"  class="form-control col"></textarea>
  </div>
  <div class="actions p-3">
    <button type="submit" name="button" class="btn btn-primary float-right">Commenter</button>
  </div>
</form>
</div>
</div>
</div>
@endsection
