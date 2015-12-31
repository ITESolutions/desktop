<?php

/**
 * Invoice Module Controller
 * @author Corey Ray <coreyaray@gmail.com>
 * @package Cura Invoices Module
 * @copyright Copyright (C) 2015 ITE Solutions. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace controllers;

use Database;
use helpers;
use models;
use PDO;
//defined ('_ITE') or die;

class InvoicesController extends \abstracts\Controller {
    
    public function defaultAction() {
        echo "<h1>Invoices</h1><hr>";
        $db = Database::getConnection();
        $statement = $db->prepare("select * from invoices");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS);
        if (empty($results)) {
            echo "Sorry, No Invoices to display. Click <a href='/invoices/new'>here</a> to create a new one.";
        } else {
            foreach ($results as $result) {
                var_dump($result);
                
            }
        }
    }
}
