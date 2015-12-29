
var scripts = [
    'icon',
    'application'
];

$.each($(scripts), function(i, v) {
    $.getScript(v+'.js', function(){
       console.log("Script '"+v
       +"' loaded and executed.");
    });
});

/*
 * @type bg String 
 * @returns Object [CuraDesktop]
 */
var CuraDesktop = function(bg) {
    if ( arguments.callee._singletonInstance ) {
        return arguments.callee._singletonInstance;
    }
    arguments.callee._singletonInstance = this;
    
    this.bg = bg === undefined ? 'desktop_bg_0.png' : bg;
    
    preload([
        '/images/'+this.bg,
        'desktop_bg_1.png',
        'window_gloss.png'
    ]);
    liftOverlay();
    
    //this.settings = ajaxGetJSON('settings');
    this.initialize();
    this.loadTaskbar();
    $(this.e).appendTo('body');
    
    
};

// Class methods and properties
CuraDesktop.prototype = {
    
    // Initialize function to save space in constructor
    initialize: function() {
        this.e = $('<div />').attr({
            id: 'CuraDesktop',
            class: 'desktop'
        }).css({
            position : 'absolute',
            margin : '0px',
            padding : '0px',
            width : window.innerWidth + 'px',
            height : window.innerHeight + 'px',
            top : '0px',
            right : '0px',
            bottom : '0px',
            left : '0px',
            backgroundSize: 'cover',
            overflow : 'hidden',
            backgroundImage : 'url(/images/' + this.bg + ')'
        });
        
        this.windows = new Array();
        
        this.applications = ajaxGetJSON('apps');
        this.users = ajaxGetJSON('users');
        this.user = this.users[0];
    },
    
    get: function() {
        return this.e;
    },
    
    loadTaskbar: function() {
        
        // Taskbar
        $('<div />').attr({
            id: 'cura_taskbar',
            class: 'taskbar'
        }).css({
            width : '100%',
            height : '40px',
            margin : '0px',
            position : 'absolute',
            bottom : '0px',
            zIndex: '1000'
        }).appendTo( this.e );
        
        // Cura Menu
        var
            applications = this.applications,
            users = this.users,
            user = this.user,
            menuContent = '',
            pBuffer = '',
            profile_info = $('<div />').attr({
                id: 'profile_info',
                class: 'applications'
            });
        
        
        $('<img />').attr({
            id: 'profile_widget',
            class: '',
            src: '/images/users/coreyaray/profile.png'
        }).css({
            width: '40px',
            float: 'left',
            marginRight: '10px'
        }).appendTo(profile_info);
        
        $('<p />').attr({
            
        }).css({
            
        }).html(
            
            '<strong><a href="/users/'+user.username+'">'
            +user.first_name+' '
            +user.last_name
            +'</a></strong><br /><small>'
            +user.email+'</small><br />'
            +''+user.joined
            
        ).appendTo(profile_info);
        
        menuContent += $('<div>').append(profile_info.clone()).remove().html();
        
        $(applications).each( function( i, v ) {
            pBuffer = $('<div>').css({
                color: '#FFFFFF'
            }).html( '<p><img style="width:25px; margin-right: 10px; vertical-align: middle;"" src="/images/icons/'+v.icon+'" />'+v.name+'</p>' );
            
            menuContent += $('<div>').append($(pBuffer).clone()).remove().html();
        });
        
        $('<div />').attr({
            id: "cura_menu",
            class: "go_menu"
        }).css({
            position : 'fixed',
            zIndex: '1000',
            top: '20px',
            left : '20px',
            minWidth : '300px',
            minHeight : '100px',
            backgroundColor : 'rgba(30, 30, 30, .8)',
            padding : '20px',
            margin : '0px',
            borderRadius : '.3em',
            display: 'none',
            color: '#FFFFFF',
            boxShadow: '4px 4px 50px 2px #000'
        }).html( menuContent ).appendTo('body');
        
        /*
         * Icon
         */ 
        
        var i = $('<img>').prop({
            src: '/images/icons/' + 'go.png'
        }).attr({
            id: 'go_icon',
            class: 'icon'
        }).css({
            position: 'relative',
            left : '15px',
            top : '3px',
            width : '35px',
            zIndex: '10000'
        }).hover(function(e) {
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
        }).click( function() {
            $('#cura_menu').toggle({
                easing: 'easeInOutCubic'
            });
        });
        $(function() {
            i.appendTo('#cura_taskbar');
        });
    },
    
    changeBackground: function(imgsrc) {
        this.bg = '/images/'+imgsrc;
        $(this.e).css('background', this.bg);
    },
    
    getWindowCount: function() {
        return this.windows.length;
    },
    
    getWindows: function() {
        return this.windows;
    },
    
    openWindow: function(win) {
        console.log(win);
        if (win === typeof Window) {
            this.windows.push(win);
            
        }
    },
    
    closeWindow: function(w) {
        this.windows.filter(function(i, v) {
            console.log(i + ' : ' + v);
            if (v !== w) {
                return v;
            }
        });
        this.e.removeChild(w);
    }

};

//sendMail('coreyaray@gmail.com', 'test', 'test');

$(document).on('mousedown', '.window_header', DragOn);
$(document).on('mouseup', '.window_header', DragOff);