"use strict";

bookshopApp.controller('UserBucketCtrl', function ($scope, $rootScope, $location, $routeParams, BookDataService) {


    console.log('show bucket');
    $scope.isUser = true;
    $scope.init = function () {
        //getBucketAmount
        $scope.showBucketAmount();
        //get books from local storage
        var booksFromStorage = localStorage.getItem('books');

        var arrBooks = JSON.parse(booksFromStorage);
        if (arrBooks === null) {
            $scope.noBooks = true;
        } else {
            $scope.books = $scope.checkBooks(arrBooks);
            $scope.getTotal();
        }
    };


    $scope.checkBooks = function (arrBooks) {

        var retArr = [];
        for (var i = 0; i < arrBooks.length; i++) {
            var tempObj = arrBooks[i];
            var check = false;
            tempObj.amount = 1;
            if (retArr.length > 0) {
                for (var j = 0; j < retArr.length; j++) {
                    if (tempObj.isbn === retArr[j].isbn) {
                        retArr[j].amount++;
                        check = true;
                    }
                }
                if (!check) {
                    retArr.push(tempObj);
                }
            } else {
                retArr.push(tempObj);
            }

        }
        return retArr;

    };


    $scope.goToListView = function () {
        $location.path('/user/books');
    };

    $scope.deleteBucket = function () {
        localStorage.clear();
        $scope.init();
    };

    $scope.deleteItem = function (isbn) {
        var booksFromStorage = localStorage.getItem('books');
        var arrBooks = JSON.parse(booksFromStorage);
        var arrReturn = [];
        for (var i = 0; i < arrBooks.length; i++) {
            var tempObj = arrBooks[i];
            if (tempObj.isbn !== isbn) {
                arrReturn.push(tempObj);
            } else {
                localStorage.clickcount = Number(localStorage.clickcount) - 1;
            }
        }
        localStorage.setItem('books', JSON.stringify(arrReturn));
        $scope.init();

    };

    $scope.getTotal = function () {
        var total = 0;
        for (var i = 0; i < $scope.books.length; i++) {
            var product = $scope.books[i];
            total += (product.prize * product.amount);
        }
        return total;
    };

    $scope.showBucketAmount = function () {

        if (localStorage.clickcount === undefined) {
            $scope.bucketAmount = 0;
        } else {
            $scope.bucketAmount = localStorage.clickcount;
        }

    };

    $scope.goToOrderList = function () {
        $location.path('/user/orderlist');
    };

    $scope.increaseAmount = function(book){
        var booksFromStorage = localStorage.getItem('books');
        var arrBooks = JSON.parse(booksFromStorage);

        arrBooks.push(book);
        //Add array to localStorage
        localStorage.setItem('books', JSON.stringify(arrBooks));
        if (localStorage.clickcount) {
            localStorage.clickcount = Number(localStorage.clickcount) + 1;
        } else {
            localStorage.clickcount = 1;
        }
        $scope.init();

    };

    $scope.decreaseAmount = function(book){
        var booksFromStorage = localStorage.getItem('books');
        var arrBooks = JSON.parse(booksFromStorage);
        var newBooks = [];
        var dec = false;
        for(var i = 0; i < arrBooks.length; i++){
            if(!dec){
                if(arrBooks[i].id === book.id){
                    dec = true;
                }
                else {
                    newBooks.push(arrBooks[i]);
                }
            } else {
                newBooks.push(arrBooks[i]);
            }
        }

        localStorage.setItem('books', JSON.stringify(newBooks));
        if (localStorage.clickcount) {
            localStorage.clickcount = Number(localStorage.clickcount) - 1;
        }
        $scope.init();
    };


    $scope.buyNow = function () {
        var total = $scope.getTotal();
        var netto = (total / 110) * 100;
        var ust = 10;

        var user = $rootScope.globals.currentUser.id;

        var orderObj = {
            user_id: user,
            prize_brutto: total,
            prize_netto: netto,
            vat: ust
        };

        console.log('buy now', orderObj);


        BookDataService.storeNewOrder(orderObj).then(function (res) {

            BookDataService.getLastId().then(function (res) {
                $scope.orderid = res.data.orders.id;

                //Save items;
                console.log('books to save', $scope.books);

                for (var i = 0; i < $scope.books.length; i++) {

                    var curbook = $scope.books[i];
                    var savebook = {};
                    savebook.order_id = $scope.orderid;
                    savebook.book_id = curbook.id;
                    savebook.amount = curbook.amount;
                    savebook.item_price = curbook.prize;

                    console.log('book obj to save', savebook);
                   //SAVE ITMES

                    BookDataService.storeOrderItems(savebook).then(function (res) {
                        console.log('show save result', res);
                        return true;
                    }, function (error) {
                        console.log('an error occured', error);
                    });

                }

                //empty bucket
                $scope.deleteBucket();
                //go to order list
                $location.path('/user/orderlist');

            }, function (error) {
                console.log('an error occurred', error);
            });


        }, function (error) {
            console.log('An error occurred!)', error);
        });


    };


});


