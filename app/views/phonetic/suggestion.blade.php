<script type="text/javascript">
function change()
{
	try
	{
		<?php
			echo "var d=[";
			foreach($delimeter as $d)
			{
				echo '"'.str_replace(array('\\',chr(10),chr(13),'"'),array('\\\\','','\n','\"'),$d).'",';
			}
			echo '""];';
		?>
		var replacetext = '';

		for(var i in d)
		{
			var e = document.getElementById("s"+i.toString());
			if(e !== null)
			{
				replacetext+=e.options[e.selectedIndex].text;
			}
			replacetext+=d[i];
		}


		var o=document.getElementById('textAreaOutput');
		o.innerHTML=replacetext;
		o.value = replacetext;
		document.getElementById('divOutput').innerHTML=replacetext.replace(new RegExp('\n','g'),'<br>');
	}
	catch(e)
	{
		alert(e);
	}
	fixEmoticon();
}

</script>
 