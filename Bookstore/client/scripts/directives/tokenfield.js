"use strict";

bookshopApp.directive('tokenfield', function(BookDataService) {
    return {
        restrict: 'A',
        scope: {
            /**
             * tokenfield holds a two-way bounded
             * reference to the book object.
             */
            tokenfield: '='
        },
        link: function(scope, elem) {
            /**
             * The invocation of elem.tokenfield('setTokens', ...) in
             * the initializeTagsArray() function implies that the
             * tokenfield plugin emits a 'afterCreateToken' event.
             *
             * According to our implementation this would invoke the
             * addToken() function which invokes scope.$apply().
             * Consequently this would cause a 'digest already in progress'
             * error. That's why we have to introduce a simple lifecycle
             * by the help of the initialized flag.
             */
            var initialized = false;

            // Fetch the tags from the server and initialize directive.
            BookDataService.getTags().then(function(res) {
                //console.log("Res: "+ res.data);
                var tagsAsString = new Array();
                for(var i=0; i<res.data.tags.length;i++){
                    tagsAsString.push(res.data.tags[i].title);
                }
                console.log(tagsAsString);
                initializeTokenfield(tagsAsString);
            }, function(error) {
                console.log('An error occurred!', error);
            });

            // Main initialization routine
            function initializeTokenfield(tokens) {
                elem.tokenfield({
                    autocomplete: {
                        source: tokens,
                        delay: 100
                    },
                    showAutocompleteOnFocus: false,
                    allowDuplicates: false,
                    createTokensOnBlur: true
                }).on('afterCreateToken', function (e) {
                    addToken(e.token.value);
                }).on('removeToken', function (e) {
                    removeToken(e.token.value);
                });

                function addToken(token) {
                    if (initialized) {
                        var found=false;
                        /**
                         * Manipulate the tags array within an $apply() call
                         * in order to trigger dirty checking afterwards.
                         * This is needed because we are manipulating the
                         * array from a 3rd-party callback function.
                         */
                        scope.$apply(function() {
                            //console.log("trying to add a token")
                            BookDataService.getTags().then(function(res) {
                                var tags = res.data.tags;
                                for(var i=0; i<res.data.tags.length&&!found; i++){
                                    if(token == tags[i].title){
                                       // scope.tokenfield.tags.push(tags[i]);
                                        found = true;
                                    }
                                }
                            }).then(function(res){
                                if(!found) {
                                    return BookDataService.addNewTag(token);
                                }
                            }).then(function(res) {
                                return BookDataService.getTagByTitle(token);
                            }).then(function(res) {
                                var tag = res.data.tag;
                                scope.tokenfield.tags.push(tag);
                            });
                        });
                    }
                }

                function removeToken(token) {
                    if (initialized) {
                        /**
                         * See addToken() comment.
                         */
                        scope.$apply(function() {
                            var tags    = scope.tokenfield.tags,
                                i       = tags.length;
                            while(i--) {
                                if (token === tags[i].title) {
                                    tags.splice(i, 1);
                                    break;
                                }
                            }
                        });
                    }
                }

                function initializeTagsArray() {
                    /**
                     * Due to the fact that we are fetching the book data
                     * from the server in the controllers (async) and we
                     * are also fetching the tags from the server (async),
                     * we cannot be sure about the state of scope.tokenfield.
                     *
                     * It may appear that scope.tokenfield has already been
                     * initialized when the link function is invoked. But
                     * there is no guarantee, so we have to handle both cases.
                     */

                    if (angular.isUndefined(scope.tokenfield)) {
                        scope.$watch('tokenfield', function(book) {
                            if (!initialized && angular.isDefined(book)) {
                                var strArr = new Array();
                                for(var i=0; i<book.tags.length;i++){
                                    strArr.push(book.tags[i].title);
                                }
                                elem.tokenfield('setTokens', strArr);
                                initialized = true;
                            }
                        });
                    }
                    else {
                        if (angular.isUndefined(scope.tokenfield.tags)) {
                            scope.tokenfield.tags = [];
                        }
                        else {
                            console.log(scope.tokenfield.tags);
                            var strArr = new Array();
                            for(var i=0; i< scope.tokenfield.tags.length;i++){
                                strArr.push(scope.tokenfield.tags[i].title);
                            }
                            elem.tokenfield('setTokens', strArr);//scope.tokenfield.tags);
                        }

                        initialized = true;
                    }
                }

                initializeTagsArray();
            }
        }
    }
});
