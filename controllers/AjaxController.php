<?php

/**
 * Description of AjaxController
 *
 * @author Corey
 */
namespace Framework\Cura\Controllers;
use Framework\Cura\helpers as helpers;

class AjaxController extends ControllerAbstract
{
    public function defaultAction() {
        die('default');
    }
    
    public function LoremIpsumAction () {
        die('Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.');
    }
    
    public function GetAction() {
        $db = helpers\Database::getInstance();
        $table = filter_input(INPUT_POST, 'table');
        $stmnt = $db->get($table, array(1, '=', 1));
        $results = $stmnt->results();
        $json = json_encode($results);
        header('Content-Type: application/json');
        die($json);
    }
    
    public function GetPageAction() {
        
        $url = filter_input(INPUT_GET, 'url');
        $options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            //CURLOPT_USERAGENT      => 'spider', // **ERROR Caused loss of styling in Chrome; who am i ??$_SERVER['HTTP_USER_AGENT']
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 1,       // stop after ? redirects
            CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
//        $err     = curl_errno( $ch );
//        $errmsg  = curl_error( $ch );
          $header  = curl_getinfo( $ch );
        curl_close( $ch );
//        $header['errno']   = $err;
//        $header['errmsg']  = $errmsg;
//        $header['content'] = $content;

        $url = $header['url'];
        libxml_use_internal_errors(TRUE);
        $dom = new \DOMDocument();
        $dom->loadHTML($content);
        libxml_clear_errors();
        
        $base = $dom->createElement('base');
        $base->setAttribute('target', '_self');
        
        $head = $dom->getElementsByTagName('head')->item(0);
        if ($head->hasChildNodes()) {
            $head->insertBefore($base, $head->firstChild);
        } else {
            $head->appendChild($base);
        }
        
        foreach ($dom->getElementsByTagName('a') as $node) {
            $href = $node->getAttribute('href');
            
            $node->setAttribute('href', '/ajax/get-page?url=' . $href);
            $node->setAttribute('target', '_self');
        }
        
        foreach ($dom->getElementsByTagName('img') as $node) {
            $src = $node->getAttribute('src');
            if ($src[0] == '/') {
                $src = substr($src, 1);
            }
            $node->setAttribute('src', $url . $src);
        }
        header_remove(); 
        //header('X-Frame-Options:', true); 
        echo $dom->saveHTML();
        exit();
    }
    
    public function MailAction() {
        //
        $to      = filter_input(INPUT_POST, 'to');
        $subject = filter_input(INPUT_POST, 'subject');
        $message = filter_input(INPUT_POST, 'message');
        $headers = 'From: webmaster@example.com' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $success = mail($to, $subject, $message, $headers);
        
        if ( $success ) {
            die('Mail sent successfully');
        }
        die ( 'Error' );
    }
}
