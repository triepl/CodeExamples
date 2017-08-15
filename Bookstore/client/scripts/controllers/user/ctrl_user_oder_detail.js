"use strict";

bookshopApp.controller('UserOrderLisDetailCtrl', function ($scope, $routeParams, $location, BookDataService) {
    var id = $routeParams.id;

    BookDataService.getOrderItemsById(id).then(function (res) {
        $scope.items = res.data.items;
        console.log($scope.items);
        $scope.getTotal($scope.items);
        $scope.showBucketAmount();

    }, function (error) {
        console.log('An error occurred!', error);
    });

    $scope.getTotal = function(items){
       console.log('into total', items);
        if(items !== undefined){
            var total = 0;
            for(var i = 0; i < items.length; i++){
                total +=  items[i].item_price * items[i].amount;
            }
            $scope.total = total;
            $scope.ust = (total/110)*10;
            $scope.netto = (total/110)*100;
        }
         //item.item_price
    };

    $scope.showBucketAmount = function () {

        if (localStorage.clickcount === undefined) {
            $scope.bucketAmount = 0;
        } else {
            $scope.bucketAmount = localStorage.clickcount;
        }

    };

    $scope.goToUserOrderListView = function () {
        $location.path('/user/orderlist');
    };

    $scope.goToListView = function(){
        $location.path('/user/books');
    };




});
