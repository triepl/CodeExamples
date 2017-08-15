
bookshopApp.directive('tags',function(){
    return {
        restrict : 'E',
        templateUrl: 'component_templates/directives/tags.html',
        scope :{
            tagData: '='
        },
        link: function(scope, element, attrs){
            console.log('Hello from the tag direktive');
        }
    }
});
