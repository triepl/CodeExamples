"use strict";

bookshopApp.controller('UserBookListCtrl', function ($scope, $rootScope, $location,BookDataService) {

    BookDataService.getBooks().then(function(res) {
        $scope.books = res.data.books;
        $scope.showBucketAmount();
    }, function(error) {
        console.log('An error occurred!', error);
    });

    $rootScope.showBucketUser = function(){
        $location.path('/user/bucket');
    };

    $scope.showBucketAmount = function(){

        if(localStorage.clickcount === undefined){
            $scope.bucketAmount = 0;
        }else {
            $scope.bucketAmount =  localStorage.clickcount;
        }

    };

    $scope.isAdmin = false;
    $scope.isUser = true;

    console.log('isadmin', $scope.isAdmin, 'isuser', $scope.isUser);


    $scope.loggedIn = true;

    $scope.userid =  $rootScope.globals.currentUser.id;


    $scope.goToOrderList = function(id){
        $location.path('/user/orderlist');
    };


});
