@extends('layouts.app')
@section('content')
<div class="container pt-4">
<div class="card shadow-lg">
  <div class="card-header bg-success">
    Modifier votre publication ici
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
  <div class="card-body">
  <form class="" action="{!! route('publication.update',$publication) !!}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="put">
        <div class="form-group">
          <label for="titre">Titre de la publication</label>
          <input type="text" name="url" value="{{ $publication->url }}" class="form-control">
        </div>
        <div class="form-group">
          <label for="titre">Corps  de la publication</label>
          <textarea name="body" rows="8" cols="80" class="form-control">
            {{ $publication->body }}
          </textarea>
        </div>
        <div class="form-group">
          <label for="titre">Fichier accompagne de la publication</label>
          <input type="file" name="files" value="{{ $publication->files }}" class="form-control">
          <small>Un fichier n'est pas oblicatoire</small>
        </div>
        <div class="actions">
          <div class="">
            <button type="submit" name="button" class="btn btn-success">Modifier</button>
          </div>
        </div>
  </form>
  </div>
</div>
</div>
@endsection
