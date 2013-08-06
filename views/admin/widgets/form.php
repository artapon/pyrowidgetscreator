<section class="title" >
<h4><?php echo lang('pyro_widgets_creator.title');?></h4>
</section>
<?php echo form_open(uri_string());?>
<section class="item">
	<div class="tabs">

		<ul class="tab-menu">

			<li><a href="#create-content"><span><?php echo lang('pyro_widgets_creator.title');?></span></a></li>
		</ul>
		<div class="form_inputs" id="create-content">
			<fieldset>
				<ul>
					<li>
						<label for="position"><?php echo lang('pyro_widgets_creator.position');?></label>
						<div class="input"><?php echo form_dropdown('position', array('default' => 'Default Folder','shared_addons' => 'Shared Addons Folder'),@$widgets_form->position); ?></div>
					</li>
					<li>
						<label for="name-english"><?php echo lang('pyro_widgets_creator.name');?><font color="red">*</font></label>
						<div class="input"><?php echo form_input('name',@$widgets_form->name); ?></div>
					</li>
					<li>
						<label for="description"><?php echo lang('pyro_widgets_creator.description');?></label>
						<div class="input"><?php echo form_input('description',@$widgets_form->description); ?></div>
					</li>
					<li>
						<label for="author"><?php echo lang('pyro_widgets_creator.author');?></label>
						<div class="input"><?php echo form_input('author',@$widgets_form->author); ?></div>
					</li>
					<li>
						<label for="website"><?php echo lang('pyro_widgets_creator.website');?></label>
						<div class="input"><?php echo form_input('website',@$widgets_form->website); ?></div>
					</li>
					<li>
						<label for="version"><?php echo lang('pyro_widgets_creator.website');?></label>
						<div class="input"><?php echo form_input('version',@$widgets_form->version); ?></div>
					</li>
				</ul>
			</fieldset>
			
			<fieldset>
				
				<section>
					<h4><?php echo lang('pyro_widgets_creator.option');?></h4>
					<table border="0" >
						<tbody>
							<tr>
								<td>
									<?php echo form_radio('example','',1); ?>&nbsp;
									<label for="example"><?php echo lang('pyro_widgets_creator.basic_widgets_struture');?></label>
								</td>
							
								<td>
									<?php echo form_radio('example','c_folder'); ?>&nbsp;
									<label for="example"><?php echo lang('pyro_widgets_creator.connect_folder_select');?></label>
								</td>
							
								<td>
									<?php echo form_radio('example','c_file'); ?>&nbsp;
									<label for="example"><?php echo lang('pyro_widgets_creator.connect_file_select');?></label>
								</td>
								<td>
									<?php echo form_radio('example','c_fancy_box'); ?>&nbsp;
									<label for="example"><?php echo lang('pyro_widgets_creator.fancy_box');?></label>
								</td>
								<td>
									<?php echo form_radio('example','c_slidejs'); ?>&nbsp;
									<label for="example"><?php echo lang('pyro_widgets_creator.slide_js');?></label>
								</td>
							</tr>
						</tbody>
					</table>
				</section>
			</fieldset>
		</div>
		<div class="buttons" >
			<?php echo form_submit('submit',"Create",'class="btn green" style="width:150px;height:40px;float:right;" ');?>
		</div>
	</div>
</section>
<?php echo form_close();?>