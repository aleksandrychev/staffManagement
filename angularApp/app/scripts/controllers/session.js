'use strict';

function sessionCtrl($scope, $state, $http) {
  $scope.signin = function () {
    $state.go('user.signin');
  };
  $scope.submit = function () {
    $http.post(CONFIG["apiUrl"] + 'auth/login', {"email" : $scope.email, "password": $scope.password}, {}).success(function (data, status, headers, config) {
      localStorage.setItem("apiToken", data.data.api_token);
      localStorage.setItem("user", JSON.stringify(data.data));
      $state.go('app.dashboard');
    })
      .error(function (data, status, header, config) {

      });
  };
}

angular
  .module('app')
  .controller('sessionCtrl', ['$scope', '$state', '$http', sessionCtrl]);
