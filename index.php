<?php
error_reporting(0);

$csvFile ='database.csv';
 
$csv = ReadCSV($csvFile);

$jscse = json_encode($csv);

//echo($jscse);

for ($j=0; $j <count($csv) ; $j++) 
{ 
	if ($csv[$j]["EN"] === "Create a user") 
	{
//		echo " Translator : ".$csv[$j]["CS"];
	}
}

  // echo '<pre>';
  // print_r($csv);
  // echo '</pre>';

 function ReadCSV($CsvFile)
 {

 	$fileHandle = fopen($CsvFile, r);
 	
 	if ($fileHandle == null) 
 	{
 		echo '<script type="text/javascript">alert("File not Found!");</script>';
 	}
 	else
 	{
 		$filesize = filesize($CsvFile);
 		$firstRow = true;
    	$aData = array();

 		// while (!feof($fileHandle)) 
	 	// {
	 	// 	$line_of_text[] = fgetcsv($fileHandle, 1024);
	 	// }
    	//$data = fgetcsv($fileHandle, $filesize, ",") ;
    	
    	//print_r($data);
    //	$len = count($data);
    	
	 	//while ($data = fgets($fileHandle) !== false)
	 	$aData = array_map("str_getcsv", file($CsvFile,FILE_SKIP_EMPTY_LINES));
		$keys = array_shift($aData);
		foreach ($aData as $i=>$row) 
		{
   			 $aData[$i] = array_combine($keys, $row);
		}
		//print_r($aData);

    }

	
return $aData;
 }


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
	<textarea hidden id="jsonData"><?php echo $jscse?></textarea>
	<textarea hidden id="engText"><?php
		for ($j=0; $j <count($csv) ; $j++) 
		{ 
			echo trim($csv[$j]["EN"])."~";
			
		}
		?>
</textarea>
<div>
	<p>Create a user</p>

	<p>Created At </p>

	<div>
		ike others mentioned in this thread, replacing the entire body HTML is a bad idea because it reinserts the entire
		DOM and can potentially
		break any other Created At javascript that
		was acting on those elements Development.
	</div>

</div>
</body>
<script type="text/javascript">
	var position,data="";
	var changeLan = "PL";
	var replaced,flag=false;
	var arrayEnglish =[''];
	$(document).ready(function(){
		//position = document.documentElement.innerHTML.indexOf("Day of week1213211 11221 ");
		

		var text = document.getElementById('engText').value;
		//console.log("This is the text after split : "+text.split('~'));
		var parsing = text.split('~');
		for (var i = 0; i <text.length ; i++) 
		{
			if(text[i] !='~' && text[i] !="" )
				data = data+text[i];

			if (text[i] == '~') 
			{
				arrayEnglish.push(data);
				data='';
			}
		}
		 console.log("length = "+arrayEnglish.length);
		 console.log(arrayEnglish);


		for(var lo = 1 ; lo < arrayEnglish.length ; lo++)
		{

			position = findString(arrayEnglish[lo]);
			if(Boolean(position) === true)
			{
				var matchFound = arrayEnglish[lo];
				console.log(matchFound);
				var jsData = $("#jsonData").val();
				var obj = JSON.parse(jsData);
				console.log(obj);
				var kana;
				obj.forEach(function(item){
					if(item["EN"] == matchFound)
					{
						kana = item[changeLan];
						console.log(kana);
					}
				});

				$('body :not(script)').contents().filter(function() {
					return this.nodeType === 3;
				}).replaceWith(function() {
					return this.nodeValue.replace(matchFound, kana);
				});


			}
			else {
//				location.reload();

			}
		}
	});


var TRange=null;
function findString (str) 
{
	 if (parseInt(navigator.appVersion)<4) return;
	 var strFound;
	 var result = 0;
	 if (window.find) 
	 {

	  strFound=self.find(str);
	  if (strFound)
	  {
	  	result = 1;
	  }
	  
	  if (!strFound) 
	  {
	   strFound=self.find(str,0,1);
	   while (self.find(str,0,1)) continue;
	  }
	 }
	 else if (navigator.appName.indexOf("Microsoft")!=-1) {

	  // EXPLORER-SPECIFIC CODE

	  if (TRange!=null) {
	   TRange.collapse(false);
	   strFound=TRange.findText(str);
	   if (strFound) TRange.select();
	  }

	  if (TRange==null || strFound==0) {
	   TRange=self.document.body.createTextRange();
	   strFound=TRange.findText(str);
	   if (strFound) result = 1;
	  }
	 }
	 else if (navigator.appName=="Opera") {
	  alert ("Opera browsers not supported, some text translation sorry...")
	  return;
	 }
	 if (!strFound){
		 return result;
	 }
return result

}



</script>

</html>