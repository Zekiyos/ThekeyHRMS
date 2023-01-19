<?php
/**
 * Small Wrapper class to manage Languages stored in a MySQL DB

 */
class Language {
 
    var $defaultlang = "en";	// Default Language
 
    var $languages = array("en");
 
    // mysqli instance;
    var $db;
 
    function __construct($db="", $defaultlang="") {
		mysql_select_db('language');
        if($db != "") {
            $this->db = $db;
        } else {
            $this->db = new mysqli();
        }
        if($defaultlang != "") {
            $this->defaultlang = $defaultlang;
        }
        $this->languages = $this->getLanguageIDs();
    }
 
    /**
     * Get text from DB given a specific Text ID and Language
     */
    public function get($textid, $langid="") {
        if($langid == "") {
            $langid = $this->defaultlang;
        }
      	$query = "SELECT text FROM lang_$langid WHERE textid='$textid'";
        $result = mysql_query($query) or die(mysql_error());
        $row = mysql_fetch_array($result);
        $text = $row[0];
        if($langid == $this->defaultlang) {  // if language is default, return the langauge unchecked.
            return $text;
        } else {
            if($text != "") { // Is text field un-translated? (i.e. not empty string)
                return $text;
            } else { // If not, query using default language
                return $this->get($textid, $this->defaultlang);
            }
        }
        return "";
    }
 
    /**
     * Return an Array of Language IDs of each language in the Database
     */
    public function getLanguageIDs() {
        $languages = array();
        $sql = "SELECT `lang` FROM `languages`";
        $result = mysql_query($sql);
        $i = 0;
        while($row = mysql_fetch_array($result)) {
            $languages[$i] = $row[0];
            $i++;
        }
        return $languages;
    }
 
    /**
     * Return an Array of Descriptions of each language in the Database.
     */
    public function getLanguageDescriptions() {
        $languagesDesc = array();
        $sql = "SELECT description FROM languages";
        $result = mysql_query($sql) or die(mysql_error());
        $i = 0;
        while($row = mysql_fetch_array( $result )) {
            $languagesDesc[$i] = $row[0];
            $i++;
        }
        return $languagesDesc;
    }
 
    /**
     * Delete a Text ID from all Language Tables
     * @param $textid
     */
    public function deleteTextID($textid) {
        if($textid != "") {
            $numLanguages = count($this->languages);
            for($i = 0; $i < $numLanguages; $i++) {
                $sql = "DELETE FROM lang_".$this->languages[$i]." WHERE textid='$textid'";
                $result = mysql_query($sql) or die(mysql_error());
            }
            $status = "Deleted TextID ".$textid;
        }
        return $status;
    }
 
    /**
     * Update Text for a specific Language
     * @param $langid
     * @param $textid
     * @param $text
     */
    public function updateText($langid, $textid, $text) {
        if($langid != "" && $textid != "" && $text != "") {
            $sql = "UPDATE lang_$langid SET text='$text' WHERE textid='$textid' ";
            $result = mysql_query($sql) or die(mysql_error());
            $status = "Updated Entry";
        }
	return $status;
    }
 
    /**
     * Delete a Language from the Database
     * @param $langid
     */
    public function deleteLanguage($langid) {
    	if($langid != "") {
            $sql = "DROP TABLE IF EXISTS lang_".$langid;
            $result = mysql_query($sql) or die(mysql_error());
            $sql = "DELETE FROM languages WHERE lang='$langid'";
            $result = mysql_query($sql) or die(mysql_error());
        }
	return "Deleted Language Table ".$langid;
    }
 
    /**
     * Add TextID field to all language databases
     * @param $textid
     */
    public function addTextID($textid) {
        $numLanguages = count($this->languages);
        for($i = 0; $i < $numLanguages; $i++) {
            $status = $status.$this->languages[$i];
            $sql = "INSERT INTO lang_".$this->languages[$i]." (`textid`, `text`) VALUES ('$textid', '')";
            $result = mysql_query($sql) or die(mysql_error());
        }
        $status = $status."Added Text ID";
        return $status;
    }
 
    /**
     * Add a new Language
     * @paam $langID is typically a 2 letter ID (English is 'en', Japanese is 'jp')
     * The created database is 'lang_$langID' (lang_en, lang_jp)
     * @param $langDesc is the Description for the language.
     */
    public function addLanguage($langid, $langdesc) {
    	if($langid != "" && $langdesc != "") {
            $sql = "INSERT INTO languages (`lang`, `description`) VALUES ('$langid', '$langdesc')";
            $result = mysql_query($sql) or die(mysql_error());
            $sql = "CREATE TABLE IF NOT EXISTS `lang_$langid` (
        	`textid` varchar(255) collate latin1_general_ci NOT NULL,
                `text` longtext charset utf8 collate utf8_unicode_ci NOT NULL
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
            $result = mysql_query($sql) or die(mysql_error());
            $sql = "SELECT textid FROM lang_en";
            $result = mysql_query($sql) or die(mysql_error());
            while($row = mysql_fetch_array($result)) {
                $sql = "INSERT INTO lang_$langid (`textid`, `text`) VALUES ('$row[0]', '')";
        	$result2 = mysql_query($sql) or die(mysql_error());
            }
            $status = "Added Language";
	}
        return $status;
    }
 
}
?>