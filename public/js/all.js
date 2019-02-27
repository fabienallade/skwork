var app = angular.module("app", [
    "ysilvela.socket-io",
    "ngAnimate",
    "oitozero.ngSweetAlert",
    "angularMoment",
    "ngRoute",
    "toastr",
    "ngSanitize",
    "angularTrix",
    "ng-offline-js"
  ])
  .config(['$interpolateProvider',
    function($interpolateProvider) {
      $interpolateProvider.startSymbol('__');
      $interpolateProvider.endSymbol('__');
    }
  ]);
app.run(function($rootScope,data,socket){
    data.get("/api/get_notification").then(function(result) {
        $rootScope.notif =result;
        $rootScope.nombre=0;
        $rootScope.nbreDiscussion=0;
        angular.forEach($rootScope.notif,function (id) {
            if (id.length>0){
                $rootScope.nbreDiscussion++;
            }
            $rootScope.nombre+=id.length;
            console.log(id)
        } )
        console.log($rootScope.nombre)
        console.log(result);
    })

});
app.config(['$routeProvider', '$locationProvider',
  function($routeProvider, $locationProvider) {
    $routeProvider
      .when('/Book/:bookId', {
        templateUrl: 'book.html',
        controller: 'BookCtrl',
        controllerAs: 'book'
      })
      .when('/Book/:bookId/ch/:chapterId', {
        templateUrl: 'chapter.html',
        controller: 'ChapterCtrl',
        controllerAs: 'chapter'
      }).when('/messages/:conversation_id',{
        templateUrl: '/partials/messages.html',
        controller: 'messages',
        controllerAs: 'message'
    });
    $locationProvider.html5Mode(false);

  }
])
app.config(function(toastrConfig) {
    angular.extend(toastrConfig, {
        autoDismiss: false,
        containerId: 'toast-container',
        maxOpened: 0,
        newestOnTop: true,
        positionClass: 'toast-bottom-right',
        preventDuplicates: false,
        preventOpenDuplicates: false,
        target: 'body'
    });
});

app.factory('socket', function($rootScope) {
  var socket = io.connect('http://127.0.0.1:4000');
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
app.controller('create_pub',function ($scope) {
  $scope.foo="fabien"
})
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

app.controller('inscrit', function($scope, data, $http) {
    data.get(base_url + "api/postes").then(function(result) {
        $scope.occupation_ = result;
    })
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
    data.get(base_url + "api/get_commentaire/" + id).then(function(
      result) {
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
    data.get(base_url + "api/get_commentaire/" + id).then(function(
      result) {
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
      var confirm = window.confirm(
        "Etes vous sur de vouloir effacer");
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
app.controller('discussion', function($scope, socket, $http, data,
  SweetAlert,$location) {
  socket.on('connect', function(result) {
    console.log(result);
  });
    function getclass() {
        data=$location.$$url.split('/messages/')[1]
        $scope.active_chats=data;
    }

  data.get("/api/get_conversation").then(function(result) {
    $scope.dernier_message = result;
  })

  $scope.show_message = function(id) {
    console.log(id);
      $scope.active_chats=id;
  }
  $scope.get_last = function(id) {
    return getLast(id);
  }
    getclass();


})
app.controller('messages',function ($scope,$routeParams,data,toastr,$anchorScroll,$timeout,socket) {
    console.log($routeParams.conversation_id);
    $scope.id=$routeParams.conversation_id;
    $scope.active_chats=$routeParams.conversation_id;

    socket.on('event-channel', function(data) {
        var data=JSON.parse(data)
        if(data.data.conversation_id==$scope.id && data.data.sender.id!=id1){
            $scope.messagerie.push(data.data);
            time()
        }

    });
    function time(){
        $timeout(function () {
            var fabien=angular.element('#scrollArea')[0].scrollHeight
            console.log(angular.element('#scrollArea').scrollTop(fabien))
            console.log(fabien)
        }, 1000);
    }
    time()

    data.get("/api/get_message_conversation",$scope.id).then(function(result) {
        $scope.messagerie = result;
        console.log(result);
    })

    $scope.message_envoi={
      body:"",
        conversation_id:$routeParams.conversation_id,
        user_id:id1,
        type:"text"
    }
    $scope.envoi_message=function () {
      if ($scope.message_envoi.body.length==0){
        toastr.error("Veuillez ecrire avant d'envoyer le message");
      } else {
          data.get("/api/envoi_message",$scope.message_envoi).then(function(result) {
              $scope.messagerie.push(result);
              $scope.message_envoi.body=""
              toastr.success("Message ENvoyer","votre message a ete bien envoyer")
              console.log(result);
          })
          time()
      }
    }

    async function getLast(id) {

        var data1 = {};
        data1 = await data.get("/api/get_message_conversation", id);
        $scope.messagerie=data1;
        return data1;
    }
    getLast($scope.id);


})
/*
app.directive('myTabs', function() {
  return {
    restrict: 'E',
    transclude: true,
    scope: {},
    controller: ['$scope', function MyTabsController($scope) {
      var panes = $scope.panes = [];

      $scope.select = function(pane) {
        angular.forEach(panes, function(pane) {
          pane.selected = false;
        });
        pane.selected = true;
      };

      this.addPane = function(pane) {
        if (panes.length === 0) {
          $scope.select(pane);
        }
        panes.push(pane);
      };
    }],
    templateUrl: '/partials/my-tabs.html'
  };
})
app.directive('myPane', function() {
  return {
    require: '^^myTabs',
    restrict: 'E',
    transclude: true,
    scope: {
      title: '@'
    },
    link: function(scope, element, attrs, tabsCtrl) {
      tabsCtrl.addPane(scope);
    },
    templateUrl: '/partials/my-pane.html'
  };
});
*/

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
