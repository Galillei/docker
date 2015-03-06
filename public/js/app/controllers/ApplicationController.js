(function(){
    'use strict';
    angular
        .module('app')
        .controller('ApplicationController',ApplicationController);
    ApplicationController.$inject = ['$scope','$http','$timeout'];
    function ApplicationController($scope,$http,$timeout) {
        var ap = this;
        ap.notChoosenCountry = true;
        ap.notChoosenRegion = true;
        $http.get('/application/countries').success(function($data){
           ap.countries = $data;
            console.log($data);
        });
        var selectRegion = $scope;
        ap.fetchRegions = fetchRegions;
        ap.fetchCity = fetchCity;
        function fetchCity($city)
        {
            if($city){
                $http.get('/application/cities/'+$city.id).success(function($data){
                    console.log($data);
                    ap.cities = $data;
                    ap.notChoosenRegion  = false;
                });

            }else{
                ap.cities = null;
                ap.notChoosenRegion = true;
                return;
            }
        }

        function fetchRegions($country) {
            if ($country) {

                $http.get('/application/regions/' + $country.id).success(
                    function ($data) {
                        console.log($data);
                        ap.regions = $data;
                        ap.notChoosenCountry = false;
                    }
                );
            }else{
                ap.notChoosenCountry = true;
                ap.notChoosenRegion = true;
                ap.regions = null;
                ap.fetchCity(null);

                return;
        }
        }
    }
})();
