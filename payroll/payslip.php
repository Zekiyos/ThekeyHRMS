<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <style>

            h1 {
                color: green;
                font-size: 20px;
            }
            h2 {
                color: blue;
                font-size: 18px;
            }
            h3 {
                color: blueviolet;
                font-size: 16px;
            }
            .green_house {
                padding-left: 0;
                overflow: hidden;
            }
            .section {
                padding-left: 10px;
                overflow: hidden;
            }
            .department {
                padding-left: 10px;
                overflow: hidden;
            }
            .department ul {
                border-bottom: 2px dashed;
                list-style: none outside none;
                overflow: hidden;
                padding-bottom: 10px;
                padding-left: 0;
            }
            .department ul li {
                float: left;
                font-size: 14px;
                width: 180px;
            }
            .department ul li > label {
                display: block;
                float: left;
            }
            .department ul li > label:first-child {
                width: 100px;
                color: blue;
            }
            .department ul li > label:last-child {
                width: 80px !important;
            }

            .department ul li:first-child label:first-child {
                width: 65px !important;
            }
            .department ul li:first-child label:last-child {
                width: 115px !important;
            }


            .department ul li:last-child label:last-child {
                border-bottom: 2px double;
                color: red;
                font-weight: bold;

            }


        </style>
    </head>
    <body>
        <div id="thekeypayslip">
            <?php $count = 0; ?>
            <?php for ($i = 0; $i <= 1; $i++): ?>
                <div class="green_house">

                    <h1>GH 6 <?php echo ($i + 1); ?></h1>
                    <?php
                    for ($l = 0; $l < 3; $l++):
                        ?>
                        <div class="section">
                            <h2> Section <?php echo ($l + 1); ?></h2>
                            <?php for ($j = 0; $j < 2; $j++): ?>
                                <div class="department">
                                    <h3>Department <?php echo ($j + 1); ?></h3>
                                    <?php for ($k = 0; $k <= 300; $k++): ?>
                                        <ul>
                                            <li>
                                                <label><span><?php echo++$count; ?></span> <span>Date</span></label>
                                                <label>December 2012</label>
                                            </li>
                                            <li>
                                                <label>Absent_Day</label>
                                                <label>0</label>
                                            </li>
                                            <li>
                                                <label>Day_OT</label>
                                                <label>0.00</label>
                                            </li>
                                            <li>
                                                <label>Total_OT</label>
                                                <label>0.00</label>
                                            </li>
                                            <li>
                                                <label>Transport_Allow</label>
                                                <label>0.00</label>
                                            </li>
                                            <li>
                                                <label>Bonus</label>
                                                <label>0.00</label>
                                            </li>
                                            <li>
                                                <label>Pension 7</label>
                                                <label>0.00</label>
                                            </li>
                                            <li>
                                                <label>Court Deduc</label>
                                                <label>0.00</label>
                                            </li>
                                            <li>
                                                <label>Pledge</label>
                                                <label>0.00</label>
                                            </li>


                                            <li>
                                                <label>ID</label>
                                                <label>HR-09-5095</label>
                                            </li>
                                            <li>
                                                <label>Working_Day</label>
                                                <label>550</label>
                                            </li>
                                            <li>
                                                <label>Night_OT</label>
                                                <label>000</label>
                                            </li>
                                            <li>
                                                <label>Taxable_Incom</label>
                                                <label>0.00</label>
                                            </li>
                                            <li>
                                                <label>Position_Allowa</label>
                                                <label>0.00</label>
                                            </li>
                                            <li>
                                                <label>Loan</label>
                                                <label>0.00</label>
                                            </li>
                                            <li>
                                                <label>PF_Employee</label>
                                                <label>0.00</label>
                                            </li>
                                            <li>
                                                <label>Other Deduc</label>
                                                <label>0.00</label>
                                            </li>




                                            <li>
                                                <label>Basic salary</label>
                                                <label>0.00</label>
                                            </li>
                                            <li>
                                                <label>Leave_Day_P</label>
                                                <label>0.00</label>
                                            </li>
                                            <li>
                                                <label>Holyday_OT</label>
                                                <label>0.00</label>
                                            </li>
                                            <li>
                                                <label>Present_Allow</label>
                                                <label>0.00</label>
                                            </li>
                                            <li>
                                                <label>Housing_Allow</label>
                                                <label>0.00</label>
                                            </li>
                                            <li>
                                                <label>Pension 5</label>
                                                <label>0.00</label>
                                            </li>
                                            <li>
                                                <label>LU_Contributio</label>
                                                <label>0.00</label>
                                            </li>
                                            <li>
                                                <label>Net_Pay</label>
                                                <label class="total">0.00</label>
                                            </li>

                                        </ul>
                                    <?php endfor; ?>
                                </div>
                            <?php endfor; ?>
                        </div>
                    <?php endfor; ?>
                </div>
            <?php endfor; ?>
        </div>
    </body>
</html>
