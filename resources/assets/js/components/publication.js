app.controller("publication", function($scope, data, $location) {
  $scope.publication = {}
  $scope.pdf_name =
    "http://localhost:8000/files//1543535460Info.txt//1543535460Info.txt";
  $scope.pdf = function(url) {
    $('#exampleModalLong')
      .modal('show');
    $scope.pdf_name = url;
  };

  function hide() {
    $('.ui.modal')
      .modal('hide');
  }

  $scope.click = function(id) {
    $('.ui.modal')
      .modal('show');
    $scope.publication.id = id;
  }


  $scope.publier = function(data1) {
    if ($scope.form.$error.required == null) {
      data.cret(base_url + "api/create_pub", data1);
      hide()
      $scope.publication = {}
      showAlert()
    } else {
      console.log($scope.form.$error);
    }

  }
  $scope.annuler = function() {
    $('.ui.modal')
      .modal('hide');
  }


})

app.controller('comments', function($scope, $http, data) {
  $scope.id = id;
  $scope.body;

  function get() {
    data.get(base_url + "api/get_commentaire/" + id).then(function(result) {
      console.log(result);
    })
  }
  $scope.valid = function() {
    if ($scope.body && $scope.body != null) {
      data.cret(base_url + "api/post_commentaire/" + id, {
        id: $scope.body
      });
      $scope.body = "";
      setTimeout(function() {
        window.location = "/commentaire/" + id
      }, 10000);
    }
  }
})
