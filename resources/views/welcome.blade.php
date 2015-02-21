@extends ('app')

@section ('title', 'Main Street Mower')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-xs-12 text-center">
        <img src="http://mainstreetmower.com/logo.png" class="img-responsive" />
        <hr/>
        <h2>Welcome, what brings You here today?</h2>
        <hr/>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-3 col-xs-6">
        <div class="thumbnail text-center">
          <img src="https://s3.amazonaws.com/msmstatic/logos/logo-toro.png" class="img-responsive" />
          Equipment
        </div>
      </div>
      <div class="col-sm-3 col-xs-6">
        <div class="thumbnail text-center">
          <img src="https://s3.amazonaws.com/msmstatic/logos/logo-toro.png" class="img-responsive" />
          Parts
        </div>
      </div>
      <div class="col-sm-3 col-xs-6">
        <div class="thumbnail text-center">
          <img src="https://s3.amazonaws.com/msmstatic/logos/logo-toro.png" class="img-responsive" />
          Knowledge
        </div>
      </div>
      <div class="col-sm-3 col-xs-6">
        <div class="thumbnail text-center">
          <img src="https://s3.amazonaws.com/msmstatic/logos/logo-toro.png" class="img-responsive" />
          Info
        </div>
      </div>
    </div>
  </div>

@endsection