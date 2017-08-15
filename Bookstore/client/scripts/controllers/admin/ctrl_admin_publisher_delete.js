"use strict";

bookshopApp.controller('AdminDeletePublisherCtrl', function ($scope, $routeParams, $location, BookDataService) {
    var id = $routeParams.id;

    BookDataService.getPublisherById(id).then(function (res) {
        $scope.publisher = res.data.publisher;
    }, function (error) {
        console.log('An error occurred!', error);
    });

    $scope.deletePublisher = function (id) {
        BookDataService.deletePublisherById(id).then(function () {
            goToAdminListView();
        }, function (error) {
            console.log('An error occurred!', error);
        });

    };

    $scope.cancel = function () {
        goToAdminListView();
    };

    var goToAdminListView = function () {
        $location.path('/admin/publishers');
    };
});

