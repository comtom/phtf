<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>FriendBook</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- favicon -->
        <link rel='shortcut icon' type='image/x-icon' href='/static/favicon.ico' />
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Social SHARE image -->
        <link rel="image_src" type="image/jpeg" href="images/share.png">
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <meta name="description" content="">
        <meta name="keywords" content="">
        <link rel="stylesheet" href="/css/normalize.css">
        <link rel="stylesheet" href="/css/main.css">
        <link rel="stylesheet" href="/css/semantic.min.css">
        <link rel="stylesheet" href="/css/bootstrap-datetimepicker.css">
        <script src="/js/vendor/modernizr-2.6.2.min.js"></script>
        <style>
        .ui.feed a {
          cursor: pointer;
        }
        a:hover {
          color: #00BAFF;
        }
        a {
          color: #009FDA;
          text-decoration: none;
        }
        #left-menu {
          top: 43px;
        }
        #right-content {
          margin-left: 275px;
          padding: 15px;
          padding-top: 57px;
        }
        #content {
          padding-top: 57px;
        }
        #hidden-actions-menu {
          position: fixed;
          /*float:right;*/
          margin-top: -50px;
          left: 228px;
        }
        .breadcrumb .section {
          text-decoration: none;
          color: #888;
        }
        .ui.circular.segment:hover {
          background: #EEE;
        }
        #left-menu .item {
          cursor: pointer;
        }
        .ui.column.name {
          margin: 0px;
        }
        #showMenu {
          width: 49px;
          height: 49px;
          top: 47px;
          left: 266px;
          position: absolute;
          z-index: 100;
          background: #eee;
          border-top-left-radius: 0px;
          border-bottom-left-radius: 0px;
        }
        .left.spaced {
          margin-left: 25px;
        }
        body {
          background-color: #F2F6F7;
        }
        </style>
    </head>
    <body>
        <!-- outdated browser message -->
        <!--[if lt IE 7]>
        <div class="ui icon message">
          <i class="browser icon"></i>
          <div class="content">
            <div class="header">
              Tu navegador es obsoleto!
            </div>
            <p>Estas usando un navegador <strong>muy viejo</strong>. Por favor, <a href="http://browsehappy.com/">actualiza tu navegador</a> para mejorar tu experiencia.</p>
          </div>
        </div>
        <![endif]-->

        <div class="ui fixed top inverted purple menu" style="margin:0px;">
          <img src="/images/logo.png" height="36" width="36" style="width:36px; height:36px; margin-right:2px;"/>
        </div>

        <!-- contenido -->
        <?php echo $contenido ?>

        <script src="/js/vendor/jquery-1.10.2.min.js"></script>
        <script src="/js/semantic.js"></script>
        <script src="/js/plugins.js"></script>
        <script src="/js/vendor/jquery-address.js"></script>

        <script>
            $('.ui.dropdown')
              .dropdown()
            ;
            $('.ui.checkbox')
              .checkbox()
            ;

            <?php echo $js ?>

            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-51855748-2', 'cowfunny.com');
            ga('send', 'pageview');
      </script>
    </body>
</html>
