@extends('layouts.app')
@section('content')
<script>var id='{{ $id }}';var id1='{{ Auth::user()->id }}'</script>
  <div class="container" ng-controller="discussion">
  <h3 class=" text-center">Messaging</h3>
  <div class="messaging">
        <div class="inbox_msg col row">
          <div class="inbox_people col">
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
              <div class="chat_list active_chat" ng-repeat="am in ami">
                <div class="chat_people" ng-click="show_message(am.id)">
                  <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                  <div class="chat_ib">
                    <h5>__am.name__ <span class="chat_date">__am.creation | amDurationFormat : 'hour' __</span></h5>
                    <p>__am.messages__</p>
                  </div>
                </div>
              </div>

              {{-- <div class="md-3-line item" ng-repeat="am in ami" >
                <div class="item">
                  <div class="content">
                      <div class="header">__am.name__</div>
                      __am.email__
                      <a class="right floated compact ui button" href="/discussion/__am.id__">ecrire</a>
                    </div>
                </div>
              </div> --}}
            </div>
          </div>
          <div class="mesgs">
            <div class="msg_history">
              <div class="incoming_msg">
                <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                <div class="received_msg">
                  <div class="received_withd_msg">
                    <p>Test which is a new approach to have all
                      solutions</p>
                    <span class="time_date"> 11:01 AM    |    June 9</span></div>
                </div>
              </div>
              <div class="outgoing_msg">
                <div class="sent_msg">
                  <p>Test which is a new approach to have all
                    solutions</p>
                  <span class="time_date"> 11:01 AM    |    June 9</span> </div>
              </div>
            </div>
            <div class="type_msg">
              <div class="input_msg_write">
                 <textarea name="name" rows="2" class="write_msg"  cols="80"></textarea>
                <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div></div>
@endsection
