var TaskList = function() {
    this.w = new Window('Task List');
    this.newList();
};

TaskList.prototype = {
    newList: function() {
        $(this.w).appendTo($('#desktop'));
    }
};

var tl = new TaskList();