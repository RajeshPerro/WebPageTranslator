<?php
error_reporting(0);
$Word = $_POST['matchWord'];
$ConvertLang = $_POST['convertLan'];


//calling function and checking from CSV
$csvFile ='database.csv';
$csv = ReadCSV($csvFile);

for ($j=0; $j <count($csv) ; $j++) 
{ 
	if ($csv[$j]["EN"] === $Word) 
	{
		echo $csv[$j][$ConvertLang];
	}
}

 function ReadCSV($CsvFile)
 {

 	$fileHandle = fopen($CsvFile, r);
 	
 	
 		$filesize = filesize($CsvFile);
 		$firstRow = true;
    	$aData = array();
	 	$aData = array_map("str_getcsv", file($CsvFile,FILE_SKIP_EMPTY_LINES));
		$keys = array_shift($aData);
		foreach ($aData as $i=>$row) 
		{
   			 $aData[$i] = array_combine($keys, $row);
		}
		
	
return $aData;	 	
 }


?>