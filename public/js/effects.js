function overlay(msg) {

    $('<div>').attr({
        id: 'overlay'
    })
    .css({
        position: 'absolute',
        width: '100%',
        height: '100%',
        top: '0px',
        right: '0px',
        bottom: '0px',
        left: '0px',
        zIndex: '10000',
        background: 'rgba(0,0,0,.6)',
        display: 'block'
    })
    .appendTo('body');
    
}

function liftOverlay() {
    $('#overlay').remove();
}

// Notification Div
function notify(messageText) {
    var e = $('</div>').attr({
        class: "notification"
    }).offset({
        right: '20px',
        top: '40px',
        
    }).css({
        opacity: "1",
        position: 'absolute',
        zIndex: '10000'
    }).html(messageText).appendTo('body');
    e.animate({
        top: '20px'
    }, 500, function() {
        alert('finished');
    });
}


function spinner() {
    var opts = {
        lines: 13, // The number of lines to draw
        length: 20, // The length of each line
        width: 10, // The line thickness
        radius: 30, // The radius of the inner circle
        corners: 1, // Corner roundness (0..1)
        rotate: 0, // The rotation offset
        direction: 1, // 1: clockwise, -1: counterclockwise
        color: '#0121D1', // #rgb or #rrggbb or array of colors
        speed: 1, // Rounds per second
        trail: 30, // Afterglow percentage
        shadow: true, // Whether to render a shadow
        hwaccel: false, // Whether to use hardware acceleration
        className: 'spinner', // The CSS class to assign to the spinner
        zIndex: 2e9, // The z-index (defaults to 2000000000)
        top: '50%', // Top position relative to parent
        left: '50%' // Left position relative to parent
    };
    var target = $('body')[0];
    return new Spinner(opts).spin(target);
};

