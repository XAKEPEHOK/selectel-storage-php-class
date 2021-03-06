<?php

include_once 'SelectelStorage.php';

header("Content-type: text/plain");

try {
	$selectelStorage = new SelectelStorage("Account", "Key");

	echo "\n\nCreate Container:\n";
	$container = $selectelStorage->createContainer('selectel', array("X-Container-Meta-Type: public"));
	print_r($container->getInfo());
	
	echo "Containers list\n";
	$containerList = $selectelStorage->listContainers();
	print_r($containerList);

	echo "\n\nContainer Info:\n";
	$cInfo = $selectelStorage->getContainer($containerList[0])->getInfo();
	print_r($cInfo);
	
	echo "\n\nCreate directory:\n";
	$container->createDirectory('php/test');

	echo "\n\nDirectories:\n";
	$dirList = $container->listFiles($limit = 10000, $marker = null, $prefix = null, $path = "");
	print_r($dirList);
	
	echo "\n\nPutting File:\n";
	$res = $container->putFile(__FILE__, 'Examples.php');
	print_r($res);

	echo "\n\nFiles in directory:\n";
	$fileList = $container->listFiles($limit = 10000, $marker = null, $prefix = null, $path = 'php/');
	print_r($fileList);


	echo "\n\nFile info:\n";
	$fileInfo = $container->getFileInfo('php/Examples.php');
	print_r($fileInfo);

	echo "\n\nGetting file (base64):\n";
	$file = $container->getFile($fileList[0]);
	$file['content'] = base64_encode($file['content']);
	print_r($file);

	echo "\n\nCopy: \n";
	$copyRes = $container->copy('php/Examples.php', 'php/test/Examples_copy.php5');
	print_r($copyRes);
	
}
catch (Exception $e)
{
	echo $e->getMessage();
}

