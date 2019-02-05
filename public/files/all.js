var app = angular.module("app", ["ysilvela.socket-io", "ngAnimate","toastr"])
  .config(['$interpolateProvider',
    function($interpolateProvider) {
      $interpolateProvider.startSymbol('__');
      $interpolateProvider.endSymbol('__');
    }
  ]);
/* app.config(function ($routeProvider) {
     $routeProvider.when('/', {
         controller: 'mainController',
         templateUrl: '../views/main.php'
     }).when('/about', {
         templateUrl: '../views/home/about.html'
     }).otherwise({
         redirectTo: '/'
     });
 });*/
app.factory('Users', function($q, $http) {
  var self = {

  };

  self.create = function(user) {
    var d = $q.defer();
    $http.post('/api/users/create', user).
    success(function(data) {
      d.resolve(data);
    });
    return d.promise;
  };

  self.update = function(user) {
    var d = $q.defer();
    $http.post('/api/users/update', user).
    success(function(data) {
      d.resolve(data);
    });
    return d.promise;
  };

  self.all = function() {
    var d = $q.defer();
    $http.get('/api/users/all').
    success(function(data) {
      d.resolve(data);
    });
    return d.promise;
  };

  self.delete = function(user_id) {
    var d = $q.defer();
    $http.get('/api/users/delete/' + user_id).
    success(function(data) {
      d.resolve(data);
    });
    return d.promise;
  };

  return self;
});

app.factory('socket', function($rootScope) {
  var socket = io.connect('http://127.0.0.1:3000');
  return {
    on: function(eventName, callback) {
      socket.on(eventName, function() {
        var args = arguments;
        $rootScope.$apply(function() {
          callback.apply(socket, args);
        });
      });
    },
    emit: function(eventName, data, callback) {
      socket.emit(eventName, data, function() {
        var args = arguments;
        $rootScope.$apply(function() {
          if (callback) {
            callback.apply(socket, args);
          }
        });
      })
    }
  };
});

app.factory('data', function($http, $q) {
  var factory = {
    find: findallcontact,
    delete: delete_ens,
    cret: create_ens,
    get: getInfo
  }

  function getInfo(url, data) {
    var def = $q.defer()
    $http.post(url, {
        data: data
      })
      .then(function(response) {
          def.resolve(response.data)
        },
        function(errReponse) {
          console.log("erreur de lanalyse des donne");
          def.reject(errReponse)
        })
    return def.promise;
  }

  function findallcontact(test) {
    var def = $q.defer()
    $http.get(test)
      .then(function(response) {
          def.resolve(response.data)
        },
        function(errReponse) {
          console.log(
            "erreur lors de la prise des informations dans la base de donne"
          );
          def.reject(errReponse)
        })
    return def.promise;
  }

  function delete_ens(urls, id) {
    $http({
        method: 'post',
        url: urls,
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        data: $.param({
            idp: id
          })
          //  $.param({
          //   email:login.email,
          //   password:login.password
          // })
          ,
      })
      .then(
        function(data) {
          // Success
          console.log(data);
        }),
      function(data) {
        // Failure
        console.log(data);
      }
  }

  function create_ens(urls, data) {
    $http({
        method: 'post',
        url: urls,
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        data: $.param(data)
          //  $.param({
          //   email:login.email,
          //   password:login.password
          // })
          ,
      })
      .then(
        function(data) {
          // Success
          console.log(data);
        }),
      function(data) {
        // Failure
        console.log(data);
      }
  }

  return factory
});
app.controller("fab", function($scope, $mdDialog, data, $location) {
  $scope.publication = {}

  $scope.pdf = function(url) {
    $('.modal')
      .modal('show');
    $scope.pdf_name = url;
  }


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

app.controller('fire', function($scope, socket) {
  $scope.message = "fabien fait des putain de calcul de ouf"
  socket.on('event-channel', function(data) {
    $scope.message = JSON.parse(data).data.power;
  });
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
app.controller("todo", function($scope, data, $http,toastr) {
  $scope.todo = [];
  data.get(base_url + "api/get_task").then(function(result) {
    $scope.todo = result;
      toastr.success('Hello world!', 'Toastr fun!');
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
        toastr.success('Hello world!', 'Toastr fun!');
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
