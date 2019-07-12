@extends('layouts.app')
@section('content')
  <div class="container pt-4" ng-controller="publication">
  <div class="jumbotron">
	<h2 class="text-center">Publication dans lentreprise</h2>
  </div>
<div class="m-auto">
<a href="{{ route('publication.create') }}" class="btn btn-outline-primary">Nouvelle publication</a>
<hr>
</div>
  	<div class="card shadow-lg">
  	    <div class="card-body">
@foreach ($publication as $pub)
  <div class="row pb-3">
      <div class="col-md-2 text-center">
          <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
          <p class="text-secondary text-center">{{$pub->created_at}}</p>
        @if ($pub->user_id=Auth()->user()->id)
          <p ><a href="{{ route('publication.edit',$pub) }}">Modifier</a>
              <br>
              @if(count($pub->comments)==0)
                  <a href="{{ route('publication.destroy',$pub) }}">Suprimer</a>
                  @endif
          </p>
        @endif
      </div>
      <div class="col-md-10">
          <p class="pt-2">
              <a class="text-capitalize p-0" href=""><strong>{{$pub->user->name}}</strong></a>
                <span class="float-right"> section {{$pub->user->postes->libelle}}</span>
              <div class="text-justify">
                <h4>{{$pub->url}}</h4>
              </div>
         </p>

          <p>{{$pub->body}}</p>
          <p>
              <a class="float-right btn btn-outline-primary ml-2" href="{{ route('publication.show',$pub) }}"> <i class="badge">{{ count($pub->comments) }}</i> Reponse <i class="fa fa-reply"></i></a>
  @if ($pub->photo)
                <a class="float-right btn text-white btn-danger" ng-click='pdf("{{ asset("files//".$pub->photo."//".$pub->photo) }}")'>fichier <i class="fa fa-pdf"></i></a>
  @endif
   </p>
          <p>
              <a href="" class="btn btn-outline-primary">lire le fichier accompagner</a>
          </p>
      </div>
  </div>
                <hr>
@endforeach
    @if(count($publication)==0)
    <div class="row pt-4">
            <div class="alert alert-info col pt-4">
                Aucune  publication na ete fait jusqua maintenant
            </div>
    </div>
    @endif
  	    </div>
  	</div>
    <div class="center">
              {{ $publication->links() }}
    </div>
  </div>
  <!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Fichier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe src="__pdf_name__" width="100%" height="100%" > </iframe>
      </div>
    </div>
  </div>
</div>
@endsection
