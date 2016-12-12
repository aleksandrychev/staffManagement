'use strict';

function sessionCtrl($scope, $state, $http, $log) {
  $scope.signin = function () {
    $state.go('user.signin');
  };
  $scope.submit = function () {
    $http.post('http://sm.loc/api/v1/auth/login', {"email" : $scope.email, "password": $scope.password}, {}).success(function (data, status, headers, config) {
      $state.go('app.dashboard');
    })
      .error(function (data, status, header, config) {

      });
  };
}

app.controller('sessionCtrl', ['$scope', '$state', '$http', '$log', sessionCtrl]);
