<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Jason Snider">
    <!--<link rel="icon" href="favicon.ico">-->

    <title>Jason Snider</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=PT+Sans+Caption:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
    
    <style>

      body{
        font-family: 'PT Sans', 'Open Sans', sans-serif;
        font-size: 2rem;
      }

      header a.logo{
        text-decoration: none;
        color: #666;
        font-family: 'PT Sans Caption', 'Open Sans', sans-serif;
      }
      
     header > nav{
        text-align: center;
        padding-bottom: 8px;
        margin-bottom: 8px;
      }
      
     header > nav a{
        text-decoration: none;
        color: #666;
        font-family: 'PT Sans Caption', 'Open Sans', sans-serif;
      }

      h2 a{
        text-decoration: none;
        color: #666;
        font-family: 'PT Sans Caption', 'Open Sans', sans-serif;
      }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <header>
        <h1 class="text-center">
          <a href="/" class="logo">Jason Snider [dot] Com</a>
        </h1>
        <nav>
          <a href="/">Blog</a> |
          <a href="/tools">Tools</a> |
          <a href="/">Contact</a>
        </nav>
      </header>

      <?php echo $View->getOutput(); ?>
    </div>

    <div class="container">
      <hr>
      <footer class="text-center">
        <?php echo 'Hi, it took Apache ' . round($View->BuildTime->end(microtime()), 5) . ' seconds to render this page.'; ?>
      </footer>
    </div>
  </body>
</html>