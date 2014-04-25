/***********************************************************
* txReplaceFormPassword.js
*
* Written by Simone Lippolis - http://simonelippolis.com
*
* This script is distributed under a Creative Commons - Commercial, Attribution licence
* http://creativecommons.org/licenses/by/2.5/it/
*
* Feel free to copy, edit, redistribute this script. Please, don't remove credits.
*
* If you find some bug or error, please let me know.
*
* How to use:
*
* 1. Include jquery:
* &lt;script type="text/javascript" src="jquery.js"&gt;&lt;/script&gt;
*
* 2. Include this script:
* &lt;script type="text/javascript" src="txReplaceFormPassword.js"&gt;&lt;/script&gt;
*
* 3. On document ready, invoke the plugin
*
* $(document).ready(function () {
*         $('#pwd').txReplaceFormPassword({
*            show_text : 'Password'
*        });
*     });
*
* consider '#pwd' as the object which needs to be replaced:
*
* &lt;form action="someaction" method="post" id="formid" name="formname"&gt;
*        &lt;input type="password" name="pwd" id="pwd" value="" /&gt;
*    &lt;/form&gt;
*
* The 'show_text' parameters contains the text to be shown in password's
* text field.
*
***********************************************************/
 
jQuery.fn.txReplaceFormPassword = function(options) {
 var options = jQuery.extend( {
 show_text: 'Password'
 },options);
 
 function trim(txt) {
 return txt.replace(/^\s+|\s+$/g, '');
 }
 
 return this.each(function() {
 if (jQuery(this).val().length == 0) {
 
 var $pos = jQuery(this).position();
 var $style = jQuery(this).attr('style');
 var $class = jQuery(this).attr('class');
 var $size = jQuery(this).attr('size');
 var $id = jQuery(this).attr('id');
 var $name = jQuery(this).attr('name');
 
 jQuery(this).hide();
 jQuery(this).after('&lt;input type="text" id="txgrpl-' + $id + '" name="txgrpl-' + $name + '" size="' + $size + '" style="' + $style + '" value="' + options.show_text + '" rel="' + $id + '" title="' + options.show_text + '" /&gt;');
 
 $('#txgrpl-' + $id).focus(function() {
 $(this).hide();
 var $id = $(this).attr('rel');
 $('#' + $id).show().focus();
 });
 }
 
 jQuery(this).blur(function() {
 if (trim(jQuery(this).val()) == '' || jQuery(this).val() == undefined) {
 var $id = jQuery(this).attr('id');
 jQuery(this).hide();
 $('#txgrpl-' + $id).show();
 }
 });
 });
};