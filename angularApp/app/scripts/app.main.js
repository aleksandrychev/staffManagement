'use strict';

app
  .controller('AppCtrl', ['$scope', '$http', '$localStorage',
        function AppCtrl($scope, $http, $localStorage) {

      $scope.mobileView = 767;

      $scope.app = {
        name: 'Staff Management',
        author: 'Ihor Aleksandrychiev',
        version: '1.0.0',
        year: (new Date()).getFullYear(),
        layout: {
          isSmallSidebar: false,
          isChatOpen: false,
          isFixedHeader: true,
          isFixedFooter: false,
          isBoxed: false,
          isStaticSidebar: false,
          isRightSidebar: false,
          isOffscreenOpen: false,
          isConversationOpen: false,
          isQuickLaunch: false,
          sidebarTheme: '',
          headerTheme: ''
        },
        isMessageOpen: false,
        isConfigOpen: false
      };

      var user = JSON.parse(localStorage.getItem("user"));
       if(user != null)
       {
           $scope.user = {
               fname:  user.name,
               lname:  user.email,
               jobDesc: user.role,
               avatar: 'images/avatar.jpg',
           };
       }


      if (angular.isDefined($localStorage.layout)) {
        $scope.app.layout = $localStorage.layout;
      } else {
        $localStorage.layout = $scope.app.layout;
      }

      $scope.$watch('app.layout', function () {
        $localStorage.layout = $scope.app.layout;
      }, true);

      $scope.getRandomArbitrary = function () {
        return Math.round(Math.random() * 100);
      };
    }
]);
