bookshopApp.controller('LoginCtrl', function ($window,$scope,$location, $route, AuthenticationService,FlashService) {

    $scope.logout = function () {
        console.log('into Logout');
        // reset login status
        //AuthenticationService.ClearCredentials();
       AuthenticationService.Logout();
       $scope.loggedIn = false;
       $location.path('/books');
       $window.location.reload();
    };

    $scope.loggedIn = $scope.globals.currentUser;

    $scope.login = function login(){
        console.log("in login func");
        $scope.dataLoading = true;
        AuthenticationService.Login($scope.username, $scope.password, function (response) {
            if (response.success) {

                //AuthenticationService.SetCredentials($scope.username, $scope.password);
                $scope.loggedIn = true;
                $scope.isAdmin = response.isAdmin;

                if($scope.isAdmin){
                    $location.path('/admin/books');
                    //$window.location.reload();

                } else {
                    $location.path('/user/books');
                    //$window.location.reload();
                }

                //$window.location.reload();
            } else {
                FlashService.Error(response.message);
                $scope.dataLoading = false;
                $scope.loggedIn = false;
            }
        });
    };
});



