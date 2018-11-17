/**
 * Created by bjwsl-001 on 2016/8/8.
 */

var app = angular.module('kaifanla', ['ng', 'ngRoute']);

app.controller('parentCtrl', function ($scope, $location) {
    $scope.jump = function (path) {
        $location.path(path);
    }
})


app.controller('startCtrl', function ($scope, $location) {
    /*  $scope.jump = function () {
     $location.path('/main');
     }*/
})

app.controller('mainCtrl', function ($scope, $http) {
    $scope.hasMore = true;
    $http.get('data/dish_getbypage.php?start=0')
        .success(function (data) {
            $scope.dishList = data;
        })

    //用来从服务器中获取下一页数据
    $scope.loadMore = function () {
        $http.get('data/dish_getbypage.php?start=' + $scope.dishList.length)
            .success(function (data) {
                if (data.length < 5) {
                    $scope.hasMore = false;
                }
                $scope.dishList = $scope.dishList.concat(data);
            })
    }

    //关键词的监听
    $scope.$watch('kw', function () {
        console.log($scope.kw);
        if ($scope.kw) {
            $http.get('data/dish_getbykw.php?kw=' + $scope.kw)
                .success(function (data) {
                    console.log(data);
                    $scope.dishList = data;
                })
        }

    })

})

app.controller('detailCtrl', function ($scope, $http, $routeParams) {
    console.log($routeParams.did);
    $http.get('data/dish_getbyid.php?id=' + $routeParams.did)
        .success(function (data) {
            console.log(data);
            $scope.dish = data[0];
            $scope.dish.did = $routeParams.did;
        })
})

app.controller('orderCtrl', function ($scope, $http, $routeParams) {

    $scope.submitOrder = function () {
        $scope.user.did = $routeParams.did;
        console.log($scope.user);
        var str = jQuery.param($scope.user);
        console.log(str);
        $http.get('data/order_add.php?' + str)
            .success(function (data) {
                console.log(data);
                if(data[0].msg == 'succ')
                {
                    $scope.msgSuccess = "订餐成功！您的订单编号为："+data[0].did+"。您可以在用户中心查看订单状态";
                }
                else{
                    $scope.msgError = "订餐失败！失败"+data[0].reason;
                }
            })
    }
})

app.config(function ($routeProvider) {

    $routeProvider
        .when('/start', {
            templateUrl: 'tpl/start.html',
            controller: 'startCtrl'
        })
        .when('/main', {
            templateUrl: 'tpl/main.html',
            controller: 'mainCtrl'
        })
        .when('/detail', {
            templateUrl: 'tpl/detail.html',
            controller: 'detailCtrl'
        })
        .when('/detail/:did', {
            templateUrl: 'tpl/detail.html',
            controller: 'detailCtrl'
        })
        .when('/order', {
            templateUrl: 'tpl/order.html',
            controller: 'orderCtrl'
        })
        .when('/order/:did', {
            templateUrl: 'tpl/order.html',
            controller: 'orderCtrl'
        })
        .when('/myOrder', {
            templateUrl: 'tpl/myOrder.html'
        })
        .otherwise({redirectTo: '/start'});

})
