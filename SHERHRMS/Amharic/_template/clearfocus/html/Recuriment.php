<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Design by http://www.bluewebtemplates.com
Released for free under a Creative Commons Attribution 3.0 License
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Template</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<!-- CuFon: Enables smooth pretty custom font rendering. 100% SEO friendly. To disable, remove this section -->
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/arial.js"></script>
<script type="text/javascript" src="js/cuf_run.js"></script>
<script src="../../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>

<!-- CuFon ends -->
<link href="../../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="main">

  <div class="header">
    <div class="header_resize">
      <div class="logo">
      <h1><a href="index.html"><span>Thekey</span>HRMS <small>The key is yours!</small></a></h1></div>
      <div class="clr"></div>
      <div class="menu_nav">
        <ul>
          <li class="active"><a href="index.html">Home</a></li>
          <li><a href="support.html">Recriument</a></li>
          <li><a href="about.html">Leave</a></li>
          <li><a href="blog.html">Benfite</a></li>
          <li><a href="blog.html">Blog</a></li>
          <li><a href="blog.html">Blog</a></li>
          <li><a href="contact.html">Contact Us</a></li>
        </ul>
      </div>
      <div class="searchform">
        <form id="formsearch" name="formsearch" method="post" action="">
          <input name="button_search" src="images/search_btn.gif" class="button_search" type="image" />
          <span><input name="editbox_search" class="editbox_search" id="editbox_search" maxlength="80" value="Search" type="text" /></span>
          <div class="clr"></div>
        </form>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="content_resize">
      <div class="mainbar">
        <div class="article">
          <h2><span>Template</span> License</h2><div class="clr"></div>
          <p>Posted by <a href="#">Owner</a> <span>&nbsp;&bull;&nbsp;</span> Filed under <a href="#">templates</a>, <a href="#">internet</a></p>
          <img src="images/img1.jpg" width="263" height="68" alt="image" class="fl" />
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <form id="form2" name="form2" method="post" action="<?php echo $editFormAction; ?>">
            <p>
              <label for="txtFname">Frist Name:</label>
              <span id="spryFname">
                <input type="text" name="txtFname" id="txtFname" tabindex="10" />
                <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></p>
            <p>
              <label for="txtLname">Middle Name:</label>
              <span id="spryLname">
                <input type="text" name="txtLname" id="txtLname" tabindex="20" />
                <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></p>
            <p>
              <label for="txtGName">Last Name:</label>
              <span id="spryGname">
                <input type="text" name="txtGName" id="txtGName" tabindex="30" />
                <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></p>
            <p>
              <label for="txtAge">Age:</label>
              <span id="spryAge">
                <input type="text" name="txtAge" id="txtAge" tabindex="40" />
                <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span><span class="textfieldMinValueMsg">The entered value is less than the minimum required.</span><span class="textfieldMaxValueMsg">The entered value is greater than the maximum allowed.</span></span></p>
            <p>Sex :
              <label>
                <input type="radio" name="rdSex" value="M" id="rdSex_0" />
                Male</label>
              <label>
                <input type="radio" name="rdFemale" value="F" id="rdSex_1" />
                Female</label>
            </p>
            <p>
              <label for="txtID">ID:</label>
              <input type="text" name="txtID" id="txtID" tabindex="60" />
            </p>
            <p>
              <label for="lstDepartment">Department</label>
              <select name="lstDepartment" size="1" id="lstDepartment" tabindex="71">
                <option value="d">Select Department</option>
                <?php
do {  
?>
                <option value="<?php echo $row_rsdepartment['Department']?>"><?php echo $row_rsdepartment['Department']?></option>
                <?php
} while ($row_rsdepartment = mysql_fetch_assoc($rsdepartment));
  $rows = mysql_num_rows($rsdepartment);
  if($rows > 0) {
      mysql_data_seek($rsdepartment, 0);
	  $row_rsdepartment = mysql_fetch_assoc($rsdepartment);
  }
