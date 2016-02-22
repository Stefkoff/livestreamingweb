/**
 * Created by Georgi on 2/22/2016.
 */
var ActiveUsers = false;

(function($){

    ActiveUsers = function(options){
        this.options = {
            debug: true
        };

        this.socket = null;

        this.init(options);
    };

    ActiveUsers.prototype = {
        init: function(options){
            this.options = $.extend({}, this.options, options);

            this.socket = socket;
            this.socket.subscribe('activeUsers');

            var $this = this;

            $(document).on('socket-message', $this.onmessage);
        },

        onmessage: function(event, messageData){
            var message = JSON.parse(messageData);
            if(message.topic === 'activeUsers'){
                $('.users-widget span.active-users').html(message.data);
            }
        },

        debug: function(message){
            if(this.options.debug){
                console.log(message);
            }
        }
    };
})(jQuery);