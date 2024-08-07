<?php
if(!empty($_GET['file'])){
    $fileName = basename($_GET['file']);
    if ( $fileName) {
      $filepath = 'temp/' . $fileName;

      if (file_exists($filepath)) {
          // Set headers for file download
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename="' . $fileName . '"');
          header('Content-Length: ' . filesize($filepath));

          // Read the file and output its contents
          readfile($filepath);
          exit;
      } else {
          echo "File not found!";
      }
  } else {
      echo "Invalid filename!";
  }
}
?>
