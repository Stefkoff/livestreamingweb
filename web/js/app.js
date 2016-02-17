/**
 * Created by Georgi on 2/17/2016.
 */
$(function(){
    $(document).delegate(".modal", "dialog2.content-update", function() {
        // got the dialog as this object. Do something with it!

        var e = $(this);

        var autoclose = e.find("a.auto-close");
        if (autoclose.length > 0) {
            e.dialog("close");

            var href = autoclose.attr('href');
            if (href) {
                window.location.href = href;
            }
        }
    });
});