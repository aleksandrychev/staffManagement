'use strict';

function tasksCtrl($scope, $http, $log, $state) {
  $http.get('http://sm.loc/api/v1/task', {
    headers: {'Authorization': 'Bearer jMgY2zzQYtlRZot4n0Xife0ZV23QzVbgIzpZAuQkYRuXS4Bzw7XrlLgaaXUP'}
  }).success(function (data, status, headers, config) {
    $log.log(data.data.data);
    $scope.tasks = data.data.data;

    $scope.dataTableOpt = data.data;
  })
    .error(function (data, status, header, config) {

    });

  $scope.addTask = function () {
    $state.go('app.addTask');
  }
}

function tasksAddCtrl($scope, $http, $log) {


  $scope.submit = function () {
    var taskData = {
      "name": $scope.name,
      "description": $scope.description,
      "implementer_id": $scope.implementer_id,
      "status": $scope.status,
      "user_id": 2,
      "account_id": 1
    };

    $http.post('http://sm.loc/api/v1/task', taskData, {
      headers: {'Authorization': 'Bearer kUVVN5X89Apnzu5sy0Xq6YinfEUhzIA3jPEW1R6MqGOlwrtw6V1GaAepmV0t'}
    }).success(function (data, status, headers, config) {
      $log.log(data.data.data);
      $scope.task = data.data.data;

      $scope.dataTableOpt = data.data;
    })
      .error(function (data, status, header, config) {

      });
  };

}

app.controller('tasksCtrl', ['$scope', '$http', '$log', '$state', tasksCtrl]);
app.controller('tasksAddCtrl', ['$scope', '$http', '$log', tasksAddCtrl]);
