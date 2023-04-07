<?php

	//get current directory
	$working_dir = getcwd();
	
	//get image directory
	$img_dir = $working_dir . "/images/";
	
	//change current directory to image directory
	chdir($img_dir);
	
	//using glob() function get images 
	$files = glob("*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}", GLOB_BRACE );
	
	//again change the directory to working directory
	chdir($working_dir);

	//iterate over image files
	foreach ($files as $file) {
	?>
		<img src="<?php echo "images/" . $file ?>" style="height: 200px; width: 200px;"/>
	<?php }
?>
<a href="/panel.php">Back</a>