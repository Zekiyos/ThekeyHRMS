<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Red Fox ID</title>
        <link href="http://<?php echo $base_url ?>css/id.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <ul id="id_list">
            <?php foreach ($result as $key => $value): ?>
                <?php if (file_exists($base_path . 'Employee_Images/' . $value['ID'] . '.jpg')): ?>
                    <li>
                        <div class="red_fox_id">
                            <div class="id">
                                <div class="id_head">
                                    <img src="http://<?php echo $base_url ?>id_card/id_head.png"/>
                                    <ul class="redfox_address">
                                        <li>Head Office</li>
                                        <li><img src="http://<?php echo $base_url ?>id_card/phone.png"/></li>
                                        <li>+251-22-112-9250/51</li>
                                        <li><img src="http://<?php echo $base_url ?>id_card/post.png"/></li>
                                        <li>42</li>
                                        <li>Fax :  +251-22-112-9253</li>
                                        <li><a href="www.redfox.de">www.redfox.de</a></li>
                                    </ul>
                                </div>
                                <div class="id_content">
                                    <img class="seal" src="http://<?php echo $base_url ?>id_card/seal.png"/>
                                    <div class="left_content">
                                        <label class="full_name"><?php echo $value['FirstName'] . ' ' . $value['MiddelName'] . '    ' . $value['LastName'] ?></label>
                                        <label class="department"><?php echo $value['Department'] ?></label>
                                        <label class="position"><?php echo $value['Position'] ?></label>
                                        <label class="id_no">ID NO. <?php echo $value['ID'] ?></label>
                                    </div>
                                    <div class="right_content">
                                        <img src="http://<?php echo $base_url . 'Employee_Images/' . $value['ID'] . '.jpg' ?>"/>
                                    </div>
                                </div>
                                <div class="bottom_line"></div>
                            </div>
                            <div class="id_back">
                                <div class="camp_name">
                                    <img src="http://<?php echo $base_url ?>id_card/com_name.png"/>
                                </div>

                                <div class="back_content">
                                    <label class="red_address">
                                        <span>Address :</span>
                                        <br/>
                                        <span>City : <span>Koka</span> </span>
                                        <br/>
                                        <span>Kebele: <span> 01</span> </span>
                                    </label>
                                    <label>
                                        <span>
                                            Date Issued: <span><?php echo $issue_date; ?></span>
                                        </span>
                                    </label>
                                    <img src="http://<?php echo $base_url . 'barcode.php?content=' . $value['ID'] ?>"/>
                                    <img class="sign" src="http://<?php echo $base_url ?>id_card/sign.png"/>
                                    <label>
                                        <span class="duration">This ID card is valid only for Two year</span>
                                        <span class="autorized">Authorized Signiture</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </body>
</html>
