/**
 * Created by Georgi on 2/21/2016.
 */

var Site = false;

HOST = window.location.origin;

(function($){
    Site = function(options){
        this.options = {
            debug: true
        };

        this.data = {};
        this.page = null;
        this.socket = null;

        this.init(options);
    };

    Site.prototype = {
        init: function(options){
            this.page = location.pathname;
            var $this = this;
            this.options = $.extend({}, this.options, options);

            $.ajax({
                url: HOST + '/site/ajax'
            }).done(function(result){
                result = JSON.parse(result);
                if(typeof result !== "undefined"){
                    $this.data = result;
                    $this.run();
                }
            });
        },

        run: function(){
            if(this.data.isGuest){
                if(this.page.search('register') < 0 && this.page.search('login') < 0) {
                    this.showRegisterAlert();
                }
            }

            try{
                this.socket = new WebSocket('ws://localhost:8080');
            } catch (e){
            }
        },

        debug: function(message){
            if(this.options.debug){
                console.log("Site: " + message);
            }
        },

        showRegisterAlert: function(){
            if(this.data.notifications != 0){
                setTimeout(function(){
                    var n = noty({
                        text: '<strong>Здравей, страннико.</strong> Все още не си се регистрирал? Зада използваш нашата система трябва да си регистриран в нея. Можеш да го направиш от <a href="' + HOST + '/site/register">тук</a>',
                        layout: 'topRight',
                        closeWith: ['click', 'backdrop'],
                        type: 'warning'
                    });
                }, 3000);
            }
        }
    };
})(jQuery);