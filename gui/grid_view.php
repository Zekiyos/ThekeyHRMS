<?php if (!isset($_GET['export'])): ?>
    <div id="popup_update"></div>
    <?php
    $port = $_SERVER['SERVER_PORT'];
    if ($port == 80) {
        $port = '';
    } else {
        if (!preg_match('/[:]/', $port))
            $port = ':' . $port;
    }
    $nbase_url = $_SERVER['SERVER_NAME'] . $port;
   
    $nbase_url = 'http://' . $nbase_url . '/' . $_SERVER['PHP_SELF'];
    
    if (isset($_GET['report'])) {
        $nbase_url .= '?report=' . $_GET['report'] . '&';
    } else {
        $nbase_url .='?';
    }
    $base_path = $_SERVER['DOCUMENT_ROOT'] . '/ThekeyHRMS/';
    require_once $base_path . 'lib/database.php';
    require_once $base_path . 'lib/gride.php';


    if (isset($header_lable)) {
        echo "<h1 class=\"form_lable\">$header_lable</h1>";
    }
    ?>
    <div id="export_tool_bar">
        <ul>
            <li><a href="<?php echo $nbase_url . 'export=excel' ?>"><img src="http://<?php echo $base_url ?>images/excel.png" alt="Export As Excel File" title="Export As Excel File"/></a></li>
        </ul>
    </div>
    <form method="post">
        <div id="my_tool_bar">
            <?php
            require_once $base_path . 'gui/search_bar.php';
            if (isset($this_is_report)) {
                require_once $base_path . 'gui/aggregate_bar.php';
            }
            ?>
        </div>


        <div id="grid_page">

            <?php
            if (isset($_SESSION['per_page'])) {
                $per_page = $_SESSION['per_page'];
            } else {
                $_SESSION['per_page'] = 20;
                $per_page = 20;
            }

            $my_page = new pagination();
            $my_page->set_element_per_page($per_page);

            $my_page->baseurl($nbase_url);
            if (!isset($total_num_row) && isset($table)) {
                $mydb = new DataBase();
                $count_me = $mydb->count($table);
                $total_num_row = $count_me;
            }
            $my_page->totalelement(isset($total_num_row) ? $total_num_row : count($result)-1);
            echo $my_page->generatepagination();
            ?>

            <label>
                <?php
                $list_per_page = array(20 => 20, 30 => 30, 50 => 50, 75 => 75, 100 => 100, 200 => 200, 'All' => 'All');
                $myform = new Form();
                echo $myform->html_dropdown($list_per_page, $per_page, 'per_page');
                ?>
                Record Per Page  
            </label>
        </div>

    </form>

    <div id="grid_view_content">
        <?php
        $mygrid = new gride();
        $mygrid->setData($result);

        if (isset($key_filed)) {
            if (isset($update_page)) {
                $mygrid->set_acction('Edit', $update_page, $key_filed);
            }
            $mygrid->set_acction('Delete', 'index.php', $key_filed);
        }
        if (isset($hide)) {
            $mygrid->hide($hide);
        }
        if (isset($action)) {
            foreach ($action as $key => $value) {
                $mygrid->set_acction($key, $value["url"], $value["key"]);
            }
        }
        $base_url = $_SERVER['SCRIPT_NAME'];
        $report = '';
        if (isset($_GET['report'])) {
            $report = '?report=' . $_GET['report'];
        }
        $mygrid->set_base_url($base_url . $report);
        $sort_by = 'ID';
        $sort_order = '';
        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            $sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'asc';
        }
        $mygrid->set_sort_by($sort_by, $sort_order);
        echo $mygrid->generate();
        ?>
    </div>
<?php else: ?>
    <?php
    if (!isset($header_lable)) {
        $header_lable = 'Thekeyhrms Excel Export';
    }
    $nameStr = '';
    foreach ($result[0] as $key => $value) {
        if ($nameStr == '') {
            $nameStr = ucwords(preg_replace('/[_]/', ' ', $key));
        } else {
            $nameStr .= ',' . ucwords(preg_replace('/[_]/', ' ', $key));
        }
    }
    $nameStr .="\n";
    foreach ($result as $key => $value) {
        $is_first = TRUE;
        foreach ($value as $vkey => $vvalue) {
            if ($is_first) {
                $nameStr .= $vvalue;
                $is_first = false;
            } else {
                $nameStr .= "," . $vvalue;
            }
        }
        $nameStr .="\n";
    }

    ob_clean();
    header('Content-disposition: attachment; filename="' . $header_lable . '.csv"');
    header('Content-type: application/csv');
    echo $nameStr;
    exit();
    ?>
<?php endif; ?>