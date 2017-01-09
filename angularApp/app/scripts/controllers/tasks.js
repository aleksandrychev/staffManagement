'use strict';

function tasksCtrl($scope, $log, $state, apiClient) {

  $scope.currentPage = 1;
  $scope.numPerPage = 10;
  $scope.maxSize = 5;
  $scope.sortType = 'id';
  $scope.sortReverse = false;


  $scope.$watch("currentPage + numPerPage + sortType + sortReverse", function () {
    var tasksPromise = apiClient.getTasks($scope.currentPage, $scope.sortType, $scope.sortReverse ? 'desc' : 'asc');
    tasksPromise.then(function (response) {
      $scope.tasks = response.data;
      $scope.totalItems = response.total;
    });
  });
  $scope.addTask = function () {
    $state.go('app.addTask');
  }

  $scope.editTask = function (id) {
    $state.go('app.editTask', {"id": id});
  }

}

function taskAddCtrl($scope, $state, apiClient) {

  $scope.submit = function () {
    var taskData = {
      "name": $scope.name,
      "description": $scope.description,
      "implementer_id": $scope.implementer_id,
      "status": $scope.status,
      "user_id": 2,
      "account_id": 1
    };

    var tasksCreatePromise = apiClient.createTask(taskData);
    tasksCreatePromise.then(function (response) {
      $scope.task = response.data;
      // $state.go('app.editTask', {"id": response.id});
    });

  };

}

function taskEditCtrl($scope, $stateParams, apiClient) {

  var taskPromise = apiClient.getTask($stateParams.id);
  taskPromise.then(function (response) {
    $scope.task = response;


    // $scope.id = response.data.id;
    // $scope.description = response.data.description;
    // $scope.implementer_id = response.data.implementer_id;
    // $scope.status = response.data.status;
  });


  $scope.submit = function () {


    var taskEditPromise = apiClient.editTask($stateParams.id, $scope.task);
    taskPromise.then(function (response) {


    });

  };


}

app.controller('tasksCtrl', ['$scope', '$http', '$log', '$state', tasksCtrl]);
app.controller('taskAddCtrl', ['$scope', '$http', '$log', taskAddCtrl]);
app.controller('taskEditCtrl', ['$scope', '$http', '$stateParams', '$log', taskEditCtrl]);
