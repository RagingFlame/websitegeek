<?php

$sidebarWidth = $this->params->get('sidebarWidth');
$mainWidth = $this->params->get('mainWidth');

if(!$this->countModules('sidebar'))
{
  $sidebarWidth = 0;
  $mainWidth = 900;
}
?>