<?php
$this->title = 'Error';

?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <title>Error</title>
</head>
<body>
  <div class="d-flex p-4 justify-content-center align-items-center">
    <h1 class="mr-3 pr-3 border-right p-3 inline-block align-content-center">
      <?php echo $exception->getCode() ?>
    </h1>
    <div class="inline-block align-middle">
    	<h2 class="font-weight-normal p-3 lead" id="desc">
        <?php echo $exception->getMessage() ?>
      </h2>
    </div>
  </div>

</body>
</html>