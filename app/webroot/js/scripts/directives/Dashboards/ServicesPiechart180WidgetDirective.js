angular.module('openITCOCKPIT').directive('servicesPiechart180Widget', function($http){
    return {
        restrict: 'E',
        templateUrl: '/dashboards/servicesPiechart180Widget.html',
        scope: {},

        controller: function($scope){

            $scope.load = function(){
                $http.get("/angular/statuscount.json", {
                    params: {
                        'angular': true,
                        'recursive': true
                    }
                }).then(function(result){
                    $scope.servicestatusCount = result.data.servicestatusCount;
                    $scope.servicestatusCountPercentage = result.data.servicestatusCountPercentage;
                    $scope.init = false;
                });
            };

            $scope.load();

        },

        link: function($scope, element, attr){

        }
    };
});
