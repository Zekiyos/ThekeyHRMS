
<?php

class Recruitment {

    public function insert($table, $values, $rows = null) {

        $insert = 'INSERT INTO ' . $table;
        if ($rows != null) {
            $insert .= ' (' . $rows . ')';
        }

        for ($i = 0; $i < count($values); $i++) {
            if (is_string($values[$i]))
                $values[$i] = '"' . $values[$i] . '"';
        }
        $values = implode(',', $values);
        $insert .= ' VALUES (' . $values . ')';

        
        $ins = @mysql_query($insert);
       //echo '<hr>'.$insert;
        if ($ins) {
            return true;
        } else {
            return false;
        }
    }

}

//class clossing brace
?>