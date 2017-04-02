/**
 * Created by yangwei on 10/3/15.
 */
var app = angular.module('consoleApp', []);

app.controller('contactController',[ '$http', function($http){

    var ds = this;
    ds.contacts = [];
    ds.recordLength = 0;
    ds.limit = 10;
    ds.pages = [];
    ds.currentPageNumber = 1;
    ds.begin = 0;
    $http.get("php/json/contacts.php")
        .success(function(data) {
            if(data != "null") {
                ds.contacts = data;
                ds.pagenate(ds.contacts);
            }
        });

    /**
     * pagenate function
     * @param data
     */
    ds.pagenate = function(data) {
        ds.recordLength = data.length;
        var pNumber = Math.round(ds.recordLength/ds.limit);
        if (Math.round(ds.recordLength % ds.limit) < 5) {
            pNumber = pNumber + 1;
        }
        ds.pages = [];
        for (i=0; i<pNumber; i++) {
            ds.pages.push( i+1 );
        }
    }

    /**
     * previous page function
     */
    ds.prevPage = function() {
        if (ds.currentPageNumber > 1) {
            ds.setPage(ds.currentPageNumber - 1);
        }
    };

    /**
     * next page function
     */
    ds.nextPage = function() {
        if (ds.currentPageNumber < ds.pages.length) {
            ds.setPage(ds.currentPageNumber + 1);
        }
    };

    /**
     * set page according the page number
     * @param pageNumber
     */
    ds.setPage = function(pageNumber) {
        ds.currentPageNumber = pageNumber;
        ds.begin = ds.currentPageNumber*10 - 10;
    };
}]);



