'use strict';

function tasksCtrl($scope, $state, apiClient) {

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

function taskAddCtrl($scope, $state, apiClient, $mdToast) {
  $scope.errors = false;
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
      $scope.errors = false;
      $mdToast.show(
        $mdToast.simple()
          .textContent('Task successfully created')
          .position('top right')
          .hideDelay(3000)
          .theme("success-toast")
      );
      $state.go('app.editTask', {"id": response.id});
    }, function (errors) {
      $scope.errors = errors;
      console.log( $scope.errors);
    });

  };

}

function taskEditCtrl($scope, $stateParams, apiClient, $mdToast) {
  var taskPromise = apiClient.getTask($stateParams.id);
  taskPromise.then(function (response) {
    $scope.task = response;
  });

  $scope.submit = function () {
    var taskEditPromise = apiClient.editTask($stateParams.id, $scope.task);
    taskEditPromise.then(
      function (response) {
        $scope.errors = false;
        $mdToast.show(
          $mdToast.simple()
            .textContent('Task successfully saved')
            .position('top right')
            .hideDelay(3000)
            .theme("success-toast")
        );
    },
      function (errors) {
        console.log($scope.errors);
        $scope.errors = errors;
    });
  };

  $scope.closeToast = function() {
    $mdToast.hide();
  };


}

angular
  .module('app')
  .controller('tasksCtrl', ['$scope', '$state', 'apiClient', tasksCtrl]);
angular
  .module('app')
  .controller('taskAddCtrl', ['$scope', '$state', 'apiClient', '$mdToast', taskAddCtrl]);
angular
  .module('app')
  .controller('taskEditCtrl', ['$scope', '$stateParams', 'apiClient', '$mdToast', taskEditCtrl]);
