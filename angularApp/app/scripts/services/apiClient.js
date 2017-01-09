'use strict';

function restApiCalls($q, $http) {
  var apiMethods = {};
  var apiUrl = CONFIG.apiUrl;

  apiMethods.getTasks = function (page, sort, sortMethod) {
    var deferred = $q.defer();
    $http.get(apiUrl + 'task?page=' + page + "&orderBy=" + sort + "&orderType=" + sortMethod, {headers: {'Authorization': 'Bearer ' + localStorage.getItem("apiToken")}})
      .success(function (data) {
        deferred.resolve(data.data);
      })
      .error(function (data) {
        deferred.reject(data.data);
      });
    return deferred.promise;
  };

  apiMethods.getTask = function (id) {
    var deferred = $q.defer();
    $http.get(apiUrl + 'task/' + id, {headers: {'Authorization': 'Bearer ' + localStorage.getItem("apiToken")}})
      .success(function (data) {
        deferred.resolve(data.data);
      })
      .error(function (data) {
        deferred.reject(data.data);
      });
    return deferred.promise;
  };

  apiMethods.createTask = function (taskData) {

    var deferred = $q.defer();
    $http.post(CONFIG["apiUrl"] + 'task', taskData, {
      headers: {'Authorization': 'Bearer ' + localStorage.getItem("apiToken")}
    }).success(function (data, status, headers, config) {
      deferred.resolve(data.data);
    })
      .error(function (data, status, header, config) {
        deferred.reject(data.data);
      });
    return deferred.promise;
  };

  apiMethods.editTask = function (id, taskData) {

    var deferred = $q.defer();
    $http.put(CONFIG["apiUrl"] + 'task/' + id, taskData, {
      headers: {'Authorization': 'Bearer ' + localStorage.getItem("apiToken")}
    }).success(function (data, status, headers, config) {
      deferred.resolve(data.data);
    })
      .error(function (data, status, header, config) {
        deferred.reject(data.data);
      });
      return deferred.promise;
  };

  return apiMethods;
}

angular
  .module('app')
  .factory('apiClient', ['$q', '$http', restApiCalls]);
