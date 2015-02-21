@extends ('app')

@section ('title', 'MSM Service')

@section('content')
<div class="container" ng-app="msmService" ng-controller="ordersCtrl">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Repairs</div>
        <div class="panel-body">
          <form method="post" ng-submit="submitOrder()" class="form-inline">
            <div class="form-group">
              <input type="text" ng-model="newOrder.tag" name="tag" class="form-control" placeholder="ref #" size="5" maxlength="10" required="required" />
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
              <th>Reference #</th>
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
                <button ng-click="openModal(order.id)" class="btn btn-primary btn-xs">Message</button>
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
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Write Message</h4>
        </div>
        <div class="modal-body">
          <form method="post" ng-submit="submitMessage()" class="form">
            <div class="form-group">
              <textarea ng-model="message" name="message" class="form-control" rows="3" maxlength="141"></textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-sm btn-primary">Send</button>
            </div>
          </form>
        </div>
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

    $scope.openModal = function(id) {
      $scope.id = id;
      $('#myModal').modal();
    };

    var refresh = function(){
      $http.get('/admin/service/orders').success(function(data){
        $scope.orders = data;
      });
    };

    refresh();

    setInterval(function(){ refresh(); }, 5000);

    $scope.submitMessage = function(){
      $http.post('/admin/service/message', {id: $scope.id, message: $scope.message}).success(function(){
        $scope.message = '';
        $('#myModal').modal('hide');
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