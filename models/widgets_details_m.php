<?php defined('BASEPATH') or exit('No direct script access allowed');




class Widgets_details_m extends MY_Model{
	
	public function basic_widget_structure($input = array())
	{
		$file_detail = 
"<?php defined('BASEPATH') OR exit('No direct script access allowed');\n\n
	
	class Widget_".ucfirst($input['name'])." extends Widgets
	{
		public \$title		= array(
			'en'	=>	'".ucfirst($input['name'])."'
		);\n
		
		public \$description = array(
			'en'	=>	'".$input['description']."'
		);\n
		
		public \$author 	= '".$input['author']."';\n
		public \$website	= '".$input['website']."';\n
		public \$version	= '".$input['version']."';\n
		
		
		public function form()
		{
				
			// return query to admin widgets form
			return array(
				''=>''
			);
		}
		
		public function run(\$options)
		{
			// return query to display.php
			return array(
				''=>''
			);
		}
	}
		";
		
	return $file_detail;
	
	}
	
	public function widget_structure_with_ex($input = array())
	{
		
		if(strpos($input['website'],"http://")>0){
			$input['website'] = $input['website'];
		}else{
			$input['website'] = "http://".$input['website'];
		}
		if(strpos($input['website'],"https://")>0){
			$input['website'] = $input['website'];
		}else{
			$input['website'] = "https://".$input['website'];
		}
		
		$file_detail = 
"<?php defined('BASEPATH') OR exit('No direct script access allowed');\n\n
	
	class Widget_".ucfirst($input['name'])." extends Widgets
	{
		public \$title		= array(
			'en'	=>	'".ucfirst($input['name'])."'
		);\n
		
		public \$description = array(
			'en'	=>	'".$input['description']."'
		);\n
		
		public \$author 	= '".$input['author']."';\n
		
		public \$website	= '".$input['website']."';\n
		
		
		public \$version	= '".$input['version']."';\n
		
		public \$fields = array(
			array(
				'field' => 'folder',
				'label' => 'Folder of Image',
			),
		);
		public function form()
		{
			\$folders_list = \$this->db->get('file_folders')->result();
			\$folders = array();
			
			if(!empty(\$folders_list)){
				foreach(\$folders_list as \$folder)
				{
					\$folders[\$folder->id] = \$folder->name;
				}
			}
			// return query to admin widgets form
			return array(
				'folders' => \$folders
			);
		}
		
		public function run(\$options)
		{
			\$list_image = \$this->db->where('folder_id',\$options['folder'])->get('files')->result();
			// return query to display.php
			return array(
				'list_image' => \$list_image,
			);
		}
	}
		";
		
	return $file_detail;
	}
	
	public function widget_form_detail()
	{
		$file_detail = "
		<ul>
			<li>
				<label>Folder</label>
				<?php echo form_dropdown('folder', \$folders, @\$options['folder']); ?>
			</li>
		</ul>
		
		";
		return $file_detail;
	}
	
	public function widget_display_detail()
	{
		$file_detail = "
<?php
		print_r(\$list_image);
?>
		
		";
		return $file_detail;
	}
}
	