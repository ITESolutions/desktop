var TaskbarIcon = function(id) {
    var e = $('<div></div>');
    this.e.id = id;
};

function createIcon(source, grow, id) {
    var icon = $('<img />');
    icon.setAttribute('src', '/images/icons/' + source);
    icon.id = id;
    icon.className = 'icon';
    
    $(icon).toggle(function() {
        console.log('on');
        
    }, function() {
        console.log('off');
    }
    );
    
    $(icon).css({
        position : 'relative',
        left : '15px',
        top : '3px',
        marginRight : '10px',
        marginBottom : '10px'
    });
    $(icon).hover(function(e) {
        $(this).animate({
            left : '13px',
            top: '0px',
            width: '40px'
        },50);
            
    }, function(e) {
        $(this).animate({
            left : '15px',
            top : '3px',
            width : '35px'
        }, 100);
    });
    return icon;
};




