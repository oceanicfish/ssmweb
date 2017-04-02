/**
 * Created by yangwei on 10/3/15.
 */
var app = angular.module('facultyApp', []);

app.controller('facultyController',[ '$http', function($http){

    var ds = this;
    var entries = 6;
    ds.teachers = [];
    ds.teacher = null;
    ds.recordLength = 0;
    ds.limit = entries;
    ds.currentPageNumber = 1;
    ds.begin = 0;
    ds.status = "waiting";
    ds.skype = "";
    ds.qq = "";

    //fetch all incomes
    $http.get("http://localhost:8080/springREST/teacher")
        .success(function(data) {
            if(data != "null") {
                ds.teachers = data;
            }
            ds.pagenate(ds.teachers);
        });

    // $http.get("php/json/skype.php")
    //     .success(function(data) {
    //         if(data != "null") {
    //             ds.skype = data.skype;
    //         }
    //     });
    //
    // $http.get("php/json/qq.php")
    //     .success(function(data) {
    //         if(data != "null") {
    //             ds.qq = data.qq;
    //         }
    //     });

    /**
     * submit new payment
     */
    ds.save = function() {

        //prepare income data
        // ds.teacher = {
        //     name : ds.name,
        //     password : ds.password,
        //     rate : ds.rate,
        //     skype : ds.skype,
        //     qq : ds.qq,
        //     skills : ds.skills,
        //     cdate : Math.round(Date.now() / 1000),
        //     status : ds.status
        // };

        console.log(ds.teacher);

        //ajax submit to php

        $http.post("http://localhost:8080/springREST/teacher", ds.teacher)
            .then(function(response){
                console.log(response);
                if(response.data.success) {
                    alert("Teacher " + ds.teacher.name + " has been added.");
                    ds.teachers.unshift(ds.teacher);
                    ds.pagenate(ds.teachers);
                }else {
                    //alert(response.data);
                    alert(response.data.message);
                }
            }, function(){
                console.log('add http request failed');
            });
    }
    
    ds.show = function (id) {
        for(i = 0; i < ds.teachers.length; i++) {
            if (ds.teachers[i].id == id) {
                ds.teacher = ds.teachers[i];
                // ds.name = ds.teacher.name;
                // ds.password = ds.teacher.password;
                // ds.rate = ds.teacher.rate;
                // ds.skype = ds.teacher.skype;
                // ds.qq = ds.teacher.qq;
                // ds.skills = ds.teacher.skills;

            }
        }
    }
    
    ds.update = function () {

        console.log(ds.teacher);

        //ajax submit to php

        $http.put("http://localhost:8080/springREST/teacher", ds.teacher)
            .then(function(response){
                console.log(response);
                if(response.data.success) {
                    alert("Teacher " + ds.teacher.name + " has been updated.");
                }else {
                    //alert(response.data);
                    alert(response.data.message);
                }
            }, function(){
                console.log('update http request failed');
            });
    }

    ds.delete = function () {

        console.log(ds.teacher);

        //ajax submit to php
        $http.delete("http://localhost:8080/springREST/teacher/" + ds.teacher.id)
            .then(function(response){
                console.log(response);
                if(response.data.success) {
                    alert("Teacher " + ds.teacher.name + " has been deleted.");
                }else {
                    //alert(response.data);
                    alert(response.data.message);
                }
            }, function(){
                console.log('delete http request failed');
            });

    }

    /**
     * pagenate function
     * @param data
     */
    ds.pagenate = function(data) {
        ds.recordLength = data.length;
        var pNumber = Math.round(ds.recordLength/ds.limit);
        if (Math.round(ds.recordLength % ds.limit) < 3) {
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
        ds.begin = ds.currentPageNumber * entries - entries;
    };

}]);



