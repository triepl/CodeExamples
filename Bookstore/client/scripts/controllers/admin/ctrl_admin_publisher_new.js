"use strict";

bookshopApp.controller('AdminNewPublisherCtrl', function ($scope, $location, BookDataService) {
    $scope.publisher = {};
    $scope.submitBtnLabel = 'Verlag anlegen';

    $scope.submitAction = function() {
        BookDataService.storePublisher($scope.publisher).then(function(res){
            goToAdminListView();
        }, function(error){
            console.log('An error occurred!)', error);
        })

    };

    $scope.cancelAction = function() {
        goToAdminListView();
    };

    var goToAdminListView = function() {
        $location.path('/admin/publishers');
    };

});
