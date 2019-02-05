<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    <link href="{{ asset('css/site.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif
            {{-- <nav class="navbar navbar-expand-md navbar-dark bg-primary">
    <div class="container"> <a class="navbar-brand" href="#">
        <i class="fa d-inline fa-lg fa-stop-circle"></i>
        <b> BRAND</b>
      </a> <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar16">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar16">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"> <a class="nav-link" href="#">Features</a> </li>
          <li class="nav-item"> <a class="nav-link" href="#">Pricing</a> </li>
          <li class="nav-item"> <a class="nav-link" href="#">About</a> </li>
          <li class="nav-item"> <a class="nav-link" href="#">FAQ</a> </li>
        </ul> <a class="btn navbar-btn ml-md-2 btn-light text-dark">Contact us</a>
      </div>
    </div>
  </nav>
  <div class="py-5 text-center text-white h-100 align-items-center d-flex" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, .75), rgba(0, 0, 0, .75)), url(https://static.pingendo.com/cover-bubble-dark.svg);  background-position: center center, center center;  background-size: cover, cover;  background-repeat: repeat, repeat;">
    <div class="container py-5">
      <div class="row">
        <div class="mx-auto col-lg-8 col-md-10">
          <h1 class="display-3 mb-4">A wonderful serenity</h1>
          <p class="lead mb-5">Has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence.</p> <a href="#" class="btn btn-lg btn-primary mx-1">Take me there</a> <a class="btn btn-lg mx-1 btn-outline-primary" href="#">Let's Go</a>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-10">
          <h1 class="mb-3">O my friend</h1>
          <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.&nbsp; <br> <br>When, while the lovely valley teems with vapour around me, and the meridian sun strikes the upper surface of the impenetrable foliage of my trees, and but a few stray gleams steal into the inner sanctuary, I throw myself down among the tall grass by the trickling stream; and, as I lie close to the earth, a thousand unknown plants are noticed by me.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5 text-center text-white" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, .75), rgba(0, 0, 0, .75)), url(https://static.pingendo.com/cover-bubble-dark.svg);  background-position: center center, center center;  background-size: cover, cover;  background-repeat: repeat, repeat;">
    <div class="container">
      <div class="row">
        <div class="mx-auto col-md-12">
          <h1 class="mb-3">Our team</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6 p-4"> <img class="img-fluid d-block mb-3 mx-auto rounded-circle" src="https://static.pingendo.com/img-placeholder-1.svg" alt="Card image cap" width="200">
          <h4> <b>J. W. Goethe</b> </h4>
          <p class="mb-0">CEO and founder</p>
        </div>
        <div class="col-lg-4 col-md-6 p-4"> <img class="img-fluid d-block mb-3 mx-auto rounded-circle" src="https://static.pingendo.com/img-placeholder-2.svg" alt="Card image cap" width="200">
          <h4> <b>G. W. John</b> </h4>
          <p class="mb-0">Co-founder</p>
        </div>
        <div class="col-lg-4 p-4"> <img class="img-fluid d-block mb-3 mx-auto rounded-circle" src="https://static.pingendo.com/img-placeholder-3.svg" width="200">
          <h4> <b>J. G. Wolf</b> </h4>
          <p class="mb-0">Evangelist</p>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5 bg-light">
    <div class="container">
      <div class="row">
        <div class="p-5 col-md-7 d-flex flex-column justify-content-center">
          <h3 class="display-4 mb-3">Heaven and earth</h3>
          <p class="mb-4 lead">Seem to dwell in my soul and absorb its power, like the form of a beloved mistress, then I often think with longing, Oh, would I could describe these conceptions.</p>
        </div>
        <div class="p-5 col-md-5">
          <h3 class="mb-3">Reserve a spot</h3>
          <form>
            <div class="form-group"> <label>Name</label> <input class="form-control" placeholder="Type here"> </div>
            <div class="form-group"> <label>Time</label> <input type="time" class="form-control" placeholder="13"> </div>
            <div class="form-group"> <label>People</label> <input type="number" class="form-control" placeholder="2"> </div> <button type="submit" class="btn mt-4 btn-block btn-outline-dark p-2"><b>Reserve a table</b></button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="pb-5">
    <div class="container-fluid p-0"> <iframe width="100%" height="300" src="https://maps.google.com/maps?hl=en&amp;q=New%20York&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed" scrolling="no" frameborder="0"></iframe> </div>
    <div class="container">
      <div class="row">
        <div class="mx-auto p-4 col-md-6">
          <h2 class="mb-4">I feel that I never was</h2>
          <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot. <br> <br>I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.</p>
          <p class="mb-0 lead"> <a href="#">info@hello.com</a> </p>
        </div>
        <div class="mx-auto p-4 col-md-6">
          <h2 class="mb-4">A greater artist</h2>
          <form>
            <div class="form-group"> <input type="email" class="form-control" id="form31" placeholder="Email"> </div>
            <div class="form-group"> <textarea class="form-control" id="form32" rows="3" placeholder="Your message"></textarea> </div> <button type="submit" class="btn btn-primary">Send</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5" >
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <p class="lead">Sign up to our newsletter for the latest news</p>
          <form class="form-inline">
            <div class="form-group"> <input type="email" class="form-control" placeholder="Your e-mail here"> </div> <button type="submit" class="btn btn-primary ml-3">Subscribe</button>
          </form>
        </div>
        <div class="col-4 col-md-1 align-self-center"> <a href="#">
            <i class="fa fa-fw fa-facebook text-muted fa-2x"></i>
          </a> </div>
        <div class="col-4 col-md-1 align-self-center"> <a href="#">
            <i class="fa fa-fw fa-twitter text-muted fa-2x"></i>
          </a> </div>
        <div class="col-4 col-md-1 align-self-center"> <a href="#">
            <i class="fa fa-fw fa-instagram text-muted fa-2x"></i>
          </a> </div>
      </div>
      <div class="row">
        <div class="col-md-12 mt-3 text-center">
          <p>© Copyright 2018 Pingendo - All rights reserved.</p>
        </div>
      </div>
    </div>
  </div> --}}
    </body>
</html>
