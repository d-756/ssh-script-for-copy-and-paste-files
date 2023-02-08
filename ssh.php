<?php
  init();

  function init() {
    $src = "/home";
    // 1: success, 0: failure
    $flag = 0;
    if (is_dir($src)) {
      $firstLevelPath = "/home";
      $firstLists = scandir($firstLevelPath);
      if(sizeof($firstLists) !== 0) {
        foreach($firstLists as $value1) {
          $secondLevelPath = $firstLevelPath.'/'.$value1.'/public_html';
          if (is_dir($secondLevelPath)) {
            $secondLists = scandir($secondLevelPath);
  
            foreach($secondLists as $value2) {
  
              $thirdLevelPath = $secondLevelPath.'/'.$value2;
              if ($value2 == "wp-content") {
                $dst2 = $thirdLevelPath.'/mu-plugins';
                custom_copy($src.'/mu-plugins', $dst2);
                $flag = 1;
              } else {
                $thirdLists = scandir($thirdLevelPath);
  
                foreach($thirdLists as $value3) {
  
                  $fourthLevelPath = $thirdLevelPath.'/'.$value3;
                  if ($value3 == "wp-content") {
                    $dst3 = $fourthLevelPath.'/mu-plugins';
                    custom_copy($src.'/mu-plugins', $dst3);
                    $flag = 1;
                  }
                }
  
              }
            }
          } else {}
        }
      } else {}
    } else {}
    
    echo json_encode($flag);
  }

  function custom_copy($src, $dst) { 
    // open the source directory 
    $dir = opendir($src);  
    // Make the destination directory if not exist 
    @mkdir($dst);
    // Loop through the files in source directory 
    foreach (scandir($src) as $file) {  
        if (( $file != '.' ) && ( $file != '..' )) {  
            if ( is_dir($src . '/' . $file) )  
            {
                // Recursively calling custom copy function 
                // for sub directory  
                custom_copy($src . '/' . $file, $dst . '/' . $file);  
            }
            else {  
              copy($src . '/' . $file, $dst . '/' . $file);  
            }
        }  
    }  
   
    closedir($dir); 
  }

?>
