<?php
if (!function_exists("alert")) {

    function alert($message) {
        echo "<script type=\"text/javascript\">alert('$message')</script>";
    }

}

function filter($mydb, $no_role = false) {
    if (isset($_POST['filed_name'])) {
        $user_post = $_POST;
        $_SESSION['filed_name'] = $user_post;
    } else {
        if (isset($_SESSION['filed_name'])) {
            $user_post = $_SESSION['filed_name'];
        }
    }



    if (isset($user_post)) {
        foreach ($user_post['filed_name'] as $key => $value) {
            if ($value != '') {
                if ($user_post['operator'][$key] != '') {
                    if ($user_post['value'][$key] != '') {
                        if ($user_post['operator'][$key] == 'Like') {
                            $mydb->like($value, $user_post['value'][$key]);
                        } else {
                            //$mydb->select($value);
                            $mydb->where($value . $user_post['operator'][$key], $user_post['value'][$key]);
                        }
                    }
                }
            }
        }
    }

    if (!$no_role) {
        $obj_AccessLevel = new AccessLevel();
        $selecte_group = $_SESSION['MM_UserGroup'];
        $my_department = $obj_AccessLevel->get_department_access($selecte_group);
        if ($my_department) {
            foreach ($my_department as $key => $value) {
                $mydb->or_where(array('Department' => $value));
            }
        }
    }
    if (isset($_GET['sort_by'])) {
        $sort_by = $_GET['sort_by'];
        $sort_order = 'asc';
        if (isset($_GET['sort_order'])) {
            $sort_order = $_GET['sort_order'];
        }

        $mydb->order_by($sort_by, $sort_order);
    }

    if (isset($_POST))
        if (!$no_role) {
            if (isset($_POST['per_page'])) {
                $per_page = $_POST['per_page'];
                $_SESSION['per_page'] = $per_page;
            } else {
                if (isset($_SESSION['per_page'])) {
                    $per_page = $_SESSION['per_page'];
                } else {
                    $_SESSION['per_page'] = 20;
                    $per_page = 20;
                }
            }

            $offset = isset($_GET['navpage']) ? $_GET['navpage'] : $per_page;
            if (!isset($_GET['export'])) {
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    if ($page == 0) {
                        $page = 1;
                    }
                    if ($per_page != 'All')
                        $mydb->set_limit($per_page, ($page - 1) * $per_page, $offset - $per_page);
                } else {
                    if ($per_page != 'All')
                        $mydb->set_limit($per_page, $offset - $per_page);
                }
            }
        }
    return $mydb;
}

$mydb = new DataBase();

$comp_result = $mydb->get('company_settings', 1);
if ($comp_result['count'] > 0) {
    $company_info = $comp_result['result'][0];
}
?>

<header>
    <div id="top_line">&nbsp;</div>
    <div id="sys_info">
        <img src="http://<?php echo $base_url ?>images/sys_log.png"/>

        <div id="time_bar">
            <div><label id="ctime">10:20:20 AM</label>  <?php echo date('M d Y'); ?>  <a id="date_converter">Date Converter</a></div>
            <div id="date_convert_bar">
                <input type="date" id="date_convert"/>
                <img src="http://<?php echo $base_url ?>images/convert.png" id="date_convert_button"/>
                <label id="converted_date"></label>
            </div>
        </div>
        <div id="language_bar">
            <?php
            $lang_list = array('am' => 'Amharic', 'en' => 'English', 'nl' => 'Duch', 'or' => 'Oromifa');
            ?>
            <ul>
                <?php
                $base_url = $_SERVER['SERVER_NAME'] . $port . '/ThekeyHRMS/';

                $cur_file = 'http://' . $_SERVER['SERVER_NAME'] . $port . $_SERVER['SCRIPT_NAME'] . '?lang=';
                if (isset($lang_list[$lang])):
                    unset($lang_list[$lang]);
                    ?>
                    <li>
                        <a>
                            <img src="http://<?php echo $base_url ?>images/<?php echo $lang ?>.png">
                        </a>
                    </li>
                    <li><img src="http://<?php echo $base_url ?>images/lang_arrow.png"></li>
                <?php endif; ?>
                <?php foreach ($lang_list as $key => $value): ?>
                    <li>
                        <a href="<?php echo $cur_file . $key ?>">
                            <img src="http://<?php echo $base_url ?>images/<?php echo $key ?>.png">
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>


        </div>
        <h3>Human Resource Management System </h3>
    </div>
    <div id="menu">
        <ul>
            <li><a href="http://<?php echo $base_url ?>"><img src="http://<?php echo $base_url ?>images/home.png" height="24px"/></a></li>
            <?php
            require_once $base_path . 'Templates/menu.php';
            foreach ($newmenu as $key => $value) {
                if (is_array($value)) {
                    echo '<li>';
                    echo '<a>' . $obj_lang->get($key, $lang) . '</a>';
                    echo '<ul>';
                    foreach ($value as $subkey => $subvalue) {
                        if (is_array($subvalue)) {
                            echo '<li class="sub_menu_parrent">';
                            echo '<a>' . $obj_lang->get($subkey, $lang) . '</a>';
                            echo '<ul>';
                            foreach ($subvalue as $subsubkey => $subsubvalue) {
                                echo '<li><a href="http://' . $base_url . $subsubvalue . '">' . $obj_lang->get($subsubkey, $lang) . '</a> </li>';
                            }
                            echo '</ul>';
                            echo '</li>';
                        } else {
                            echo '<li><a href="http://' . $base_url . $subvalue . '">' . $obj_lang->get($subkey, $lang) . '</a> </li>';
                        }
                    }
                    echo '</ul>';
                    echo '</li>';
                } else {
                    echo '<li><a href="' . $value . '">' . $obj_lang->get($key, $lang) . '</a> </li>';
                }
            }
            ?>
            <li><a href="http://<?php echo $base_url ?>login.php?logout">Logout</a></li>
        </ul>
    </div>
</header>
<?php if (isset($error_message)): ?>
    <?php if ($error_message != '') : ?>
        <div class="ui-widget my_notification">
            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
                <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                    <strong>Alert:</strong> <?php echo $error_message; ?></p>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php if (isset($message)): ?>
    <?php if ($message != '') : ?>
        <div class="ui-widget my_notification">
            <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
                <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                    <strong>Hey!</strong> <?php echo $message; ?></p>
            </div>
            
        </div>
    <?php endif; ?>
<?php endif; ?>
<div id="pop_up_help"></div>