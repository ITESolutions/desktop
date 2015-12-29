<!DOCTYPE html>
<html>
    <head>
        <link rel=stylesheet type=text/css href="/css/stylesheet.css">
        
        <script type="text/javascript">
function expand(id) {
    
    var target = document.getElementById(id);
    if (target === null) {
        console.log('Target ID not found: ' + id);
        return false;
    }
    var h = target.offsetHeight;
    var sh = target.scrollHeight;
    
    var lt = setTimeout('expand(\'' + id + '\')', 8);
    if (h < sh) {
        h += 1;
        target.style.height = h + 'px';
    } else {
        clearTimeout(lt);
    }
}

function retract(id) {
    
    var target = document.getElementById(id);
    
    if (target === null) {
        console.log('Target ID not found: ' + id);
        return false;
    }
    var h = target.offsetHeight;
    var lt = setTimeout('retract(\'' + id + '\')', 8);
    if (h > 0) {
        
        h = h - 2;
        
        target.style.height = h + 'px';
    } else {
        clearTimeout(lt);
    }
}
        </script>
    </head>
    <body onload="startTime()">
        <h1 id="trigger" onclick="expand('target');">Click Here</h1>
        <p id="target" style="height: 0px; overflow: hidden;" onclick="retract('target');">
            
            
            
            	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                
        </p>

<div id="txt"></div>

<script>
function startTime()
{
var today = new Date();
var h = today.getHours();
var m = today.getMinutes();
var s = today.getSeconds();
// add a zero in front of numbers<10
m = checkTime(m);
s = checkTime(s);
document.getElementById("txt").innerHTML=h+":"+m+":"+s;
t = setTimeout(function(){startTime()},500);
}

function checkTime(i)
{
if (i<10)
  {
  i="0" + i;
  }
return i;
}
</script>

</body>
</html>
