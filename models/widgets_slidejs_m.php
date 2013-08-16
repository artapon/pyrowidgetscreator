<?php defined('BASEPATH') or exit('No direct script access allowed');

class Widgets_slidejs_m extends MY_Model {
	public function widget_slidejs($input = array()) {
		if (strpos($input['website'], "http://") > 0) {
			$input['website'] = $input['website'];
		} else {
			$input['website'] = "http://" . $input['website'];
		}
		if (strpos($input['website'], "https://") > 0) {
			$input['website'] = $input['website'];
		} else {
			$input['website'] = "https://" . $input['website'];
		}

		$file_detail = "<?php defined('BASEPATH') OR exit('No direct script access allowed');\n\n
	
	class Widget_" . ucfirst($input['name']) . " extends Widgets
	{
		public \$title		= array(
			'en'	=>	'" . ucfirst($input['name']) . "'
		);\n
		
		public \$description = array(
			'en'	=>	'" . $input['description'] . "'
		);\n
		
		public \$author 	= '" . $input['author'] . "';\n
		
		public \$website	= '" . $input['website'] . "';\n
		
		
		public \$version	= '" . $input['version'] . "';\n
		
		public \$fields = array(
			array(
				'field' => 'folder',
				'label' => 'Folder of Image',
			),
		);
		
		public function __construct()
		{
			parent::__construct();
			
			Asset::add_path('" . $input['name'] . "',base_url().'addons/" . $input['position'] . "/widgets/" . $input['name'] . "/');
			Asset::css('" . $input['name'] . "::sliderjs.css');
			Asset::js('" . $input['name'] . "::jquery.slides.min.js');
		}
		
		
		
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

	public function widgets_slidejs_display() {
		$file_detail = "
<?php echo Asset::render_css();?>
<?php echo Asset::render_js();?>
		
<div class=\"slides\">
   <?php if(\$list_image):?>
		<?php foreach(\$list_image as \$image):?>
			<img width=\"900\" height=\"300\" src=\"{{ url:base }}uploads/default/files/<?php echo \$image->filename; ?>\"/>	
		<?php endforeach;?>
	<?php endif;?>
</div>

<script>
    $(function() {
      $('.slides').slidesjs({
        width: 900,
        height: 300,
        play: {
          active: true,
          auto: true,
          interval: 4000,
          swap: true
        }
      });
    });
  </script>		
		";

		return $file_detail;
	}

}
