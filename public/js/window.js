

var Window = function(title, content, width, height, x, y ) {
    
    this.title = title === undefined ? 'Untitled Window'  : title;
    this.content = content === undefined ? ajaxGet('/ajax/lorem-ipsum') : content;
    this.width = width === undefined ? '500px' : width;
    this.height = height === undefined ? '300px' : height;
    this.x = (x === undefined) ? (window.innerWidth / width) : x;
    this.y = (y === undefined) ? (window.innerHeight / height) : y;
    this.id = this.title.substring(0, this.title.indexOf(" "));
    this.initialize();
    $((function(e) {
        e.appendTo('body');    
    })(this.e));
};


Window.prototype = {
    initialize: function() {
        
        // Window Outer Div
        this.e = $('<div />')
        .attr({
            id: this.id,
            class: 'window'
        })
        .resizable()
        .css({
            position: "absolute",
            resize: 'both',
            left: this.x + 'px',
            top: this.y + 'px',
            maxWidth: window.width + 'px',
            maxHeight: window.width + 'px',
            border: "1px solid #333",
            padding: '10px',
            margin: '10px',
            zIndex: '10000'
            
        });
        
        
        // Window Header
        $('<div />')
        .attr({
            id: this.e.id + '_header',
            class: 'window_header drag_handle' // @todo change event handler to use drag_handle
        })
        .css({
            height: '20px',
            textAlign: 'center'
        })
        .html('<h6>'+this.title+'</h6>')
        .appendTo(this.e);
        
        // Window Content
        $('<div />')
            .attr({
                id: '',
                class: 'window_content'
            }).css({
                margin: '0px',
                padding: '0px',
                background: '#ffffff',
                width: this.width,
                height: this.height,
                overflow: 'hidden'
            }).html(this.content)
            .appendTo(this.e);
    },
    
    changeContent: function(html) {
        this.content = html;
    },
    
    getContent: function() {
        return this.e.html();
    },
    
    addContent: function(html) {
        if (html !== undefined) {
            this.content += html;
        }
    }
    
};


function DragOn(e) {
    var dragDiv = this.parentNode;
    
    $.each($('.window'), function(i, v) {
        $(v).css('zIndex', '1');
    });
    dragDiv.style.zIndex = "1000";
    
    var relativeXPosition = (e.pageX - dragDiv.offsetLeft);
    var relativeYPosition = (e.pageY - dragDiv.offsetTop);
    $(document).on('mousemove', function(e) {
       $(dragDiv).offset({
           top: e.pageY - relativeYPosition,
           left: e.pageX - relativeXPosition
        });
    });
    document.body.focus();
    // prevent text selection in IE
    document.onselectstart = function () { return false; };
    // prevent IE from trying to drag an image
    dragDiv.ondragstart = function() { return false; };

    // prevent text selection (except IE)
    return false;

}

function DragOff() {
    $(document).off('mousemove');
}
   


//        srcdoc: body,
//        scrolling: 'no',
//        name: 'window_1'
//    }).css({
//        