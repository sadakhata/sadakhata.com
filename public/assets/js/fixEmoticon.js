function fixEmoticon()
{
	var divOutput = document.getElementById('divOutput');
	var textAreaOutput = document.getElementById('textAreaOutput');
	var emoIn = [	'ঃ\\\)', 	'ঃ\\\(', 	'ঃ\'\\\(', 	'ঃ\'\\\)', 	'ঃ/', 	'ঃ\\\\', 	'ঃভ', 	'ঃও',	'ঃপি',	'ঃডি', 	'ঃপ', 	'ঃড', 	';প', 	'ঃঅ', 	';ড', 	';অ', 	';ও'];
	var emoOut = [	':)', 		':(', 		':\'(', 	':\')', 	':/', 	':\\', 		':v', 	':o', 	':p',	':D',		':p', 	':D', 	';p', 	':o', 	';D', 	';o', 	';o'];
	for(var i in emoIn)
	{
		var rgx = new RegExp(emoIn[i], "gi");
		divOutput.innerHTML = divOutput.innerHTML.replace(rgx, emoOut[i]);
		textAreaOutput.innerHTML = textAreaOutput.innerHTML.replace(rgx, emoOut[i]);
		textAreaOutput.value = textAreaOutput.value.replace(rgx, emoOut[i]);
	}
}