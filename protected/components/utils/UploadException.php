<?php

class UploadException extends Exception
{
    public __construct($code)
    {
        $message = $this->codeToMeesage($code);
        parent::__construct($message, $code);
    }
    private function codeToMessage($code)
    {
        switch ($code) {
            case UPLOAD_ERR_INI_SIZE:
                //$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                $message = 'The maximum file size for uploads is 20M';
                break;
            case UPLOAD_ERR_FORM_SIZE:
                //$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                $message = 'The maximum file size for uploads is 20M';
                break;
            case UPLOAD_ERR_PARTIAL:
                //$message = "The uploaded file was only partially uploaded";
                $message = 'The maximum file size for uploads is 20M';
                break;
            case UPLOAD_ERR_NO_FILE:
                $message = "No file was uploaded";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                //$message = "Missing a temporary folder";
                $message = 'The maximum file size for uploads is 20M';
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $message = "Failed to write file to disk";
                break;
            case UPLOAD_ERR_EXTENSION:
                //$message = "File upload stopped by extension";
                $message = 'The maximum file size for uploads is 20M';
                break;

            default:
                //$message = "Unknown upload error";
                $message = "Failure";
                break;
        }
        return $message;
        }
    }
}

?>
