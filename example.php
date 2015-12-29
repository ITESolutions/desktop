<?php
if (!isset($_GET['data'])) {
    $data = 'Nothing sent';
} else {
    $data = $_GET['data'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Example</title>
    </head>
    <body>
        <h1>
            <?php echo $data; ?>
        </h1>
        <script>
            console.log('This is Javascript at work');
        </script>
    </body>
</html>