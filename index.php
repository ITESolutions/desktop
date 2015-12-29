<!DOCTYPE html>
<?php

/**
 * Cura Remixed
 * @author Corey Ray <coreyaray@gmail.com>
 * @package ITE Framework
 * @copyright Copyright (C) 2015 ITE Solutions. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */

//require 'image.php';
$defines = array(
    "USER" => "Corey",
    "TITLE" => 'CURA DESKTOP', 
    "SHOW_TASKBAR" => TRUE,
    "DESKTOP_BG" => 'cura-remastered-teaser.jpg',
    "FACEBOOK_HOME" => 'http://www.facebook.com/coreyaray'
);

foreach ($defines as $define => $value) {
    if (!defined ($define)) {
        define($define, $value);
    }
}

if (!defined("TITLE")) {
    define("TITLE", USER . ' - CURA DESKTOP');
}

?>

<head>
    <title><?php echo TITLE; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="css/jquery-ui-1.8.6.custom.css" rel="stylesheet" type="text/css"/>
    <link href="css/video.css" rel="stylesheet" type="text/css"/>
    <link href="css/AeroWindow.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script> 
    <script type="text/javascript" src="js/jquery-ui-1.8.1.custom.min.js"></script> 
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>        
    <script type="text/javascript" src="js/jquery-AeroWindow.min.js"></script>
    
	
	<!--
	<script type="text/javascript">
	function updateClock ( ) {   var currentTime = new Date ( );
    var currentHours = currentTime.getHours ( ); 
	var currentMinutes = currentTime.getMinutes ( );
	var currentSeconds = currentTime.getSeconds ( );
	currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
	currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
	var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM"; 
	currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;
	currentHours = ( currentHours == 0 ) ? 12 : currentHours;
	var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
	$("#TaskbarTime").html(currentTimeString); } 
    $(document).ready(function() {  setInterval('updateClock()', 1000); }); 
	</script>
	-->
    <style>
      * {
        margin: 0px;
        padding: 0px;
      }
      body {
        background: url(<?php echo DESKTOP_BG; ?>) no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        font-family: arial;
        overflow: hidden;
      }
      #link {
        position: absolute;
        bottom: 60px;
        right: 30px;
        color: white;
        font-size: 11px;
      }
      #link a:link, #link a:visited {
        color: white;
      }
      
    </style>
  </head>
  <body>

    <!-- 
    ###########################################################################
    Begin: HTML Content Container for Aero Windows ############################
    ########################################################################### 
    -->
    <div id="DesktopIcons">
      <ul style="display: none">
        <li><a href="/invoices/"><img src="images/icons/invoice.png" border="0">Invoices</a></li>
        <li><a href="/customers/"><img src="images/icons/contacts.png" border="0">Customers</a></li>
        <li><a href="/reports/"><img src="images/icons/report.png" border="0">Reports</a></li>
        <li><a target="_blank" href="<?php echo FACEBOOK_HOME; ?>"><img src="images/icons/facebook.png" border="0">Facebook</a></li>
        <li><a href="/help/"><img src="images/icons/help.png" border="0">Help with Cura</a></li>
      </ul>  
    </div>
    <!-- 
    ###########################################################################
    End: HTML Content Container for Aero Windows ##############################
    ########################################################################### 
    -->  

    <script type="text/javascript">
        var ShowTaskbar = true; 
        $(document).ready(function() {
        //Initialize Desktop Ic   ons ----------------------------------------------
        var desktop = $("body #DesktopIcons");
        var desktop_icons = $("a", desktop);
        $("ul", desktop).css("display", "none");

        desktop_icons.each(function (index) {
            
            $(this).AeroWindowLink();
        });
        desktop_icons.remove();
    });
    </script>
    

    
  </body>  
</html>
<?php
/*
CREATE TABLE `cura_desktop`.`session` ( `id` INT NOT NULL AUTO_INCREMENT , `time` TIMESTAMP NOT NULL , `exp` TIMESTAMP NOT NULL , `user_id` INT NOT NULL , PRIMARY KEY (`id`), INDEX `User Id` (`user_id`)) ENGINE = InnoDB;
 * */
?>