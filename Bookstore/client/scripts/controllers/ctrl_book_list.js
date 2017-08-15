/**
 * Created by Tobias-Laptop on 13.04.2017.
 */

'use strict';

bookshopApp.controller('BookListCtrl', function ($cookieStore,$rootScope,$scope,$location,BookDataService){

    $rootScope.test = "Test";
    $scope.isUser = false;
    $cookieStore.put('test', 'session test');


    BookDataService.getBooks().then(function(res) {
        $scope.books = res.data.books;
        $scope.showBucketAmount();
    }, function(error) {
        console.log('An error occurred!', error);
    });


    $rootScope.showBucket = function(){
        $location.path('/bucket');
    };

    $scope.showBucketAmount = function(){

        if(localStorage.clickcount === undefined){
            $scope.bucketAmount = 0;
        }else {
            $scope.bucketAmount =  localStorage.clickcount;
        }

    };
});