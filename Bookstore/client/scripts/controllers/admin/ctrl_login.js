bookshopApp.controller('LoginCtrl', function ($window,$scope,$location, $route, AuthenticationService,FlashService) {

    $scope.logout = function () {
        // reset login status
        //AuthenticationService.ClearCredentials();
        AuthenticationService.Logout();
        $location.path('/books');
        //$window.location.reload();
    };

    $scope.loggedIn = $scope.globals.currentUser;
    console.log($scope.loggedIn);


    $scope.login = function login(){
        console.log("in login");
        $scope.dataLoading = true;
        AuthenticationService.Login($scope.username, $scope.password, function (response) {
            if (response.success) {
                //AuthenticationService.SetCredentials($scope.username, $scope.password);
                $scope.loggedIn = true;
                $location.path('/admin/books');
                //$window.location.reload();
            } else {
                FlashService.Error(response.message);
                $scope.dataLoading = false;
                $scope.loggedIn = false;
            }
        });
    };
});


