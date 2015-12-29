<!DOCTYPE html>
<?php
/**
 * Cura Remixed
 * @author Corey Ray <coreyaray@gmail.com>
 * @package ITE Framework
 * @copyright Copyright (C) 2015 ITE Solutions. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
?>

<head>
    <title>Cura Desktop</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="/css/jquery-ui-1.8.6.custom.css" rel="stylesheet" type="text/css"/>
    <link href="/css/AeroWindow.css" rel="stylesheet" type="text/css"/>
    <link href="/css/CuraAudioplayer.css" rel="stylesheet" type="text/css"/>
    <script src="/js/jquery-1.4.2.min.js"></script> 
    <script src="/js/jquery-ui-1.8.1.custom.min.js"></script> 
    <script src="/js/jquery.easing.1.3.js"></script>        
    <script src="/js/jquery-AeroWindow.min.js"></script>

	-->
    <style>
      * {
        margin: 0px;
        padding: 0px;
      }
      body {
        background: url(/images/cura-remastered-teaser.jpg) no-repeat center center fixed; 
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
            <li><a target="_blank" href="/"><img src="images/icons/facebook.png" border="0">Facebook</a></li>
            <li><a href="/settings"><img src="/images/icons/settings.png" border="0">Settings</a></li>
            <li><a href="/help/"><img src="/images/icons/help.png" border="0">Help with Cura</a></li>
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