'use strict';

function editorCtrl($scope) {
  $scope.text = 'Hello World';

  $scope.opt1 = {
    toolbar: {
      fa: true
    }
  };
}

angular
  .module('app')
  .controller('editorCtrl', ['$scope', editorCtrl]);
