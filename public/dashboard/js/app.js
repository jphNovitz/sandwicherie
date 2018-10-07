const io = require('socket.io-client')
Vue.use(io, 'http://localhost:5000')

let vm = new Vue({
    el: '#app',
    delimiters: ["<%","%>"],
    data: {

    },
    sockets:{
        connect: function(){
            console.log('socket connected')
        }
    },
    mounted(){
        socket.on('connection', function(socket){
            socket.join('orders');
        });
        // socket.on('connect', function(){
        //     socket.emit('order-room','carts')
        // });
    }

})
