var app = require('express')();
const morgan = require('morgan');
const helmet = require('helmet');
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('redis');
var redisClient = Redis.createClient();
app.use(helmet());
app.use(morgan('tiny'));
console.log('Starting');
io.on('connection', function(socket) {
  var redisClient = Redis.createClient();
  redisClient.subscribe('event-channel');

  redisClient.on("message", function(channel, message) {
    socket.emit(channel, message);
    console.log(channel, message);
  });

  socket.on('disconnect', function() {
    redisClient.quit();
  });
});
http.listen(3000, function() {
  console.log('Listening on Port 3000');
});
