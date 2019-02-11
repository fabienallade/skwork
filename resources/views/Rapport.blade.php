@extends('layouts.app')
@section('content')
  @if (session('status'))
      <div class="alert alert-success" role="alert">
          {{ session('status') }}
      </div>
  @endif
<div class="container" ng-controller="rapport">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
              <div class="card-header">
              Rapport des taches effectuer de ce {{now()->format("Y/m/d")}}

              <a href="{{ route('home') }}" class="float-right">Emploi</a>
              </div>
              <div class="card-body" id="scrol">
                <div class="p-1" ng-repeat="to in todo" >
                          <div class="h p-2">
                              <span>__to.name__</span>
                              <div class="float-right">
                                <span class="" ng-if="to.do_it==null">
                                      <button class="btn btn-warning" ng-click="make(to)">En attente <i class="fa fa-edit"></i></button>
                                  </span>
                                  <span class="" ng-if="to.do_it==1">
                                     <button class="btn btn-success " ng-click="edit(to)">Envoye,modifier??? <i class="fa fa-edit"></i></button>
                                 </span>
                              </div>
                          </div>
                      </div>
                      <div class="" ng-if="todo.length<=0">
                          <div class="content">
                              Il ny a rien de programmer pour le moment pour ce jour
                          </div>
                      </div>
              </div>
            </div>
        </div>
    </div>
    <div class="modal" id="rapportmodal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modification de la tache</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  class="form" name="form_modal">
                      <div class="form-group">
                        <label for="name">Nom</label>
                          <input type="text" class="form-control " disabled="true" ng-model="rapport.name">
                      </div>
                      <div class="form-group">
                            <label for="text">Ecrire le rapport ici</label>
                            <textarea name="text" id="text" cols="100" rows="10" ng-model="rapport.rapport" class="form-control"></textarea>
                        </div>
                    <hr>
                      <div class="actions">
                          <div class="btn btn-primary" data-dismiss="modal">
                              Revenir
                          </div>
                          <button class="btn btn-success" ng-click="update_modal(rapport)">
                              Modifier
                          </button>
                      </div>
                  </form>
      </div>
    </div>
  </div>
</div>
<div class="modal modal-fade" id="rapportmodal1" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title">Modification de la tache</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form  class="form" name="form_modal">
                  <div class="form-group">
                    <label for="name" >Nom</label>
                      <input type="text" class="form-control" disabled="true" ng-model="rapport.name">
                  </div>
                  <div class="form-group">
                        <label for="text" >Ecrire le rapport ici</label>
                        <textarea name="text" id="text" cols="100" rows="10" ng-model="rapport.rapport" class="form-control"></textarea>
                    </div>
                <hr>
                  <div class="actions">
                      <div class="btn btn-primary" data-dismiss="modal">
                          Revenir
                      </div>
                      <button class="btn btn-success" ng-click="update(rapport)">
                          Modifier
                      </button>
                  </div>
              </form>
  </div>
</div>
</div>
</div>
</div>
@endsection
