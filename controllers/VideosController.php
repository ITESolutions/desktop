<?php

class VideosController extends ControllerAbstract
{
    private $_acceptedFormats = array('avi', 'mp4', 'webm', 'ogv', 'mpg', 'mpeg');
    
    public function __construct($action = null, $id = null) {
        parent::__construct($action);
        $this->_videosFolder = APP_ROOT . DS . "videos" . DS;
    }

    public function defaultAction() {
//        $user = new User();
//        if (!$user->isLoggedIn()) {
//            Redirect::to('index.php');
//        }

        
        foreach (glob($this->_videosFolder . "*.*") as $filename) {
            $extArray = explode('.', $filename);
            $ext = array_pop($extArray);

            if (in_array($ext, $this->_acceptedFormats)) {
                $videos[] = $filename;
            }
        }
        
        ?>
<html>
    <head>
        <title>Videos</title>
        <link rel="stylesheet" type="text/css" href="videos.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body>
        <ul>
<?php 
foreach ($videos as $filename) {
    echo '<li><a href="view.php?file=' . urlencode($filename) . '">' . $filename . '</a></li>';
}

?>
        </ul>
    </body>
</html>
<?php
    }
    
    public function watchAction() {
        if (!Input::exists('get') || !isset($_GET['file'])) {
            Redirect::to('videos.php');
        }
        $filename = Input::get('file');

        $ext = explode('.', $filename);
        $ext = array_pop($ext);


//if (!$this->_user->isLoggedIn()) {
//    Redirect::to('index.php');
//}

?>
<html>
    <head>
        <title>Videos - <?php echo $filename; ?></title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body>
        <section>
            <button id="small">Small</button>
            <button id="medium">Medium</button>
            <button id="large">Large</button>
            <button id="original">Original</button>
            <br />
            <video id="video" width="720" controls >
                <source src="<?php echo $filename; ?>" type="video/<?php echo $ext; ?>">
                Video not supported!
            </video>
            <script src="video.js"></script>
        </section>
    </body>
</html>
<?php

    }
}
