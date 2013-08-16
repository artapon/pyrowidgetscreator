<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends Admin_Controller {
	
	protected $section 						= 'WidgetCreator';
	protected $form_input 					= array();
	protected $widget_path_default 			= "";
	protected $widget_path_shared_addons 	= "";
	protected $widget_path 					= "";
	
	
	
	protected $validation_create_widgets = array(
			array(
				'field'=>'name',
				'label'=>'Name',
				'rules'=>'trim|required'
		
				),
			array(
				'field'=>'position',
				'label'=>'Position',
				'rules'=>'trim'
		
				),
			array(
				'field'=>'description',
				'label'=>'Description',
				'rules'=>'trim'
		
				),
			array(
				'field'=>'author',
				'label'=>'Author',
				'rules'=>'trim'
				),
			array(
				'field'=>'version',
				'label'=>'Version',
				'rules'=>'trim'
				),
			array(
				'field'=>'website',
				'label'=>'Website',
				'rules'=>'trim'
			),
			array(
				'field'=>'example',
				'label'=>'Example',
				'rules'=>''
			),
		);
		
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('widgets_details_m');
		$this->load->model('widgets_slidejs_m');
		$this->lang->load('pyro_widgets_creator');
	}
	
	public function index()
	{
		$form_input  = $_POST;
		
		$this->form_validation->set_rules($this->validation_create_widgets);
		if($this->form_validation->run()){
			
			$widget_path_default 		= "addons/default/widgets/".strtolower($form_input['name']);
			$widget_path_shared_addons  = "addons/shared_addons/widgets/".strtolower($form_input['name']);
			$widget_path 				= "addons/".$form_input['position']."/widgets/".strtolower($form_input['name']);
			
			
			if(file_exists($widget_path_default) || file_exists($widget_path_shared_addons)){
				
				$this->session->set_flashdata('error',"Widget ".$form_input['name']." already exists ");
				redirect('admin/pyrowidgetscreator');
				
			}else{
				mkdir($widget_path,0775);
				mkdir($widget_path."/css",0775);
				mkdir($widget_path."/css/img",0775);
				mkdir($widget_path."/js",0775);
				mkdir($widget_path."/views",0775);
				
				$widget_controller  = fopen($widget_path."/".strtolower($form_input['name']).".php","w",0775);
				$widget_form		= fopen($widget_path."/views/form.php","w",0775);
				$widget_display		= fopen($widget_path."/views/display.php","w",0775);
				
				
				switch($form_input['example']){
					case "c_folder":
						fwrite($widget_controller,$this->widgets_details_m->widget_structure_with_ex($form_input));
						fwrite($widget_form, $this->widgets_details_m->widget_form_detail());
						fwrite($widget_display, $this->widgets_details_m->widget_display_detail());
					break;
					
					case "c_slidejs":
						fwrite($widget_controller,$this->widgets_details_m->widget_slidejs($form_input));
						fwrite($widget_form, $this->widgets_details_m->widget_form_detail());
						fwrite($widget_display, $this->widgets_slidejs_m->widgets_slidejs_display());
						$this->move_file_slidejs($widget_path,'slidejs');
					break;
						
					
					default:
						fwrite($widget_controller,$this->widgets_details_m->basic_widget_structure($form_input));
					break;
					
				}
				
				fclose($widget_controller);
				fclose($widget_form);
				fclose($widget_display);
				
				
				$this->session->set_flashdata('success',"Create Widget ".$form_input['name']." Success");
				
				redirect('admin/widgets');
			}
			
			
		}
		$widgets_form = new stdClass;
		foreach	($this->validation_create_widgets as $rule)
		{
			$widgets_form->{$rule['field']} = set_value($rule['field']);
		}
		
		$this->input->is_ajax_request() ? $this->template->set_layout(FALSE) : '';
		
		$this->template
			->set('widgets_form',$widgets_form)
			->build('admin/widgets/form');
	}

	public function move_file_slidejs($widget_path,$lib_name)
	{
		$dir_img 		= realpath(dirname(__FILE__) . '/..')."/libraries/".$lib_name."/css/img/";
		$to_img_dir  	= "\\css\\img\\";
		$this->copy_files($dir_img,$to_img_dir,$widget_path);
		$dir_css = realpath(dirname(__FILE__) . '/..')."/libraries/".$lib_name."/css/";
		$to_css_dir = "\\css\\";
		$this->copy_files($dir_css,$to_css_dir,$widget_path);
		
		$dir_js = realpath(dirname(__FILE__) . '/..')."/libraries/".$lib_name."/js/";
		$to_js_dir = "\\js\\";
		$this->copy_files($dir_js,$to_js_dir ,$widget_path);

	}

	public function copy_files($dir,$to_dir,$widget_path){
		if ($handle = opendir($dir)) {
        	while (false !== ($entry = readdir($handle))) {
            	if ($entry != "." && $entry != "..") {
            		if ( !is_dir($dir.$entry) ) {
                		copy($dir.$entry,$widget_path.$to_dir.$entry);
					}
           	 	}
        }
        	closedir($handle);
		}
	}
	
	
	


}
	