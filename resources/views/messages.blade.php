@extends('layouts.app')
@section('content')
<script>var id='{{ $id }}';var id1='{{ Auth::user()->id }}'</script>
  <div class="container" ng-controller="discussion" ng-init="id1='{{ Auth::user()->id }}'">
  <h3 class=" text-center">Messaging</h3>
   <div class="">
     <button type="button" class="btn btn-primary float-right" ng-click="new_conversation()">New Conversation</button>
   </div>
  <div class="messaging">
        <div class="inbox_msg col row p-0">
          <div class="inbox_people col p-0">
            <div class="headind_srch row">
              <div class="recent_heading col">
                <h4>Recent</h4>
              </div>
              <div class="srch_bar">
                <div class="stylish-input-group">
                  <input type="text" class="search-bar"  placeholder="Search" >
                  <span class="input-group-addon">
                  <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                  </span> </div>
              </div>
            </div>
            <div class="inbox_chat">
              <div ng-bind="">
              </div>
              <div ng-repeat="am in dernier_message">
              <div class="chat_list " ng-class="{active_chat : am.conversation_id==active_chats  }" >
                <div class="chat_people" ng-click="show_message(am.conversation_id)">
                  <a href="#!messages/__am.conversation_id__">
                  <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                  <div class="chat_ib">
                    <h5>__am.users2[0].name __ <span class="chat_date">__am.message.created_at __</span></h5>
                    <p>__am.message.body__</p> <small>Envoyer par <span ng-if="am.message.sender.id=='{{ Auth::user()->id }}'">vous</span>
                      <span ng-if="am.message.sender.id!='{{ Auth::user()->id }}'">__am.message.sender.name__</span></small>
                  </div>
                  </a>
                </div>
              </div>
              </div>

            </div>
          </div>
            <div ng-view class="">

            </div>
        </div>
      </div>
      {{-- work on dev modal --}}

            <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Nouvelle conversation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="card card-header">
                Creer une nouvelle conversation
              </div>
              <form>
                <div class="form-group">
                  <label for="sel">Selectionne une personne pour commencer la conversation</label>
                <select class="form-control" name="">
                  <option value="" ng-repeat="conv in user_conversation" ng-hide="conv.id==id1">__conv__</option>
                </select>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
{{-- fin modal --}}
    </div>

@endsection
