@extends('layouts.app')
@section('content')
  @if (session('status'))
      <div class="alert alert-success" role="alert">
          {{ session('status') }}
      </div>
  @endif
<div class="container" ng-controller="todo">
    <div class="row justify-content-center">
        <div class="col-md-12 shadow-lg">
            <div class="card ">
                <div class="card-header">Emploi du temps de ce {{now()->format("Y/m/d")}}
                   <a href="{{route("rapport")}}" class="float-right">Rapport</a>
                </div>

                <div class="card-body" id="scrol">
                  <div class="p-1" ng-repeat="to in todo" >
                            <div class="h p-1">
                                <span>__to.name__</span>
                                <div class="float-right">
                                    <button class="btn btn-success" ng-click="edit(to)"><i class="">edit</i></button>
                                    <button class="btn btn-danger" ng-click="delete(to)"><i class="fa fa-home">delete</i></button>
                                </div>
                            </div>
                        </div>
                        <div class="item" ng-if="todo.length<=0">
                            <div class="content">
                                Il ny a rien de programmer pour le moment pour ce jour
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                  <form class="form-inline m-0 p-0" ng-submit="submit(todos)" name="form" novalidate>
                          <div class="form-group col ">
                              <input type="text" ng-model="todos.name" name="name" class="form-control col"  required>
                              <div class="invalid-feedback" ng-show="form.$submitted && form.name.$touched">
                                  <div class="invalid-feedback" ng-show="form.name.$error.required">
                                      <span>Ce champs est requis</span>
                                  </div>
                              </div>
                              <button class="btn btn-primary" type="submit">Ajouter</button>
                          </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="mymodal" tabindex="-1" role="dialog">
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
                          <label for="name">Name</label>
                          <input type="text" ng-model="modal.name" class="form-control">
                      </div>
                    <hr>
                      <div class="actions">
                          <div class="btn btn-primary" data-dismiss="modal">
                              Revenir
                          </div>
                          <button class="btn btn-success" ng-click="update_modal(modal)">
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
