@extends ('app')

@section ('title', 'MSM Service')

@section('content')
<div class="container" ng-app="msmService">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default" ng-controller="ordersCtrl">
        <div class="panel-heading">Repairs</div>
        <div class="panel-body">
          <form method="post" ng-submit="submitOrder()" class="form-inline">
            <div class="form-group">
              <input type="text" ng-model="newOrder.tag" name="tag" class="form-control" placeholder="tag" size="3" maxlength="3" required="required" />
            </div>
            <div class="form-group">
              <input type="text" ng-model="newOrder.phone" pattern="\d*" name="phone" class="form-control" placeholder="phone number" minlength="10" required="required" />
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
            <tr ng-repeat="order in orders" ng-class="{danger: order.messages[order.messages.length-1].sender == 'Customer'}">
              <th>[[ order.tag ]]</th>
              <td>[[ order.phone ]]</td>
              <td>
                <div ng-repeat="message in order.messages"><strong>[[ message.sender ]]:</strong> [[ message.message ]]</div>
                <form method="post" ng-submit="submitMessage(order.id, newMessage.message)" class="form-inline">
                  <div class="form-group form-group-sm">
                    <textarea ng-model="newMessage.message" name="message" class="form-control" rows="3" maxlength="141"></textarea>
                  </div>
                  <div class="form-group form-group-sm">
                    <button type="submit" class="btn btn-sm btn-default">Send</button>
                  </div>
                </form>
              </td>
              <td>
                <div ng-click="deleteOrder(order.id)"type="submit" class="btn btn-sm btn-danger">Delete</div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.13/angular.min.js"></script>
<script type="text/javascript">
  var msmService = angular.module('msmService', []);

  msmService.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
  });

  msmService.controller('ordersCtrl', ['$scope', '$http', function($scope, $http){

    var refresh = function(){
      $http.get('/admin/service/orders').success(function(data){
        $scope.orders = data;
      });
    };

    refresh();

    setInterval(function(){ refresh(); }, 5000);

    $scope.submitMessage = function(id, message){
      $http.post('/admin/service/message', {id: id, message: message}).success(function(){
        refresh();
      });
    };

    $scope.submitOrder = function(){
      $http.post('/admin/service/order', $scope.newOrder).success(function(){
        $scope.newOrder = {};
        refresh();
      });
    };

    $scope.deleteOrder = function(id){
      $http.get('/admin/service/delete/' + id).success(function(){
        refresh();
      });
    };

  }]);

</script>
@endsection