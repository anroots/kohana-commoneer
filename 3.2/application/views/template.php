<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Kohana Twitter :: <?=$title?></title>
    <meta name="description" content="An example on how to build Twitter with Kohana 3">
    <meta name="author" content="Ando Roots">

    <meta name="viewport" content="width=device-width,initial-scale=1">

    <link rel="stylesheet" href="<?=URL::base()?>assets/css/bootstrap-1.1.0.css">
    <link rel="stylesheet" href="<?=URL::base()?>assets/css/style.css">

    <script src="<?=URL::base()?>assets/js/libs/modernizr-2.0.min.js"></script>

</head>
<body>
<div class="topbar">
    <div class="fill">
        <div class="container">
            <h3><a href="#">Kohana Twitter</a></h3>

            <ul>
                <li class="active"><a href="<?=URL::base()?>dash">Dashboard</a></li>


            </ul>

            <ul class="nav secondary-nav">
                <li class="menu">
                    <? if (Auth::instance()->logged_in()): ?>
                    <a href="#" class="menu"><?=Auth::instance()->get_user()->name?></a>

                    <ul class="menu-dropdown">
                        <li>
                            <a href="<?=URL::base()?>auth/logout">Logout</a>
                        </li>
                    </ul>

                    <? else: ?>

                    <form action="<?=URL::base()?>auth/login" method="post">
                        <input type="text" name="username" placeholder="Username" size="12" required autofocus
                               tabindex="1"/>
                        <input type="password" name="password" placeholder="Password" size="12" required tabindex="2"/>
                        <input type="submit" name="login" value="Login"/>
                    </form>
                    <? endif ?>
                </li>
            </ul>
        </div>
    </div>
</div>


<div class="container">
    <h1><?=$title?></h1>
    <?=Notify::render()?>
    <?=$content?>
</div>
<!-- Signup end -->

</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
<script src="<?=URL::base()?>assets/js/script.js" type="text/javascript"></script>
</body>
</html>
