@extends ('app')

@section ('title', 'MSM Service')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Repairs</div>
        <div class="panel-body">
          <form method="post" action="/admin/service/order" class="form-inline">
            <div class="form-group">
              <input type="text" name="tag" class="form-control" placeholder="tag id" size="4" />
            </div>
            <div class="form-group">
              <input type="text" name="phone" class="form-control" placeholder="phone number" />
            </div>
            <div class="form-group">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-default">Add</button>
            </div>
          </form>
        </div>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Tag #</th>
              <th>Phone #</th>
              <th>Messages</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orders as $order)
              <tr>
                <th>1</th>
                <td>{{ $order->phone }}</td>
                <td>
                  @foreach ($order->messages as $message)
                    <div><strong>{{ $message->sender }}:</strong> {{ $message->message }}</div>
                  @endforeach
                  <form method="post" action="/admin/service/message/{{ $order->id }}" class="form-inline">
                    <div class="form-group form-group-sm">
                      <input type="text" name="message" class="form-control" maxlength="140" />
                    </div>
                    <div class="form-group form-group-sm">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <button type="submit" class="btn btn-sm btn-default">Send</button>
                    </div>
                  </form>
                </td>
                <td>
                  <a href="/admin/service/delete/{{ $order->id }}" type="submit" class="btn btn-sm btn-danger">Delete</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection