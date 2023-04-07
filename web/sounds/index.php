<?php
    // get the current directory
    $current_dir = getcwd();

    // specify the subdirectory for the images
    $audio_dir = $current_dir . "/sounds/";

    // change to the audio directory
    chdir($audio_dir);

    // use glob() to retrieve all WAV files
    $files = glob("*.{wav}", GLOB_BRACE);

    // change back to the original directory
    chdir($current_dir);

    // display the WAV files as a list
    foreach ($files as $file) {
        echo "<a href='sounds/$file'>$file</a><br>";
    }

    // provide a link to go back to the panel.php page
    echo "<a href='panel.php'>Back to panel</a>";
?>
