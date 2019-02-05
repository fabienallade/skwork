app.controller('inscrit', function($scope, data, $http) {
    data.get(base_url + "api/postes").then(function(result) {
        $scope.occupation_ = result;
    })
})
app.controller('ami', function($scope, data, $http) {
    data.get(base_url + "api/get_user").then(function(result) {
        $scope.ami = result;
    })
})
app.controller('discussion', function($scope, data, $http, $anchorScroll, $location) {
    $scope.id = id;
    $scope.id1 = id1;
    console.log(base_url,"fabien");

    $scope.cut = function() {
        $location.hash('bottom');
        $anchorScroll();
    }

    function scroll() {
        if ($scope.message) {
            setTimeout(function() {
                $scope.cut();
                $location.hash('bottom');
                $anchorScroll();
            }, 1000);
        }
    }
    scroll()

    data.get(base_url + "/api/get_message/" + id1 + "/" + id).then(function(result) {
        $scope.message = result;
        console.log($scope.message.length);
        scroll()
    })
    $scope.ecrire = function() {
        if ($scope.mes != "") {
            data.cret(base_url + "/api/post_message/" + id + "/" + id1, { id: $scope.mes });
            data.get(base_url + "/api/get_message/" + id + "/" + id1).then(function(result) {
                $scope.message = result;
            })
            $scope.mes = "";
            scroll()
        }
        scroll()
    }

})