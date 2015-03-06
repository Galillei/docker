(function(){
    'use strict';
    angular
        .module('app')
        .controller('NavigateController',NavigateController);
    NavigateController.$inject =['$scope', '$location','$http'];

    function NavigateController($scope,$location,$http){
        var vm = this;
        vm.isActive = activate;
        vm.loadStatus = function() {
            $http.get('install/application').success(function ($response) {
                if ($response.error === true) {
                    vm.isInstall = false;
                } else {
                    vm.isInstall = true;
                }
            })

        }

        vm.loadStatus();


        function activate(route) {
            return route === $location.path();
        }
    }

})();
