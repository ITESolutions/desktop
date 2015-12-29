<?php

namespace Framework\Helpers;
use RuntimeException;


/**
 * Uploaded file object class
 * @author Corey Ray <coreyaray@gmail.com>
 */

class Upload
{
    /**
     * The name of the file when it was uploaded
     * @var type string;
     */
    private $_uploadedFile;
    
    /**
     * The temporary name of the file after upload
     * @var type string
     */
    private $_tempName;
    
    /**
     * The new name given to the file after moving. Will be false if file has not been moved yet.
     * @var type string or bool
     */
    private $_newName;
    
    /**
     * The file extension of the upload
     * @var type string
     */
    private $_extension;
    
    /**
     * The size of the file in bytes
     * @var type string
     */
    private $_fileSize;
    
    /**
     * Mime type of uploaded file
     * @var type string
     */
    private $_mimeType;

    /**
     * Array of zip file mime types
     * @var type array
     * @deprecated since version 1
     */
    protected $zipMimes = [
        'application/zip',
        'application/x-zip-compressed',
        'multipart/x-zip',
        'application/x-compressed'
        ];
    
    /**
     * Array of image file types
     * @var type array
     * @deprecated since version 0.5.16 BETA
     */
    protected $imageMimes = [
        'image/png',
        'image/jpg',
        'image/jpeg',
        'image/gif'
    ];
    
    /**
     * 
     * @param string $input_name The name of input field of the upload form
     */
    public function __construct($input_name) {
        if ( !isset($_FILES[$input_name])) { throw new RuntimeException('No upload'); }
        $upload = $_FILES[$input_name];
        if (!$upload['error'] === UPLOAD_ERR_OK) { throw new UploadException($upload['error']); }
        $this->_initialize($upload);
    }
    
    /**
     * Initialize the upload class
     * @param string $upload The key value of the $_FILES superglobal to use
     */
    private function _initialize($upload) {
        
        $this->_uploadedFile = $upload['name'];
        $this->_tempName = $upload['tmp_name'];
        $this->_fileSize = $upload['size'];
        $this->_extension = getFileExtension ($this->_uploadedFile);
        $this->_mimeType = getFileType($this->_tempName);
        
    }
    
    /**
     * Validates the uploaded file by checking its MIME type against an array of acceptable values
     * @param array $accepted_mimes
     * @throws RuntimeException
     */
    final public function validate(array $accepted_mimes) {
        if (!in_array($this->_mimeType, $accepted_mimes)) {
            throw new RuntimeException('Invalid file type: ' . $this->_mimeType);
        }
    }
    
    
    final public function move() {
        $this->_generateNewName();
        if (!move_uploaded_file ($this->_tempName, $this->_newName)) {
            throw new RuntimeException('Failed to move uploaded file.');
        }
    }
    
    final private function _generateNewName() {
        $this->_newName = APP_ROOT . DS . 'uploads' . DS . sha1_file($this->_tempName) . $this->_extension;
    }


    final public function moved() {
        return boolval ($this->_newName);
    }
    
    public function __toString() {
        return htmlentities($this->_newName);
    }
}
