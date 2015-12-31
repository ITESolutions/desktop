<?php

/**
 * InstallController
 *
 * @author corey
 */

namespace Framework\Controllers;
use Framework\Abstracts\ControllerAbstract;
use Framework\Helpers\Router;
use Framework\Helpers\Upload;
use RuntimeException;
use ZipArchive;
use SimpleXMLElement;

class InstallController extends ControllerAbstract
{
    const PACKAGE_MANIFEST = 'manifest.xml';
    const MAX_MANIFEST_SIZE = 64000;
    
    public function defaultAction() {
        
    }
    
    public function setupAction() {
        $page = Router::Id();
        $this->initView();
    }

    public function extensionAction() {
        try {
            $upload = new Upload('extension');
            $upload->validate([
                'application/zip',
                'application/x-zip-compressed',
                'multipart/x-zip',
                'application/x-compressed'
            ]);
            $upload->move();
            $zip = new ZipArchive();
            
            if (TRUE !== $zip->open ($upload)) {
                throw new \RuntimeException();
            }
            
            $manifest_xml = fread ($zip->getStream (self::PACKAGE_MANIFEST), self::MAX_MANIFEST_SIZE);
            $package_data = new SimpleXMLElement($manifest_xml);

            
            echo '<pre>'. PHP_EOL . print_r($package_data['module']);
            foreach ($package_data->children() as $Item) {
                //Now you can access the 'row' data using $Item in this case 
                //two elements, a name and an array of key/value pairs
                echo $Item->Name;
                //Loop through the attribute array to access the 'fields'.
                foreach($Item->Attribute as $Attribute){
                    //Each attribute has two elements, name and value.
                    echo $Attribute->Name . ": " . $Attribute->Value;
                }
            }
            //ECHO "<pre>"; var_dump($package_data->children());
            $zip->close();

            echo "Your .zip file was uploaded and unpacked.";
        } catch (RuntimeException $e) {
            echo $e->getMessage();
        }
    }
}