?>
              </select>
            </p>
            <p>Enter
              <input type="submit" name="txtEnter" id="txtEnter" value="Submit" tabindex="80" />
            </p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p><br />
            </p>
            <input type="hidden" name="MM_insert" value="form2" />
          </form>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
        </div>
        <div class="article">
          <h2><span>Lorem Ipsum</span> Dolor Sit</h2><div class="clr"></div>
          <p>Posted by <a href="#">Owner</a> <span>&nbsp;&bull;&nbsp;</span> Filed under <a href="#">templates</a>, <a href="#">internet</a></p>
          <img src="images/img1.jpg" width="263" height="146" alt="image" class="fl" />
          <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. Cras id urna. <a href="#">Morbi tincidunt, orci ac convallis aliquam, lectus turpis varius lorem, eu posuere nunc justo tempus leo.</a> Donec mattis, purus nec placerat bibendum, dui pede condimentum odio, ac blandit ante orci ut diam. Cras fringilla magna. Phasellus suscipit, leo a pharetra condimentum, lorem tellus eleifend magna, eget fringilla velit magna id neque. Curabitur vel urna. In tristique orci porttitor ipsum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. Cras id urna. Morbi tincidunt, orci ac convallis aliquam.</p>
          <p>Aenean commodo elit ac ante dignissim iaculis sit amet non velit. Donec magna sapien, molestie sit amet faucibus sit amet, fringilla in urna. Aliquam erat volutpat. Fusce a dui est. Sed in volutpat elit. Nam odio tortor, pulvinar non scelerisque in, eleifend nec nunc. Sed pretium, massa sed dictum dapibus, nibh purus posuere magna, ac porta felis lectus ut neque. Nullam sagittis ante vitae velit facilisis lacinia. Cras vehicula lacinia ornare. Duis et cursus risus. Curabitur consectetur justo sit amet odio viverra vel iaculis odio gravida. Ut imperdiet metus nec erat.</p>
          <p><a href="#" class="obg">Read more</a> <span>&nbsp;&bull;&nbsp;</span> <a href="#" class="obg">Comments (7)</a> <span>&nbsp;&bull;&nbsp;</span> March 15, 2015</p>
        </div>
      </div>
      <div class="sidebar">
        <div class="gadget">
          <h2 class="star"><span>Sidebar</span> Menu</h2><div class="clr"></div>
          <ul class="sb_menu">
            <li><a href="#">Home</a></li>
            <li><a href="#">TemplateInfo</a></li>
            <li><a href="#">Style Demo</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Archives</a></li>
            <li><a href="http://www.dreamtemplate.com">Website Templates</a></li>
          </ul>
        </div>
        <div class="gadget">
          <h2 class="star"><span>Sponsors</span></h2><div class="clr"></div>
          <ul class="ex_menu">
            <li><a href="http://www.dreamtemplate.com" title="Website Templates">DreamTemplate</a><br />Over 6,000+ Premium Web Templates</li>
            <li><a href="http://www.templatesold.com" title="WordPress Themes">TemplateSOLD</a><br />Premium WordPress &amp; Joomla Themes</li>
            <li><a href="http://www.imhosted.com" title="Affordable Hosting">ImHosted.com</a><br />Affordable Web Hosting Provider</li>
            <li><a href="http://www.dreamstock.com" title="Stock Photos">DreamStock</a><br />Download Amazing Stock Photos</li>
            <li><a href="http://www.evrsoft.com" title="Website Builder">Evrsoft</a><br />Website Builder Software &amp; Tools</li>
            <li><a href="http://www.myvectorstore.com" title="Stock Icons">MyVectorStore</a><br />Royalty Free Stock Icons</li>
          </ul>
        </div>
      </div>
      <div class="clr"></div>
    </div>
  </div>

  <div class="fbg">
    <div class="fbg_resize">
      <div class="col c1">
        <h2><span>Image Gallery</span></h2>
        <a href="#"><img src="images/pic1.jpg" width="56" height="56" alt="pix" /></a>
        <a href="#"><img src="images/pic2.jpg" width="56" height="56" alt="pix" /></a>
        <a href="#"><img src="images/pic3.jpg" width="56" height="56" alt="pix" /></a>
        <a href="#"><img src="images/pic4.jpg" width="56" height="56" alt="pix" /></a>
        <a href="#"><img src="images/pic5.jpg" width="56" height="56" alt="pix" /></a>
        <a href="#"><img src="images/pic6.jpg" width="56" height="56" alt="pix" /></a>
      </div>
      <div class="col c2">
        <h2><span>Lorem Ipsum</span></h2>
        <p>Lorem ipsum dolor<br />Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. Cras id urna. <a href="#">Morbi tincidunt, orci ac convallis aliquam</a>, lectus turpis varius lorem, eu posuere nunc justo tempus leo. Donec mattis, purus nec placerat bibendum, dui pede condimentum odio, ac blandit ante orci ut diam.</p>
      </div>
      <div class="col c3">
        <h2><span>About</span></h2>
        <img src="images/white.jpg" width="56" height="56" alt="pix" />
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. Cras id urna. Morbi tincidunt, orci ac convallis aliquam, lectus turpis varius lorem, eu posuere nunc justo tempus leo. llorem, eu posuere nunc justo tempus leo. Donec mattis, purus nec placerat bibendum. <a href="#">Learn more...</a></p>
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="footer">
    <div class="footer_resize">
      <p class="lf">&copy; Copyright MyWebSite. Designed by  <a href="http://www.bluewebtemplates.com">Thekey ICT Soultion</a></p>
      <ul class="fmenu">
        <li class="active"><a href="index.html">Home</a></li>
        <li><a href="support.html">Support</a></li>
        <li><a href="blog.html">Blog</a></li>
        <li><a href="about.html">About Us</a></li>
        <li><a href="contact.html">Contacts</a></li>
      </ul>
      <div class="clr"></div>
    </div>
  </div>
</div>
<script type="text/javascript">
var sprytextfield3 = new Spry.Widget.ValidationTextField("spryGname", "none", {minChars:2, maxChars:20, validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("spryAge", "integer", {minChars:2, maxChars:3, minValue:15, maxValue:70});
var sprytextfield2 = new Spry.Widget.ValidationTextField("spryLname", "none", {validateOn:["blur"], minChars:2, maxChars:20});
var sprytextfield1 = new Spry.Widget.ValidationTextField("spryFname", "none", {validateOn:["blur"], minChars:2, maxChars:20});
</script>
</body>
</html>
