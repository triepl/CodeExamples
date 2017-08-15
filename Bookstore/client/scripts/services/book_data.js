"use strict";

bookshopApp.factory('BookDataService', function($http,$rootScope, CONFIG) {
    var srv = {};

    srv._baseUrl = CONFIG.serverURL;

    // Service implementation
    srv.getBookByIsbn = function(isbn) {
        return $http.get(srv._baseUrl + "/api/books/isbn/" + isbn+".json");
    };

    srv.getBooks = function() {
        // Copy the array in order not to expose the internal data structure
        //return angular.copy(srv._books);
        return $http.get(srv._baseUrl + "/api/books.json");
    };

    srv.storeBook = function(book) {
        return $http.post(srv._baseUrl + '/api/books', book );
    };

    srv.updateBook = function(book) {
        return $http.put(srv._baseUrl + '/api/books/isbn/' + book.isbn+".json", book);
    };

    srv.deleteBookByIsbn = function(isbn) {
       return $http.delete(srv._baseUrl + '/api/books/isbn/' + isbn+".json");
        //return $http.delete(srv._baseUrl + '/api/books/' + isbn+".json");
    };

    //srv.getTags = function(){
    //    return $http.get(srv._baseUrl + '/api/tags.json');
    //};
    //
    srv.getPublishers = function(){
        return $http.get(srv._baseUrl + '/api/publishers.json');
    };

    srv.getPublisherById = function(id){
        return $http.get(srv._baseUrl + '/api/publishers/'+id+'.json');
    };

    srv.storePublisher = function(publisher){
        return $http.post(srv._baseUrl + '/api/publishers.json',publisher);
    };

    srv.updatePublisher = function(publisher){
        return $http.put(srv._baseUrl + '/api/publishers/'+publisher.id+'.json',publisher);
    };

    srv.deletePublisherById = function(publisher){
        return $http.delete(srv._baseUrl + '/api/publishers/'+publisher.id+'.json');
    };

    srv.getBookRaitingsByIsbn = function(isbn) {
        return $http.get(srv._baseUrl + "/api/raitings/isbn/" + isbn+".json");
    };
    srv.storeRaitings = function(raiting) {
        return $http.post(srv._baseUrl + '/api/raitings', raiting );
    };


    srv.getOrders = function(id) {
        return $http.get(srv._baseUrl + "/api/orders/userid/"+id+".json");
    };

    srv.getOrderItemsById = function(id){
        return $http.get(srv._baseUrl + '/api/orderitems/orderid/'+id+'.json');
    };
    srv.storeNewOrder = function(order){
        return $http.post(srv._baseUrl + '/api/orders',order);
    };

    srv.getLastId = function(){
        return $http.get(srv._baseUrl + '/api/orders/getlastid.json');
    };

    srv.storeOrderItems = function(orderitem){
        return  $http.post(srv._baseUrl + '/api/orders_items.json',orderitem);
    };



    //srv.addNewTag = function(t) {
    //    return $http.post(srv._baseUrl + '/api/tags.json', {title:t} );
    //};
    //
    //srv.getTagByTitle=function(title){
    //    return $http.get(srv._baseUrl + "/api/tags/" + title+".json");
    //};

    // Public API
    return {
        getBookByIsbn: function(isbn) {
            return srv.getBookByIsbn(isbn);
        },
        getBooks: function() {
            return srv.getBooks();
        },
        storeBook: function(book) {
            return srv.storeBook(book);
        },
        updateBook: function(book) {
            return srv.updateBook(book);
        },
        deleteBookByIsbn: function(isbn) {
            return srv.deleteBookByIsbn(isbn);
        },
        //getTags: function(){
        //    return srv.getTags();
        //},
        getPublishers: function(){
            return srv.getPublishers();
        },
        getPublisherById: function(id){
            return srv.getPublisherById(id);
        },
        storePublisher:function(publisher){
            return srv.storePublisher(publisher);
        },
        updatePublisher:function(publisher){
            return srv.updatePublisher(publisher);
        },
        deletePublisherById: function(id) {
            return srv.deletePublisherById(id);
        },
        getBookRaitingsByIsbn: function(isbn) {
            return srv.getBookRaitingsByIsbn(isbn);
        },
        getOrders: function(id){
            return srv.getOrders(id);
        },
        getOrderItemsById: function(id){
            return srv.getOrderItemsById(id);
        },
        storeNewOrder:function(order){
            return srv.storeNewOrder(order);
        },
        storeRaitings:function(raiting){
            return srv.storeRaitings(raiting);
        },
        getLastId:function(){
            return srv.getLastId();
        },
        storeOrderItems: function(orderitem){
            return srv.storeOrderItems(orderitem);
        }


        //addNewTag: function(title){
        //    return srv.addNewTag(title);
        //},
        //getTagByTitle: function(title){
        //    return srv.getTagByTitle(title);
        //}
    };
});