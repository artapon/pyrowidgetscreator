<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * PyroCMS Develop Helper module
 *
 * @author Artapon Rittirote
 * @email a.rittirote@gmail.com 
 */
class Module_Pyrowidgetscreator extends Module{
	
	public $version = '1.0';
	
	public function info()
	{
		return array(
			'name'			=>array(
				'en'		=>'PyroCMS Widgets Creator'
			),
			'description'	=>array(
				'en'		=>'This module help to create basic widget structure and add some example'
			),
			'frontend'		=>FALSE,
			'backend'		=>True,
			'menu'			=>'content',
			
			'sections'=>array(
			
				'WidgetCreator'=>array(
						'name'=>'Widget Creator',
						'uri' =>'admin/pyrowidgetscreator',
			),
			
		),
	);
	}
	
	public function install()
	{
		return TRUE;
	}
	
	public function uninstall()
	{
		return TRUE;
	}
	
	public function upgrade($old_version)
	{
		return TRUE;
	}
	
	public function help()
	{
		return "";
	}
	
	
}
