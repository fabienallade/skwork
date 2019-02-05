app.controller("todo", function($scope, data, $http) {
  $scope.todo = []
  data.get(base_url + "api/get_task").then(function(result) {
    $scope.todo = result;
    /*        console.log(result)*/
  })

  function gettask() {
    data.get(base_url + "api/get_task").then(function(result) {
      $scope.todo = result;
      /*        console.log(result)*/
    })
  }
  $scope.$watch(function() {
    return $http.pendingRequests.length;
  }, function(oldVal, newVal) {
    //logic executed to display or hide loading box
    if (oldVal != newVal) {
      console.log("new value");
    }
  });


  $scope.submit = function(todo) {
    if (todo && todo.name && todo !== {}) {
      $scope.todo.push(todo);
      data.cret(base_url + "api/create_task", todo);
      data.get(base_url + "api/get_task").then(function(result) {
        $scope.todo = result;
      })
      $scope.todos = {}
      $scope.form.$setPristine()
    }
  }
  $scope.update_modal = function(id) {
    if (id) {

      data.cret(base_url + "api/update_task", id);
      data.get(base_url + "api/get_task").then(function(result) {
        $scope.todo = result;
      })
      alert("donnne modifier avec success");
      $('#mymodal')
        .modal('hide');
    }
  }

  $scope.edit = function(todo) {
    if (todo) {
      $scope.modal = todo;
      $('#mymodal')
        .modal('show');

      /*ModalService.showModal({
          templateUrl: base_url+"angular/modal/todo_modal.html",
          controller: "todo_modal",
          preClose: (modal) => {
              modal.element.modal('hide');
          },
          inputs: {
              title: todo
          }
      }).then(function(modal) {
          modal.element.modal();
          modal.close.then(function(result) {
              if (!result) {
                  $scope.complexResult = "Modal forcibly closed..."
              } else {
                  /!*debut du code *!/
              }
          });
      });*/
    }
  }
  $scope.delete = function(todo) {
    if (todo) {
      var confirm = window.confirm("Etes vous sur de vouloir effacer");
      if (confirm) {
        data.cret(base_url + "api/delete_task", todo);
      } else {
        return false;
      }
      data.get(base_url + "api/get_task").then(function(result) {
          $scope.todo = result;
        })
        /*var id=$scope.todo.indexOf(todo)
        $scope.todo.splice(id,1)*/
    }
  }
})



app.controller('rapport', function($scope, data) {
  $scope.rapport = {
    name: "",
    rapport: ""
  }
  $scope.todo = []
  data.get(base_url + "api/get_task").then(function(result) {
    $scope.todo = result;
    /*        console.log(result)*/
  })

  function gettask() {
    data.get(base_url + "api/get_task").then(function(result) {
      $scope.todo = result;
      /*        console.log(result)*/
    })
  }
  $scope.make = function(id) {
    var donne;
    if (id) {
      $scope.rapport = id;
      $('#rapportmodal').modal('show');
      // .modal({
      //   closable: false,
      //   onDeny: function() {
      //     window.alert('Le rapport na pas ete envoye');
      //     donne = 0;
      //     return true;
      //   },
      //   onApprove: function() {
      //     if ($scope.rapport.rapport) {
      //       data.cret(base_url + "api/create_rapport", $scope.rapport);
      //       window.alert('rapport envoyer avec success');
      //       donne = 1;
      //     } else {
      //       window.alert(
      //         "veuillez renseigner le champs qui se trouve devant vous"
      //       )
      //       return false
      //     }
      //   }
      // })
      if (donne == 1) {
        data.cret(base_url + "api/create_rapport", $scope.rapport);
      }
    }
  }
  $scope.update_modal = function(id) {
    data.cret(base_url + "api/create_rapport", $scope.rapport);
    if ($scope.rapport.rapport) {
      data.cret(base_url + "/api/create_rapport", $scope.rapport);
      window.alert('rapport envoyer avec success');
      donne = 1;
      $('#rapportmodal')
        .modal('hide');
      gettask()
    } else {
      window.alert(
        "veuillez renseigner le champs qui se trouve devant vous"
      )
    }
  }
  $scope.edit = function(id) {
    if (id) {
      data.get(base_url + "api/find_rapport", id).then(function(
        result) {
        $scope.get = result;
      })
      if ($scope.get) {
        $scope.rapport.id = $scope.get.id;
        $scope.rapport.name = $scope.get.name;
        $scope.rapport.rapport = $scope.get.body;
        $('#rapportmodal1')
          .modal('show');
      }
    }
  }
  $scope.update = function(id) {
    if (id) {
      data.get(base_url + "api/find_rapport", id).then(function(
        result) {
        $scope.get = result;
      })
      gettask()

      if ($scope.get) {
        $scope.rapport.id = $scope.get.id;
        $scope.rapport.name = $scope.get.name;
        $scope.rapport.rapport = $scope.get.body;

        if ($scope.rapport.rapport) {
          data.cret(base_url + "api/update_rapport", $scope.rapport);
          $('#rapportmodal1')
            .modal('hide');
          gettask()
        }
      }
    }
  }
})
