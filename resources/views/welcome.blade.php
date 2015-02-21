@extends ('app')

@section ('title', 'Main Street Mower')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 text-center">
        <img src="http://mainstreetmower.com/logo.png" class="img-responsive" />
      </div>
    </div>
    <hr/>
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h2>Our Annual Spring Sale is Coming Soon.</h2>
        <span class="lead">Don't Miss Out... Get an invite & all the details.</span>
      </div>
    </div>
    <hr/>
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <form class="form-inline">
          <div class="form-group-lg">
            <input style="margin-bottom: 10px;" type="text" class="form-control" placeholder="phone number" />
            <button class="btn-lg btn-success form-control" style="margin-bottom: 10px;">Submit</button>
          </div>
        </form>
        <br/>
        <i>* Please excuse our lack of a fancy-pants webpage.  Drop us your number and we'll text you the details just before the sale date.  Expect the best prices of the year on the best equipment money can buy.</i>
      </div>
    </div>
  </div>

@endsection