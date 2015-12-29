<!DOCTYPE html>
<?php

?>
<html>
    <head>
        <title>404 Not Found</title>
    </head>
    <body style="
          background-color: #444444;
          color: #FFFFFF;
          text-align: center;
          margin: auto;
          ">
        <h1>Sorry, we couldn't find <?php echo filter_input (INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL ); ?></h1>
        
    </body>
</html>
