var bookshopApp = angular.module('bookshop', ['ngRoute', 'ngCookies', 'ngAnimate']);


bookshopApp.config(function ($routeProvider, $httpProvider) {
    $routeProvider.when('/books/:isbn', {
            templateUrl: 'templates/tmp_book_details.html',
            controller: 'BookDetailsCtrl'
        })
        .when('/books', {
            templateUrl: 'templates/tmp_book_list.html',
            controller: 'BookListCtrl'
        })
        .when('/admin/books', {
            templateUrl: 'templates/tmp_book_list.html',
            controller: 'AdminBookListCtrl'
        })
        .when('/admin/books/new', {
            templateUrl: 'templates/admin/tmp_book_form.html',
            controller: 'AdminNewBookCtrl'
        })
        .when('/admin/books/:isbn/edit', {
            templateUrl: 'templates/admin/tmp_book_form.html',
            controller: 'AdminEditBookCtrl'
        })
        .when('/admin/books/:isbn/delete', {
            templateUrl: 'templates/admin/tmp_book_delete.html',
            controller: 'AdminDeleteBookCtrl'
        })
        .when('/admin/publishers', {
            templateUrl: 'templates/admin/tmp_publisher_list.html',
            controller: 'PublisherListCtrl'
        })
        .when('/admin/publishers/new', {
            templateUrl: 'templates/admin/tmp_publisher_form.html',
            controller: 'AdminNewPublisherCtrl'
        })
        .when('/admin/publishers/:id/edit', {
            templateUrl: 'templates/admin/tmp_publisher_form.html',
            controller: 'PublisherEditCtrl'
        })
        .when('/admin/publishers/:id/delete', {
            templateUrl: 'templates/admin/tmp_publisher_delete.html',
            controller: 'AdminDeletePublisherCtrl'
        })
        .when('/bucket', {
            templateUrl: 'templates/tmp_local_bucket.html',
            controller: 'LocalBucketCtrl'
        })
        .when('/user/bucket', {
            templateUrl: 'templates/tmp_local_bucket.html',
            controller: 'UserBucketCtrl'
        })
        .when('/user/books',{
            templateUrl: 'templates/tmp_book_list.html',
            controller: 'UserBookListCtrl'
        })
        .when('/user/books/:isbn', {
            templateUrl: 'templates/tmp_book_details.html',
            controller: 'UserBookDetailsCtrl'
        })
        .when('/user/orderlist', {
            templateUrl: 'templates/user/tmp_order_list.html',
            controller: 'UserOrderListCtrl'
        })
        .when('/user/orderlist/detail/:id', {
            templateUrl: 'templates/user/tmp_order_detail.html',
            controller: 'UserOrderLisDetailCtrl'
        })
        .otherwise({
            redirectTo: '/books'
        });

    $httpProvider.defaults.useXDomain = true;
    delete $httpProvider.defaults.headers.common['X-Requested-With'];
    $httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

    // changed by elmar, needed to prevent CORS errors!
    $httpProvider.defaults.withCredentials = true;
});

bookshopApp.run(function ($rootScope, $location, $cookieStore, $http) {

    // keep user logged in after page refresh
    $rootScope.globals = $cookieStore.get('globals') || {};
    if ($rootScope.globals.currentUser) {
        $http.defaults.headers.common['Authorization'] = $rootScope.globals.currentUser.authdata; // jshint ignore:line

    }

    $rootScope.$on('$locationChangeStart', function (event, next, current) {
        // redirect to login page if not logged in and trying to access a restricted page
        //var restrictedPage = $.inArray($location.path(), ['/admin']) === -1;
        var restrictedPage = $location.path().indexOf("/admin/") != -1;
        console.log($rootScope.globals.currentUser);
        var loggedIn = true;
        var loggedInUser = $rootScope.globals.currentUser;
        if (restrictedPage && !loggedIn) {
            $location.path('/books');
        }
    });
});


bookshopApp.factory("HttpErrorInterceptorService", ["$q", "$rootScope", "$location", "FlashService",
    function ($q, $rootScope, $location, FlashService) {
        var success = function (response) {
                // pass through
                return response;
            },
            error = function (response) {
                if (response.status === 401) {
                    FlashService.Error(response.data.message);
                }

                return $q.reject(response);
            };

        return function (httpPromise) {
            return httpPromise.then(success, error);
        };
    }
]).config(["$httpProvider",
    function ($httpProvider) {
        $httpProvider.responseInterceptors.push("HttpErrorInterceptorService");
    }
]);

bookshopApp.filter('range', function() {
    return function(val, range) {
        range = parseInt(range);
        for (var i=0; i<range; i++)
            val.push(i);
        return val;
    };
});


