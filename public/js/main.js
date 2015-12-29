

function ExtractNumber(value) {
    var n = parseInt(value);
    return n === null || isNaN(n) ? 0 : n;
}

function ajaxGet(url) {
    if(url !== undefined) {
        
    }
    return null;
}

function ajaxGetJSON( table ) {
    if(table !== undefined ) {

    }
    return null;
};

function sendMail(to, message, subject) {
    $.ajax({

    });
}



function preload(arrayOfImages) {
    overlay();
    $(arrayOfImages).each(function(){
        $('<img/>')[0].src = '/images/'+this;
        // Alternatively you could use:
        // (new Image()).src = this;
    });
    liftOverlay();
}

// Usage:
//
//preload([
//    'img/imageName.jpg',
//    'img/anotherOne.jpg',
//    'img/blahblahblah.jpg'
//]);
//Or, if you want a jQuery plugin:

$.fn.preload = function() {
    this.each(function(){
        $('<img/>')[0].src = this;
    });
};

// Usage:
//$(['img1.jpg','img2.jpg','img3.jpg']).preload();



