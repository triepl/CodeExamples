"use strict";

bookshopApp.controller('PublisherListCtrl', function ($scope,BookDataService, $location) {

    BookDataService.getPublishers().then(function(res) {
        $scope.publishers = res.data.publishers;
    }, function(error) {
        console.log('An error occurred!', error);
    });

    $scope.delete = function (id) {
        $location.path('/admin/publishers/' + id + '/delete');
    }


});
