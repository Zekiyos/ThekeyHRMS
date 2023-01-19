<?php

$proclamation = array();


$proclamation['annual leave grant form'] = '
    <p align="center"><strong>CHAPTER ONE</strong></p>
<p align="center"><strong>Annual Leave</strong></p>
<h5>76. General TOP</h5>
<p>&nbsp;</p>
<p>1/ An agreement by a worker to waive in any manner his right to annual leave&nbsp; shall be null&nbsp; and void.</p>
<p>&nbsp;</p>
<p>2/ Unless otherwise provided in this Proclamation,&nbsp; It is prohibited&nbsp; to pay wages in lieu of the annual leave.</p>
<h5>77&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Duration&nbsp; of Annual Leave</h5>
<p>&nbsp;</p>
<p>1/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; A worker shall be entitled to uninterrupted annual leave with pay which shall in no case be less than:</p>
<p>a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; fourteen (14) working days for the first one year of service;</p>
<p>b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; fourteen (14) working days plus one working day for every additional year of service.</p>
<p>&nbsp;</p>
<p>2/&nbsp;&nbsp;&nbsp;&nbsp; Notwithstanding the provisions of sub-article (1) of this Article,&nbsp; additional annual leave with pay, for workers engaged in a work&nbsp; which is particularly ardous or the condition in which it is&nbsp; done is un-healthy, may be fixed in a collective agreement.</p>
<p>&nbsp;</p>
<p>3/&nbsp;&nbsp;&nbsp;&nbsp; The wage a worker receives during his annual leave shall be equal to what he would have received if he had continued to work.</p>
<p>&nbsp;</p>
<p>4/&nbsp;&nbsp;&nbsp; For purpose of determining the qualifying period of service required for the entitlement of an annual leave, twenty-six days of&nbsp; service in an undertaking shall be deemed to be equivalent to one&nbsp; month of employment.</p>
<p>&nbsp;</p>
<p>5/&nbsp;&nbsp; A worker whose contract of employment is terminated under this&nbsp; Proclamation is entitled to his pay for the leave he has not taken.</p>
<p>&nbsp;</p>
<p>6/&nbsp;&nbsp; Where&nbsp; the length of service of a worker does not qualify for an&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp; annual leave provided for in this Article, the worker shall be&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp; entitled&nbsp;&nbsp; to an annual leave proportion&nbsp; to the length of his service.</p>
<p>&nbsp;</p>
<h5>78&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Granting of Leave</h5>
<p>&nbsp;</p>
<p>1/&nbsp;&nbsp;&nbsp;&nbsp; A worker shall be granted his first period of leave&nbsp; after one year of service and his next and subsequent&nbsp; period of leave in the course of each calendar year.</p>
<p>&nbsp;</p>
<p>2/&nbsp;&nbsp;&nbsp;&nbsp; An employer shall grant a worker his leave in accordance with a leave schedule in the course of the calendar year in which it becomes due.</p>
<p>&nbsp;</p>
<p>3/&nbsp;&nbsp;&nbsp;&nbsp; The leave&nbsp; schedule referred&nbsp; to in sub-article (2) of this Article shall be drown up by the employer with&nbsp; due regard as far as possible to:</p>
<p>a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; the wish of the worker; and</p>
<p>b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; the need for maintaining the normal functioning of his undertaking.</p>
<p>&nbsp;</p>
<h5>79&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dividing and Postponding&nbsp; Annual Leave</h5>
<p><strong>&nbsp;</strong></p>
<p>1/&nbsp;&nbsp;&nbsp;&nbsp; Nothwithstanding the provisions of Article 77, if a worker requests and the employer agrees, his leave may be granted in two parts.</p>
<p>&nbsp;</p>
<p>2/&nbsp;&nbsp;&nbsp;&nbsp; Annual leave may be postponed when the worker requests and the employer agrees.</p>
<p>&nbsp;</p>
<p>3/&nbsp;&nbsp;&nbsp;&nbsp; An employer may, for reasons dictated by the work conditions of the undertaking, postpone the&nbsp; date of&nbsp; leave of a worker.</p>
<p>&nbsp;</p>
<p>4/&nbsp;&nbsp;&nbsp;&nbsp; Where a worker falls sick during his annual leave, Articles 85 and 86 of this Proclamation shall apply.</p>
<p>&nbsp;</p>
<p>5/&nbsp;&nbsp;&nbsp;&nbsp; Any leave postponed in accordance with sub-articles (2) and (3) of this Article, shall not be posponed for&nbsp; more than two years.</p>
<p><strong>&nbsp;</strong></p>
<h5>80&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Recall</h5>
<p>&nbsp;</p>
<p>1/&nbsp;&nbsp;&nbsp;&nbsp; A worker who is on leave may be recalled only where unforeseen circumstances require his presence at his post.</p>
<p>&nbsp;</p>
<p>2/&nbsp;&nbsp;&nbsp;&nbsp; A worker who is recalled from leave shall be entitled to a payment covering the remainder of his leave, excluding the time lost for the trip.</p>
<p>&nbsp;</p>
<p>3/&nbsp;&nbsp;&nbsp;&nbsp; The employer shall defray the transport expenses incurred by the worker as direct consequences of his being recalled and per-diem.</p>
<p>&nbsp;</p>';

if (isset($_GET['proclamation'])) {
    if (isset($proclamation[strtolower($_GET['proclamation'])])) {
        echo $proclamation[strtolower($_GET['proclamation'])];
    } else {
        echo '<h3>No Proclamation Found</h3>';
    }
} else {
    echo '<h3>No Proclamation Found</h3>';
}
?>
