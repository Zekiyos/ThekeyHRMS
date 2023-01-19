<?php

if (!defined('validurl'))
    exit('No direct script access allowed');

/**
 * Description of file_upload Allow to upload files
 *
 * @author Raju Mesfin Salilih rajumesfin@gmail.com
 *
 */
class file_upload {

    private $_uploadedfiles = array();
    private $_allowedtype = array();
    private $_maxsize;
    private $_uploadpath;
    private $_error = array("There is no error, the file uploaded with success.",
        "The uploaded file exceeds 2mb",
        "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form. ",
        "The uploaded file was only partially uploaded. ",
        "No file was uploaded. ",
        "",
        "Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.",
        "Failed to write file to disk. Introduced in PHP 5.1.0. ",
        "A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help. Introduced in PHP 5.2.0. "
    );
    private $error = array();

    /**
     * This function Set Allowed file type for upload
     * @param String $type Type of files that is allowed to be uploded
     * <b>Example</b>
     * jpg  pnp gif
     */
    function allowedType($type) {
        $this->_allowedtype[] = $type;
    }

    /**
     * This function return array contina every error occured when file upload process
     * @return Array List of Error
     */
    function showerror() {
        return $this->error;
    }

    /**
     * This funciton allow to set where the file is going to be uploaded
     * @param String $path
     */
    public function uploadpath($path) {
        $this->_uploadpath = $path;
    }

    /**
     * This function allow to set maximum file size
     * @param Integer $size
     */
    function maxsize($size) {
        $this->_maxsize = $size;
    }

    /**
     * This function handle file upload
     * Upload Every file once
     */
    function doupload($myfilename = '',$overwrite=false) {
        foreach ($_FILES as $key => $value) {
            if (is_array($value["name"])) {
                foreach ($value["name"] as $fileskey => $filesvalue) {
                    if ($filesvalue != "") {
                        if ($myfilename == '')
                            $filename = $value["name"][$fileskey];
                        else
                            $filename = $myfilename;
                        $type = $value["type"][$fileskey];
                        $tmp_name = $value["tmp_name"][$fileskey];
                        $error = $value["error"][$fileskey];
                        $size = $value["size"][$fileskey];
                        $this->upload($filename, $type, $tmp_name, $error, $size,$overwrite);
                    }
                }
            } else {

                if ($myfilename == '')
                    $filename = $value["name"];
                else
                    $filename = $myfilename;
                $type = $value["type"];
                $tmp_name = $value["tmp_name"];
                $error = $value["error"];
                $size = $value["size"];
                $this->upload($filename, $type, $tmp_name, $error, $size,$overwrite);
            }
        }
    }

    private function upload($filename, $type, $tmp_name, $error, $size,$overwrite=false) {
        if ($error == 0) {
            $fileuploadpath = $this->_uploadpath == "" ? $filename : $this->_uploadpath . "/" . $filename;
            if (!$this->isAllowedType($filename)) {
                $this->error[] = "This File Type not allowed to Upload " . $filename;
                return 0;
            }
            if (!file_exists($fileuploadpath) || $overwrite) {

                if (is_writable($this->_uploadpath)) {
                    if (move_uploaded_file($tmp_name, $fileuploadpath)) {
                        $this->_uploadedfiles[] = $filename;
                    } else {
                        $this->error[] = " File " . $filename . " not Uploaded";
                    }
                } else {
                    $this->error[] = "The Folder is not Writeble";
                }
            } else {
                $this->error[] = "File \"" . $filename . "\" Alrady Availeble you can't overwrite";
            }
        } else {
            $this->error[] = $this->_error[$error];
        }
    }

    private function isAllowedType($filename) {
        $pattern = "";
        foreach ($this->_allowedtype as $key => $value) {
            if ($pattern == "") {
                $pattern = $value;
            } else {
                $pattern .= "|" . $value;
            }
        }
        if ($pattern != "") {
            $pattern = "/[.](" . $pattern . ")$/";
            if (preg_match($pattern, $filename)) {
                return true;
            } else {
                return false;
            }
        } else {
            return True;
        }
    }

    public function uploadedfiles() {
        return $this->_uploadedfiles;
    }

}

?>
