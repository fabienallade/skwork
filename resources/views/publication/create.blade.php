@extends('layouts.app')
@section('content')
<div class="container">
<div class="card">
  <div class="card-header bg-success">
    Enregistrer votre publication ici
  </div>
  @if ($errors->any())
  <div class="alert alert-danger">
      <i class="close icon"></i>
      <ul class="list">
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif
  <div class="card-body" ng-controller="create_pub">
  <form class="" action="{!! route('publication.store') !!}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="titre">Titre de la publication</label>
          <input type="text" name="url" value="{{ old('url') }}" class="form-control">
        </div>
        <div class="form-group">
          <label for="titre">Corps  de la publication</label>
          <textarea  name="body" rows="8" cols="80" class="form-control">
            {{ old('body') }}
          </textarea>
        </div>
        <div class="form-group">
          <label for="titre">Fichier accompagne de la publication</label>
          <input type="file" name="files" value="{{ old('files') }}" class="form-control">
          <small>Un fichier n'est pas oblicatoire</small>
        </div>
        <div class="actions">
          <div class="">
            <button type="submit" name="button" class="btn btn-success">Enregistrer</button>
          </div>
        </div>
  </form>
  </div>
</div>
</div>
@endsection
