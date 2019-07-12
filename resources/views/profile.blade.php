@extends('layouts.app')
@section('content')
  <div class="container pt-4">
        <div class="row">
        <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
             <a href="edit.html" >Edit Profile</a>

          <a href="" >Logout</a>
         <br>
         <p class=" text-info">{{ $data->updated_at}} </p>
        </div>
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >


            <div class="panel panel-info">
              <div class="panel-heading">
                <h3 class="panel-title">{{ $data->name}}</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{ $data->img}}" class="img-circle img-responsive"> </div>
                  <div class=" col-md-9 col-lg-9 ">
                    <table class="table table-user-information">
                      <tbody>
                        <tr>
                          <td>Department:</td>
                          <td>{{$data->postes->libelle}}</td>
                        </tr>
                        <tr>
                          <td>Email</td>
                          <td><a href="mailto:{{$data->email}}">{{$data->email}}</a></td>
                        </tr>
                          <td>Phone Number</td>
                          <td>A venir
                          </td>

                        </tr>

                      </tbody>
                    </table>

                    <a href="#" class="btn btn-primary">Rapport Total</a>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
@endsection
