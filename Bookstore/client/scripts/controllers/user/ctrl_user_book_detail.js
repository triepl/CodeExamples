/**
 * Created by Tobias-Laptop on 13.04.2017.
 */

"use strict";

bookshopApp.controller('UserBookDetailsCtrl', function ($window, $scope, $rootScope, $location, $routeParams, BookDataService) {


    var isbn = $routeParams.isbn;
    $scope.isUser = true;
    $scope.isAdmin = false;

    console.log('is admin', $scope.isAdmin);
    console.log('is user', $scope.isUser);

    BookDataService.getBookByIsbn(isbn).then(function (res) {
            $scope.book = res.data.book[0];
            $scope.showBucketAmount();
        }, function (error) {
            console.log('An error occurred!', error);
        }
    );

    BookDataService.getBookRaitingsByIsbn(isbn).then(function (res) {

            $scope.raitings = res.data.raitings;
            $scope.getAvverageRaiting($scope.raitings);
        console.log($scope.raitings);

        $scope.counter = 1;
            if ($scope.avgRaiting === null || isNaN($scope.avgRaiting)) {
                $scope.avgRaiting = 'Noch keine Bewertung vohanden!';
                $scope.hideStar = true;

            }
        }, function (error) {
            console.log('An error occurred, Raitings!', error);
        }
    );

    $scope.getAvverageRaiting = function (rat) {

        if (rat === 'undefined') {
            return '';
        }
        var sum = 0;
        for (var i = 0; i < rat.length; i++) {
            sum += rat[i].raiting;
        }
        $scope.avgRaiting = sum / rat.length;

    };

    $scope.addToBucket = function (book) {

        //Get localStorage
        var booksFromStorage = localStorage.getItem('books');
        var arrBooks = JSON.parse(booksFromStorage);
        //Add Book to array
        //check if Array is empty or exist
        if (arrBooks === null) {
            arrBooks = [];
        }

        arrBooks.push(book);
        //Add array to localStorage
        localStorage.setItem('books', JSON.stringify(arrBooks));

        if (localStorage.clickcount) {
            localStorage.clickcount = Number(localStorage.clickcount) + 1;
        } else {
            localStorage.clickcount = 1;
        }

        $scope.showBucketAmount();

    };

    $scope.addGroup = function () {

        var book1 = {
            title: "John",
            author: "Doe",
            page: 50,
            color: "blue"
        };

        var arrTest = [];
        arrTest.push(book1);
        //arrTest.push(book1);
        //arrTest.push(book1);
        //arrTest.push(book1);

        console.log(arrTest);
        localStorage.setItem('books', JSON.stringify(arrTest));

    };

    $scope.goToBucket = function () {
        $location.path('/user/bucket');
    };

    $scope.goToListView = function () {
        $location.path('/user/books');
    };

    $scope.showBucketAmount = function(){

        if(localStorage.clickcount === undefined){
            $scope.bucketAmount = 0;
        }else {
            $scope.bucketAmount =  localStorage.clickcount;
        }

    };

    $scope.newraiting = {};

    $scope.submitAction = function () {

        $scope.newraiting.book_id =  $scope.book.id;
        $scope.newraiting.user_id = $rootScope.globals.currentUser.id;

        console.log($scope.newraiting);

        BookDataService.storeRaitings($scope.newraiting).then(function (res) {
          $window.location.reload();
        }, function (error) {
            console.log('An error occurred! - Check your ISBN (must be unique!)', error);
        })

    };




});


