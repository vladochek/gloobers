<html>
<head>

<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/clipboard/jquery.js" ></script>
<script type="text/javascript" src="<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/clipboard/jquery.zclip.js" ></script>


<script>
    $(document).ready(function(){
        $('#click-to-copy').zclip(
           {
               path: "<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/clipboard/ZeroClipboardnew.swf",
               copy: function(){ return $('.text_to_copy').val(); },
               afterCopy: function()
               {
                   $(".success").css('display','inline');
               }
           });
   });

</script>
</head>
  <body>
  <textarea class="text_to_copy">This text will be copied</textarea>    
<p><button id="click-to-copy">Click To Copy</button></p>    
<h2 class="success" style="display:none;">Text has been copied</h2>
  </body>
</html>

<?php echo $test;exit; ?>
<script type="text/javascript" src="https://davidwalsh.name/demo/ZeroClipboard.js"></script>
<!-- 
<textarea name="box-content" id="box-content" rows="5" cols="70">
    The David Walsh Blog is the best blog around!  MooTools FTW!
</textarea> -->
<input type="text" name="box-content" id="box-content"  />
<br /><br />
<p><input type="button" id="copy" name="copy" value="Copy to Clipboard" /></p>


<script type="text/javascript">
//set path
ZeroClipboard.setMoviePath("<?php print $GLOBALS['base_url'].'/'. drupal_get_path('theme',$GLOBALS['theme']); ?>/js/ZeroClipboardnew.swf");
//create client
var clip = new ZeroClipboard.Client();
//event
clip.addEventListener('mousedown',function() {
clip.setText(document.getElementById('box-content').value);
});
clip.addEventListener('complete',function(client,text) {
alert('copied: ' + text);
});
//glue it to the button
clip.glue('copy');
</script>

<?php echo $test;exit; ?>

