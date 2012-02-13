<?php 
defined( '_JEXEC' ) or die('Restricted Access');  // Restrict access to J! only
require_once('templates/' . $this->template . '/framework.php'); 
$this->setGenerator(null);  // Remove the Joomla meta tag
$user =& JFactory::getUser();
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?php echo $this->language; ?>"> <!--<![endif]-->
<head>
<jdoc:include type="head" />
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="shortcut icon" href="templates/<?php echo $this->template; ?>/favicon.ico">
<link rel="apple-touch-icon" href="templates/<?php echo $this->template; ?>/apple-touch-icon.png">
<link rel="stylesheet" href="templates/<?php echo $this->template; ?>/css/style.css?v=1">
<link rel="stylesheet" media="handheld" href="templates/<?php echo $this->template; ?>/css/handheld.css?v=1">
<script src="templates/<?php echo $this->template; ?>/js/modernizr-2.0.6.min.js"></script>
</head>
<body>
  <div id="container">
    <header class="header container">
        <a href="/" id="logo-link"><!-- <img class="logo" src="templates/<?php echo $this->template ?>/images/logo.png" width="110" height="24" alt="--><?php echo $mainframe->getCfg('sitename');?> <!--" /> --></a>
      	<ul class="navigation">
        <?php
          if($user->guest) { 
        ?>
          <li><a href="index.php?option=com_user&view=register">Signup</a></li> |
          <li><a href="index.php?option=com_user&view=login">Login</a></li>
        <?php
          } else {
        ?>
          <li> | <a href="index.php?option=com_user&view=login&task=logout&return=<?php echo base64_encode('index.php'); ?>">Logout</a></li>
        <?php
          }        
        ?>
      	</ul>
    </header>

    <?php if($this->countModules('banner') && $this->countModules('user3')) : ?>
    <div class="banner">
      <div class="container">
        <div style="width: 49%; float:left; overflow:hidden;">
         <jdoc:include type="modules" name="banner" style="XHTML" />
        </div>
        <div style="width: 49%; float:right; overflow:hidden;">
            <jdoc:include type="modules" name="user3" style="XHTML" />
        </div>
      </div>
    </div><!-- #banner -->
    <?php endif; ?>
    
    <?php if($this->countModules('banner') && !$this->countModules('user3')) : ?>
    <div class="banner">
      <div class="container">
        <jdoc:include type="modules" name="banner" style="XHTML" />
      </div>
    </div><!-- #banner -->
    <?php endif; ?>
    
    <?php if(!$this->countModules('banner') && $this->countModules('user3')) : ?>
    <div class="banner">
      <div class="container">
       <jdoc:include type="modules" name="user3" style="XHTML" />
      </div>
    </div><!-- #banner -->
    <?php endif; ?>
    
    <div id="main" class="container">
        <?php if($this->countModules('sidebar')) : ?>
			<aside id="sidebar" class="right-panel" style="width: <?php echo $sidebarWidth; ?>px;">
				<jdoc:include type="modules" name="sidebar" style="XHTML" />
			</aside><!-- aside#sidebar -->
        <?php endif; ?>

		<section id="content" class="main-panel" style="width: <?php echo $mainWidth; ?>px;">
          <?php if($this->countModules('user1')) : ?>
            <jdoc:include type="modules" name="user1" style="XHTML" />
          <?php endif; ?>
          
          <jdoc:include type="component" />
          
          <?php if($this->countModules('user2')) : ?>
            <jdoc:include type="modules" name="user2" style="XHTML" />
          <?php endif; ?>
        </section><!-- section#content -->	
    </div>
    
    <footer class="container footer">
        <jdoc:include type="modules" name="footer" style="XHTML" />
    </footer>
  </div> <!--! end of #container -->

  <!-- Grab Google CDN's jQuery. fall back to local if necessary -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>!window.jQuery && document.write('<script src="templates/<?php echo $this->template; ?>/js/jquery-1.7.1.min.js"><\/script>')</script>
<script src="templates/<?php echo $this->template; ?>/js/plugins.js?v=1"></script>
<script src="templates/<?php echo $this->template; ?>/js/script.js?v=1"></script>
<script>/*
    var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']]; // Change UA-XXXXX-X to be your site's ID
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));*/
</script>
<!--[if lt IE 7 ]>
<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script>
<script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
<![endif]-->
</body>
</html>