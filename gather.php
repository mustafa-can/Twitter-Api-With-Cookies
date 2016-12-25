<?php
$page = 'twitter';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>[Twitter API Example]</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <link href='https://fonts.googleapis.com/css?family=Lato:400,700,300|Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> <!--Autocomplete theme-->
        <script type="text/javascript">
            var page = "<?php echo $page; ?>";
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/js-cookie-master/src/js.cookie.js"></script>
        <script src="js/custom.js"></script>
        <!--Autocomplete scripts -->
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    </head>
    <body style="background-color: #F5F8FA;">

        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container-fluid" style="background:#fff;">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="http://localhost/NoSocial/gather.php">[Twitter API Example]</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Follows <span class="caret"></span></a>
                  <ul class="dropdown-menu" id="follows"></ul>
                </li>
                <li><a href="#" id="follow">Follow</a></li>
              </ul>
              <?php if ($page != 'home') { ?>
              <form class="navbar-form navbar-left">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Username" id="searchText">
                </div>
                <button type="button" class="btn btn-default" id="doSearch">Search</button>
              </form>
              <?php } ?>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>

        <input type="hidden" name="max-id" id="max-id" value="">
        <input type="hidden" name="user-name" id="user-name" value="">
        <div class="container" id="content"></div>
        <div class="container">
            <div id="loader"></div>
            <div id="loader2"></div>
            <button type="button" class="center-block btn btn-default" id="older">Load Older Twits</button>
        </div>

        <footer class="footer">
          <div class="container" id="footer_">
            <p class="text-muted">Twitter Api Example</p>
          </div>
        </footer>
    </body>
</html>
