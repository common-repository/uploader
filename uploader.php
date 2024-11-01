<?php
	
	class Uploader
	{
		private $uploadify_path;
		private $uploader_path;
		
		public function __construct($base_path = '', $option_page = true)
		{
			add_action('plugins_loaded', array($this, 'init_uploader'));
			add_action('admin_menu', array($this, 'add_upload_page'));
			if($option_page) add_action('admin_menu', array($this, 'add_option_page'));
			
			$this->uploadify_path = plugins_url($base_path.'/uploader/uploadify/');
			$this->uploader_path = plugins_url($base_path.'/uploader/');
			
			register_uninstall_hook(__FILE__, array($this, 'uninstall_plugin'));
		}
		
		public function uninstall_plugin()
		{
			remove_role('uploader');
		
			delete_option('uploader_usebase');
			delete_option('uploader_basedir');
			delete_option('uploader_notif');
			delete_option('uploader_exts');
		}
		
		public function init_uploader()
		{
			add_role('uploader', 'Uploader', array('read' => true));
			
			$role = get_role('uploader');
			$role->add_cap('uploader_upload');
			
			$this->load_scripts();
			$this->load_styles();
		}
		
		private function load_styles()
		{
			wp_register_style('uploadifycss', $this->uploadify_path.'uploadify.css');
			wp_enqueue_style('uploadifycss');
			
			wp_register_style('uploadercss', $this->uploader_path.'style.css');
			wp_enqueue_style('uploadercss');
		}
		
		private function load_scripts()
		{
			$path = $this->uploadify_path;
			
			wp_register_script('uploadify', $path.'jquery.uploadify.v2.1.4.mod.js');
			wp_enqueue_script('uploadify');
			
			wp_register_script('uploadifyso', $path.'swfobject.js', array('uploadify'));
			wp_enqueue_script('uploadifyso');
		}
		
		public function add_upload_page()
		{
			$parent_slug = 'tools.php';
			$page_title = 'Uploader'; 
			$menu_title = 'Uploader';
			$capability = 'uploader_upload';
			$menu_slug = 'uploader';
			$function = array($this, 'echo_uploader');
			
			add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);
		}
		
		public function add_option_page()
		{
			$parent_slug = 'options-general.php';
			$page_title = 'Uploader Settings'; 
			$menu_title = 'Uploader';
			$capability = 'administrator';
			$menu_slug = 'uploader';
			$function = array($this, 'echo_settings_page');
		
			add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);
			add_action('admin_init', array($this, 'register_settings'));
		}
		
		public function register_settings()
		{
			$image_exts = '*.jpeg;*.jpg;*.gif;*.png;*.bmp;';
			$text_exts = '*.txt;*.rtf;*.doc;*.docx;';
			$archive_exts = '*.zip;*.sit;';
			$other_exts = '*.xls;*.xlsx;*.pdf';
		
			register_setting('uploader_settings', 'uploader_usebase');
			register_setting('uploader_settings', 'uploader_basedir');
			register_setting('uploader_settings', 'uploader_notif');
			register_setting('uploader_settings', 'uploader_exts');
			
			add_option('uploader_usebase', '');
			add_option('uploader_basedir', 'users');
			add_option('uploader_notif', 'on');
			add_option('uploader_exts', $image_exts.$text_exts.$archive_exts.$other_exts);
		}
		
		public function echo_settings_page()
		{	
			global $uploader;
			$fn = $uploader;
			
			$usebase = get_option('uploader_usebase');
			$basedir = get_option('uploader_basedir');
			$notif = get_option('uploader_notif');
			$exts = get_option('uploader_exts');
			
			include('views/options.php');
		}
		
		private function dir_from_url($url)
		{
			return '/'.implode(array_slice(explode('/', $url), 3), '/');
		}
		
		public function chbox($checked)
		{	
			return $checked == 'on' ? 'checked="checked"' : '';
		}
				
		public function echo_uploader()
		{
			if(!current_user_can('uploader_upload'))
			{
				wp_die(__('You do not have sufficient permissions to access this page.'));
			}
			else
			{
				global $current_user; get_currentuserinfo();
				$user_login = $current_user->user_login;
				
				$usebase = get_option('uploader_usebase');
				$basedir = get_option('uploader_basedir');
				$notif = get_option('uploader_notif');
				$exts = get_option('uploader_exts');
				
				$notified = ($notif == 'on' ? 'notif' : 'unnotif');
				$uploadify_path = $this->uploadify_path;
				$uploader_path = $this->uploader_path;
				$blogname = get_bloginfo('name');
				$email = get_bloginfo('admin_email');
				$display_name = $current_user->display_name;
				
				$upload_dir = wp_upload_dir();
				$base = $this->dir_from_url($upload_dir[($usebase == 'on' ? 'baseurl' : 'url')]);
				
				if($base == '/') $base = $this->dir_from_url(site_url()) . '/wp-content/uploads';
				
				if($usebase == 'on') $folder = $base. '/'.$basedir.'/' .$user_login;
				else $folder = $base. '/'.$user_login;
				
				include('views/upload.php');
			}
		}
	}
	
?>