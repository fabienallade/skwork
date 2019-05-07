@extends('layouts.app')
@section('content')
<div class="container">

  <div class="col-lg-12">
              <h2 id="nav-tabs">Documents</h2>
              <div class="bs-component">
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link active show" data-toggle="tab" href="#home">Document recu</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link show" data-toggle="tab" href="#profile">Envoyer document</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link show" data-toggle="tab" href="#nouveau">Nouveau document</a>
                  </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                  <div class="tab-pane fade active show" id="home">
                    <div class="">
                      <h1>Document recu</h1>
                      <div class="card card-body shadow-md">
                        @foreach ($document_receive as $doc)
                          <div class="">
                            {{ $doc->document }}
                            <p>Envoye a {{ $doc->created_at}}</p>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="profile">
                    <div class="card ">
                        <div class="card header">
                          <h1>Documents Envoyer</h1>
                        </div>
                        <div class="card-body">
                          @foreach ($document_envoyer as $doc)
                            <div class="">
                              {{ $doc->document }}
                              <p>Envoye a {{$doc->created_at}}</p>
                            </div>
                          @endforeach
                        </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="nouveau">
                  <div class="">
                    <form class="" action="{!! route('document.store') !!}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <label for="document">Nom document</label>
                        <input type="text" name="document" value="" required class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="user">Le reveveur</label>
                        <select type="text" name="receive_id" value="" class="form-control">
                          <option value=""></option>
                          @foreach ($users=App\User::all() as $user)
                            <option class="" value="{{ $user->id }}">
                              {{ $user->name }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                          <button type="submit" name="button" class="btn btn-info btn-full">Envoyer un nouveau documents</button>
                      </div>
                    </form>
                  </div>
                  </div>
                </div>
              </div>
            </div>
</div>
@endsection
