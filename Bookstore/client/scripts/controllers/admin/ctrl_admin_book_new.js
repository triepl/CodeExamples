"use strict";

bookshopApp.controller('AdminNewBookCtrl', function ($scope, $location, BookDataService) {
    $scope.book = {};
    $scope.submitBtnLabel = 'Buch anlegen';

    $scope.submitAction = function () {
        $scope.book.publisher_id = $scope.book.publisher.id;
        $scope.book.publisher = undefined;
        BookDataService.storeBook($scope.book).then(function (res) {
            goToAdminListView();
        }, function (error) {
            console.log('An error occurred! - Check your ISBN (must be unique!)', error);
        })

    };

    BookDataService.getPublishers().then(function (res) {
        $scope.publishers = res.data.publishers;
    }, function (error) {
        console.log('An error occurred!', error);
    });

    $scope.cancelAction = function () {
        goToAdminListView();
    };

    var goToAdminListView = function () {
        $location.path('/admin/books');
    };

});
