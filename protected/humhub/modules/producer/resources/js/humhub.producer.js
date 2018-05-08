humhub.module('producer', function (module, require, $) {

    var init = function () {

        if ($('.knob-container').length) {
            $(".knob").knob();
            $(".knob-container").css("opacity", 1);
        }
    };

    module.export({
        init: init,
        initOnPjaxLoad: true
    });
    
    $('#producer-get-latest-data').click(function() {
        alert('Chegou');
    });
});