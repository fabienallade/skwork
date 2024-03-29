window._ = require('lodash');
window.Popper = require('popper.js').default;

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
  window.$ = window.jQuery = require('jquery');

  require('bootstrap');
  require('angular');
  require('angular-animate');
  require('angular-route');
  require('angularjs-socket-io');
  require('angular-sweetalert');
  require('sweetalert');
  require('moment');
  require('angular-moment');
  require('socket.io-client');
  require('angular-toastr');
  require('angular-sanitize');
  require('angular-trix');
  require('offline-js');
  require('ng-offline-js');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error(
    'CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
// document.addEventListener("turbolinks:load", function() {
//   $.ajaxSetup({
//     headers: {
//       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
//   });
// })

jQuery(function ($) {
    Offline.options = {
        // to check the connection status immediatly on page load.
        checkOnLoad: false,

        // to monitor AJAX requests to check connection.
        interceptRequests: true,

        // to automatically retest periodically when the connection is down (set to false to disable).
        reconnect: {
            // delay time in seconds to wait before rechecking.
            initialDelay: 3,

            // wait time in seconds between retries.
            delay: 10
        },

        // to store and attempt to remake requests which failed while the connection was down.
        requests: true
    };
    console.log(Offline.state);
    console.log($( window ).width());
    if ($( window ).width()>320){
        $(".page-wrapper").removeClass("toggled");
        console.log(true);
    }
    /*le code pour verifier si le connecter ou pas */
/*    if (!navigator.onLine) {
        alert('No internet Connection !!');
    }else{
        alert('la connexion existe bien sur mon pote');
    }*/
    $(".sidebar-dropdown > a").click(function() {
        $(".sidebar-submenu").slideUp(200);
        if (
            $(this)
                .parent()
                .hasClass("active")
        ) {
            $(".sidebar-dropdown").removeClass("active");
            $(this)
                .parent()
                .removeClass("active");
        } else {
            $(".sidebar-dropdown").removeClass("active");
            $(this)
                .next(".sidebar-submenu")
                .slideDown(200);
            $(this)
                .parent()
                .addClass("active");
        }
    });

    $("#close-sidebar").click(function() {
        $(".page-wrapper").removeClass("toggled");
    });
    $("#show-sidebar").click(function() {
        $(".page-wrapper").addClass("toggled");
    });




});