<?php
ini_set("display_errors",1);
// Enter the name of directory
// echo $pathdir = $_SERVER['DOCUMENT_ROOT']."/tests/images/";

// // Enter the name to creating zipped directory
// $zipcreated = "images.zip";

// // Create new zip class
// $zip = new ZipArchive;

// if($zip -> open($zipcreated, ZipArchive::CREATE ) === TRUE) {
	
// 	// Store the path into the variable
// 	$dir = opendir($pathdir);
	
// 	while($file = readdir($dir)) {
// 		if(is_file($pathdir.$file)) {
// 			$zip -> addFile($pathdir.$file, $file);
// 		}
// 	}
// 	$zip ->close();
// }


//Get real path for our folder

echo $rootPath = $_SERVER['DOCUMENT_ROOT']."/tests/html/";


// Initialize archive object
$zip = new ZipArchive();
$zip->open('file.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) );

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}

// Zip archive will be created only after closing object
$zip->close();

//extract zip file
// Create new zip class
$zip = new ZipArchive;
  
// Add zip filename which need
// to unzip
echo $src = $_SERVER['DOCUMENT_ROOT'].'/tests/file.zip';
echo $dest = $_SERVER['DOCUMENT_ROOT'].'/tests/file';
$zip->open($src);
// $_SERVER['DOCUMENT_ROOT']."/tests/images/";//
// Extracts to current directory
$zip->extractTo($dest);
  
$zip->close(); 



?>
