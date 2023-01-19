<?php

$base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
require_once $base_path . 'config/database.php';
require_once $base_path . 'lib/database.php';

class AccessLevel {

    var $message;
    var $error_no;

    function create_group($group) {
        $mydb = new DataBase();
        $data = array('group_name' => $group);
        $mydb->insert('thekey_group', $data);
        if (mysql_errno() == 0) {
            return TRUE;
        } else {
            $this->message = mysql_error();
            $this->error_no = mysql_errno();
            return false;
        }
    }

    public function create_account($Full_Name, $UserName, $Password, $Access_Level) {
        $mydb = new DataBase();
        $data = array(
            'Full_Name' => $Full_Name,
            'UserName' => $UserName,
            'Password' => md5($Password),
            'Access_Level' => $Access_Level,
        );
        $result = $mydb->insert('users', $data);
    }

    function get_group() {
        $mydb = new DataBase();
        $result = $mydb->get('thekey_group');
        if ($result['count'] > 0) {
            return $result['result'];
        } else {
            return false;
        }
    }

    function delete_access($group_name) {
        $mydb = new DataBase();
        $mydb->where('group_name', $group_name);
        $mydb->delete('thekey_role');
    }

    public function Grant_AccessLevel($PageName, $group_name, $link) {

        $mydb = new DataBase();
        $data = array(
            'page' => $PageName,
            'group_name' => $group_name,
            'link' => $link
        );
        $mydb->insert('thekey_role', $data);
    }

    public function get_Granted_AccessLevel($group) {
        if (isset($_SESSION['MM_Username'])) {
            $mydb = new DataBase();
            $mydb->where('thekey_role.group_name', $group);
            $result = $mydb->get('thekey_role');
            if ($result['count'] > 0) {
                $new_result = array();
                foreach ($result['result'] as $key => $value) {
                    $new_result[$value['link']] = $value['page'];
                }
                return $new_result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function isAuthorized($page, $UserName) {
        $mydb = new DataBase();
        $mydb->join('thekey_role', 'users.Access_Level=thekey_role.group_name');
        $mydb->where('page', $page);
        $mydb->where('UserName', $UserName);
        $result = $mydb->get('users');
        if ($result['count'] > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function CHK_AccessLevel() {

        if (!session_id()) {
            //checking th esession wheter started or not if not start
            session_start();
        }

        $redirect = true;
        if (isset($_SESSION['MM_Username'])) {
            
            $redirect = FALSE;
            $user_name = $_SESSION['MM_Username'];
            $pagepath = $_SERVER['SCRIPT_NAME'];
            if (!$this->isAuthorized($pagepath, $user_name)) {
                if (!$this->isAuthorized(urldecode($pagepath . '?' . $_SERVER['QUERY_STRING']), $user_name)) {
                    $report = '';
                    $redirect = true;
                    if (isset($_GET['report'])) {
                        $report = '?report=' . $_GET['report'];
                        if ($this->isAuthorized(urldecode($pagepath .  $report), $user_name)) {
                            $redirect = false;
                        }
                    }
                }
            }
        }

        if ($redirect) {
            $port = $_SERVER['SERVER_PORT'];
            if ($port == 80) {
                $port = '';
            } else {
                $port = ':' . $port;
            }
            $base_url = 'http://' . $_SERVER['SERVER_NAME'] . $port . '/ThekeyHRMS/';
            $MM_restrictGoTo = $base_url . "login.php";
            $MM_qsChar = "?";
            $MM_referrer = $_SERVER['PHP_SELF'];
            if (strpos($MM_restrictGoTo, "?"))
                $MM_qsChar = "&";
            if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0)
                $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
            $MM_restrictGoTo = $MM_restrictGoTo . $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
            header("Location: " . $MM_restrictGoTo);
            exit;
        }
    }

    public function delete_department_access($group) {
        $mydb = new DataBase();
        $mydb->where('group_name', $group);
        $mydb->delete('thekey_department_data_access');
    }

    function grant_department($group, $department) {
        $data = array('Department' => $department, 'group_name' => $group);
        $mydb = new DataBase();
        $mydb->insert('thekey_department_data_access', $data);
    }

    function get_department_access($group) {
        $mydb = new DataBase();
        $mydb->where('group_name', $group);
        $result = $mydb->get('thekey_department_data_access');
        if ($result['count'] > 0) {
            $my_result = array();
            foreach ($result['result'] as $key => $value) {
                $my_result[$value['Department']] = $value['Department'];
            }
            return $my_result;
        } else {
            return false;
        }
    }

    function get_all_menu() {
        $mydb = new DataBase();
        $mydb->order_by('Auto_ID');
        $result = $mydb->get('pages');
        if ($result['count'] > 0) {
            $cur_menu = '';
            $parrent_menu = '';
            $my_menu_list = array();
            foreach ($result['result'] as $key => $value) {
                if ($cur_menu != $value['parrent_menu']) {
                    $cur_menu = $value['parrent_menu'];
                    if (!isset($my_menu_list[$cur_menu])) {
                        $my_menu_list[$cur_menu] = array();
                    }
                }
                $my_menu_list[$cur_menu][$value['Menu']] = $value['Link'];
            }
            foreach ($my_menu_list as $key => $value) {
                foreach ($value as $vkey => $vvalue) {
                    if (isset($my_menu_list[$vkey])) {
                        $my_menu_list[$key][$vkey] = $my_menu_list[$vkey];
                        unset($my_menu_list[$vkey]);
                    }
                }
            }

            return $my_menu_list;
        }
        else
            return array();
    }

    function get_all_menu_For_Role() {
        $mydb = new DataBase();
        $mydb->order_by('Auto_ID');
        $result = $mydb->get('pages');
        if ($result['count'] > 0) {
            $cur_menu = '';
            $parrent_menu = '';
            $my_menu_list = array();
            foreach ($result['result'] as $key => $value) {
                if ($cur_menu != $value['parrent_menu']) {
                    $cur_menu = $value['parrent_menu'];
                    if (!isset($my_menu_list[$cur_menu])) {
                        $my_menu_list[$cur_menu] = array();
                    }
                }
                $my_menu_list[$cur_menu][$value['Menu']] = $value['Link'];
            }
            foreach ($my_menu_list as $key => $value) {
                foreach ($value as $vkey => $vvalue) {
                    if (isset($my_menu_list[$vkey])) {
                        $my_menu_list[$key][$vkey] = $my_menu_list[$vkey];
                        unset($my_menu_list[$vkey]);
                    }
                }
            }

            return $my_menu_list;
        }
        else
            return array();
    }

    function get_my_menu() {
        $group = $_SESSION['MM_UserGroup'];
        $mydb = new DataBase();
        $my_menu = array();
        $result = $mydb->join('group_page', 'allowed_page=Auto_ID')
                ->select(array('Auto_ID', 'Menu', 'parrent_menu', 'Link'))
                ->where('group_name', $group)
                ->get('pages');
        if ($result['count'] > 0) {
            return false;
        } else {
            foreach ($result['result'] as $key => $value) {
                $my_menu[$value['Auto_ID']] = $value;
            }
        }
    }

}

?>