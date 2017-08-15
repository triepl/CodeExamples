"use strict";

bookshopApp.controller('AdminEditBookCtrl', function ($scope, $routeParams, $location, BookDataService) {
    $scope.isEditMode = true;
    $scope.submitBtnLabel = 'Änderungen speichern';
    //$scope.selectedItem = null;

    var isbn = $routeParams.isbn;
    BookDataService.getBookByIsbn(isbn).then(function(res) {
        $scope.book = res.data.book[0];
    }, function(error) {
        console.log('An error occurred!', error);
    });

    BookDataService.getPublishers().then(function(res) {
        $scope.publishers = res.data.publishers;
    }, function(error) {
        console.log('An error occurred!', error);
    });

    $scope.submitAction = function() {
        //console.log($scope.selectedItem);
        //$scope.book.publisher_id=$scope.selectedItem
        $scope.book.publisher_id = $scope.book.publisher.id;
        BookDataService.updateBook($scope.book).then(function (response,status, headers) {
            console.log(response.data);
            goToAdminListView();
        }, function (error) {
            console.log('An error occurred!', error);
        })

    };

    $scope.cancelAction = function() {
        goToAdminListView();
    };

    var goToAdminListView = function() {
        $location.path('/admin/books');
    };

    /*$scope.goToListView = function() {
     $location.path('/admin/books');
     };*/
});
