/**
 * Created by Georgi on 2/22/2016.
 */
var __Socket = null;

(function(){
    __Socket = function(options){
        this.__socket = null;
        this.options = null;

        this.init(options);
    };

    __Socket.prototype = {
        init: function(options){
            this.options = options;
            try{
                this.__socket = new WebSocket('ws://' + this.options.host + ':8080');

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
        }
    };
})();