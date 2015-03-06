(function(){
    'use strict';
    angular
        .module('app')
        .controller('InstallController',InstallController);
    InstallController.$inject = ['$scope','$http'];
    function InstallController($scope,$http){
        var ic = this;
        $http.get('/install').success(function($data){
            if($data.error !== 'undefined'){
                ic.errors = $data.error;
            }
            if($data.install){
                ic.install=$data.install;
            }
            ic.can_install = $data.can_install === true ? true : false;
        });
        ic.installAp = function(){
            $http.get('/install/')
        }
        }

})();
