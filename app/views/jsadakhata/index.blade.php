<!--
 The contents of this file are subject to the Mozilla Public License
 Version 1.1 (the "License"); you may not use this file except in
 compliance with the License. You may obtain a copy of the License at
 http://www.mozilla.org/MPL/

 Software distributed under the License is distributed on an "AS IS"
 basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See the
 License for the specific language governing rights and limitations
 under the License.

 The Original Code is SadaKhata.

 The Initial Developer of the Original Code is Hasib Al Muhaimin.
 <himuhasib@gmail.com>

 Copyright (C) Sadakhata **http://sadakhata.com**. All Rights Reserved.

 Contributor(s): ______________________________________.
-->



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>JSadakhata</title>



<link rel="shortcut icon" type="image/x-icon" href="include/images/favicon.ico" />

        <!--
            // New Logo Introduced.
            // Configuration for Apple, Android, Windows 8/10
        -->

        <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="/assets/images/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/assets/images/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/assets/images/manifest.json">
        <link rel="mask-icon" href="/assets/images/safari-pinned-tab.svg" color="#e14938">
        <meta name="msapplication-config" content="/assets/images/browserconfig.xml">
        <meta name="theme-color" content="#e14938">

        <!-- New Logo Configuration end. -->

<style type="text/css">
html {
    overflow-y: scroll;
}
</style>
<!--bootstrap stylesheet and js files -->
<link rel="stylesheet" type="text/css" href="assets/jsadakhata/bootstrap/css/bootstrap.min.css">
<!--/bootstrap-->


<link rel="stylesheet" type="text/css" href="assets/jsadakhata/CSS/jquery-ui.css" />
<script type="text/javascript" src="assets/jsadakhata/JS/jquery.min.js"></script>
<script type="text/javascript" src="assets/jsadakhata/JS/jquery-ui.min.js"></script>
<script type="text/javascript" src="assets/jsadakhata/JS/sk.js"></script>
<script type="text/javascript" src="assets/jsadakhata/JS/jsDB.js"></script>
<script type="text/javascript" src="assets/jsadakhata/JS/myDB.txt"></script>
<script type="text/javascript" src="assets/jsadakhata/JS/avro.js"></script>
<script type="text/javascript" src="assets/jsadakhata/JS/jquery.caret.1.02.js"></script>

</head>
<body>

	<div class="navbar">
        <div class="navbar-inner">
        	<i class="brand">JSadakhata</i>
        	<a href="/" target="_blank"><button class="btn"><i class="icon-home"></i> Home</button></a>
            <button class="btn btn-success" id="sw_kmp">Show Keymap</button>
        </div>
    </div>


	<center>
        <div class="container" id="kmp">
            <strong>JSadakhata used <a href="https://github.com/torifat/jsAvroPhonetic/" target="_blank">JsAvroPhonetic</a> parser. Which follows Avro keymap.</strong>
            <br />
            <img src="assets/jsadakhata/images/keymap.PNG" alt="avro keymap" class="img-polaroid">
        </div>
        <h1>JSadakhata <small>JavaScript Implemention of sadakhata</small></h1>

        <textarea id="write" style="width:90%;" rows="16" placeholder="এখানে ইংলিশ ফন্টে বাংলা লিখুন..."></textarea>
    </center>

    
</body>
</html>

<script type="text/javascript">
$(function() {
	sadakhata($("#write"));
	$("#write").focus();
    $("#kmp").slideToggle("slow");
    $("#sw_kmp").click(function(){
        $(this).html($(this).html()[0]=='S'?"Hide Keymap":"Show Keymap" );
        $("#kmp").slideToggle("slow");
        $("#write").focus();
    })

});
</script>



