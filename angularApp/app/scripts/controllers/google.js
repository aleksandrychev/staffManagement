'use strict';

function mapCtrl($scope, apiClient) {

  var isInternetExplorer11 = navigator.userAgent.toLowerCase().indexOf('trident') > -1;
  var markerUrl = (isInternetExplorer11) ? 'img/cd-icon-location.png' : 'img/cd-icon-location.svg';

  $scope.myMarkers = [];

  $scope.mapOptions = {
    scrollwheel: false,
    center: new google.maps.LatLng(35.784, -78.670),
    zoom: 15,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
  };

  $scope.addMarker = function ($event, $params) {
    $scope.myMarkers.push(new google.maps.Marker({
      map: $scope.myMap,
      position: $params[0].latLng,
      icon: markerUrl
    }));
  };

  $scope.buildPolyLine = function () {
      var map = new google.maps.Map(document.getElementById('google-container'), {
          zoom: 3,
          center: {lat: 0, lng: -180},
          mapTypeId: google.maps.MapTypeId.TERRAIN
      });

      var locationsPromise = apiClient.getLocations();
      locationsPromise.then(function (response) {
       console.log(response.data);
      });

      var flightPlanCoordinates = [
          {lat: 37.772, lng: -122.214},
          {lat: 21.291, lng: -157.821},
          {lat: -18.142, lng: 178.431},
          {lat: -27.467, lng: 153.027}
      ];
      var flightPath = new google.maps.Polyline({
          path: flightPlanCoordinates,
          geodesic: true,
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 2
      });

      flightPath.setMap(map);
  }

  $scope.setZoomMessage = function (zoom) {
    $scope.zoomMessage = 'You just zoomed to ' + zoom + '!';
    console.log(zoom, 'zoomed');
  };

  $scope.openMarkerInfo = function (marker) {
    $scope.currentMarker = marker;
    $scope.currentMarkerLat = marker.getPosition().lat();
    $scope.currentMarkerLng = marker.getPosition().lng();
    $scope.myInfoWindow.open($scope.myMap, marker);
  };

  $scope.setMarkerPosition = function (marker, lat, lng) {
    marker.setPosition(new google.maps.LatLng(lat, lng));
  };
}

angular
  .module('app')
  .controller('mapCtrl', ['$scope' , 'apiClient', mapCtrl]);
