<?php

/**
 * Default controller; Has built in session, cookie, and authentication.
 * @author Corey Ray <coreyaray@gmail.com>
 * @package ITE Framework
 * @copyright Copyright (C) 2015 ITE Solutions. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace controllers;

class IndexController extends \abstracts\Controller
{
    
    public function defaultAction() {
        
        
        
        
        $this->_view = \views\ViewFactory::getView();
        //require 'image.php';
        $file = _ROOT.DS.'public'.DS.'desktop.php';
        include $file;
    }
    
    public function RequesracallAction() {
       
        
        if (Input::exists() && Token::check(Input::get('token'))) {
            $this->_DB->insert('phones', array(
                'id' => 0,
                'name' => Input::get('name'),
                'number' => Input::get('number')
            ));
            $this->registerAction();
        }
        
        ?>
<form action="" method="post">
    <div class="field">
        <LABEL for="name">Name: </LABEL>
        <input
            type="text"
            name="name"
            id="name" />
    </div>
    <div class="field">
        <label for="number">Number: </label>
        <input
            type="tel"
            name="number"
            id="number" />
    </div>
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
    <input type="submit" value="Save"/>
</form>
        <?php
    
    
    }
    public function videoAction() {
        
//        if (!$user->isLoggedIn()) {
//            Redirect::to('index.php');
//        }

        $acceptedVideo = array('avi', 'mp4', 'webm', 'ogv', 'mpg', 'mpeg');
        $videos = array();
        foreach (glob(APP_ROOT . DS . "videos" . DS . "*.*") as $filename) {
            $ext = explode('.', $filename);
            $ext = array_pop($ext);

            if (in_array($ext, $acceptedVideo)) {
                $videos[] = $filename;
            }
        }
    }

    public function debugAction() {
        
    }
}

/*
CREATE TABLE `cura_desktop`.`session` ( `id` INT NOT NULL AUTO_INCREMENT , `time` TIMESTAMP NOT NULL , `exp` TIMESTAMP NOT NULL , `user_id` INT NOT NULL , PRIMARY KEY (`id`), INDEX `User Id` (`user_id`)) ENGINE = InnoDB;
 * */

?>