"use strict";

bookshopApp.controller('AdminBookListCtrl', function ($scope,$location,BookDataService) {
    BookDataService.getBooks().then(function(res) {
        $scope.books = res.data.books;
    }, function(error) {
        console.log('An error occurred!', error);
    });

    $scope.getBookOrder = function(book) {
        return book.author;
    };

   $scope.isAdmin = true;

    console.log('is admin in ctrl admin book list', $scope.isAdmin);

    $scope.delete = function(isbn){
        $location.path('/admin/books/'+isbn+'/delete');
    }
});
