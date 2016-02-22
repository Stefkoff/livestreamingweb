/**
 * Created by Georgi on 2/22/2016.
 */
var __Socket = null;
socket = false;

(function($){
    __Socket = function(){
        this.__socket = null;

        this.init();
    };

    __Socket.prototype = {
        init: function(){
            try{
                this.__socket = new WebSocket('ws://localhost:8080');

                this.__socket.onmessage = function(e){
                    $(document).trigger('socket-message', [e.data]);
                }
            } catch(e){
                console.log(e);
            }
        },

        publish: function (topic, message){
            var msgData = {
                topic: topic,
                message: message
            };

            var $this = this;

            if(this.__socket.readyState !== 1){
                setTimeout(function(){
                    $this.__socket.send(JSON.stringify(msgData));
                }, 2000);
            } else{
                this.__socket.send(JSON.stringify(msgData));
            }
        },

        subscribe: function(topic){
            var $this = this;
            var data = {
                type: 'subscribe',
                topic: topic
            };

            if(this.__socket.readyState !== 1){
                setTimeout(function(){
                    $this.__socket.send(JSON.stringify(data));
                }, 2000);
            } else{
                this.__socket.send(JSON.stringify(data));
            }
        },

        onMessage: function(func){
            if(typeof func === "function"){
                this.__socket.onmessage = func;
            }
        }
    };

    socket = new __Socket();
})(jQuery);