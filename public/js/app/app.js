angular
      .module('app',['ngRoute'])
      .config(config);

function config($routeProvider){
    $routeProvider
        .when('/', { controller: 'StartController', templateUrl: 'public/templates/start.html', controllerAs:'vm' })
        .when('/install', { controller: 'InstallController', templateUrl: 'public/templates/install.html', controllerAs:'ic' })
        .when('/application',{controller:'ApplicationController', templateUrl:'public/templates/application.html', controllerAs:'ap'})
        .otherwise({redirect: '/'});
}