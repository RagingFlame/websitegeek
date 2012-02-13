<?php
$menu =& $mainframe->getMenu();
$active =& $menu->getActive();

if($this->countModules('sidebar'))
{
	$content = 'two-column';
} else {
	$content = 'one-column';
}

// Setup template parameters
$sidebarWidth = $this->params->get('sidebarWidth');
$mainWidth = $this->params->get('mainWidth');
?>