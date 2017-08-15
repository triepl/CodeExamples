"use strict";

bookshopApp.controller('UserOrderListCtrl', function ($scope,$rootScope, $location,BookDataService) {

    $scope.userid =  $rootScope.globals.currentUser.id;

    BookDataService.getOrders($scope.userid).then(function(res){
       $scope.orders = res.data.orders;
       console.log($scope.orders);


        $scope.showBucketAmount();
    }, function(error){
        console.log('An error occurred!', error);
    });

    $scope.getOrders = function(id) {
       // return book.author;
    };

    $rootScope.showBucket = function(){
        $location.path('/user/bucket');
    };

    $scope.showBucketAmount = function(){

        if(localStorage.clickcount === undefined){
            $scope.bucketAmount = 0;
        }else {
            $scope.bucketAmount =  localStorage.clickcount;
        }

    };

    $scope.goToBookList = function(){
        $location.path('/user/books');
    };

    $scope.delete = function(isbn){
        $location.path('/admin/books/'+isbn+'/delete');
    }
});
