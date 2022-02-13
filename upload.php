<?php
if( $_FILES['file']['name'] != "" )
{
  $destFile = "uploads/".$_FILES['file']['name'];
move_uploaded_file( $_FILES['file']['tmp_name'], $destFile );
}
else
{
    die("No file specified!");
}
?>
<html>

<head>
    <title>Uploading Complete</title>
</head>

<body>
    <h2>Uploaded File Info:</h2>
    <ul>
        <li>Sent file: <?php echo $_FILES['file']['name'];  ?>
        <li>File size: <?php echo $_FILES['file']['size'];  ?> bytes
        <li>File type: <?php echo $_FILES['file']['type'];  ?>
    </ul>
    <button onclick="goBack()">Go Back</button>

    <script>
        function goBack() {
            window.history.back();
        }

    </script>
</body>

</html>
