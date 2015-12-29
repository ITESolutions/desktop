<?php

/**
 * Description of DrawController
 *
 * @author Corey Ray <coreyaray@gmail.com>
 */

class DrawController extends ControllerAbstract
{
        public function defaultAction()
    {
        if (!$user->isLoggedIn()) {
            Session::flash('msg', 'You must be logged in to draw :(');
            Redirect::to('index.php');
        }
        
        include 'draw.php';
    }
}
