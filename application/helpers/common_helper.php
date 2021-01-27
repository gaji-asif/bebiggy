<?php

if (!function_exists('pre')) {
	function pre($data, $exit =  null)
	{
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		if ($exit != null) {
			die;
		}
	}
}


if (!function_exists('fileIcon')) {

	function fileIcon($file_ext = '')
	{
		$fileArr = array(
			'.xls' => '<i class="fa fa-file-excel-o" aria-hidden="true" style="color: #539e53; font-size:100px;"></i>',
			'.xlsx' => '<i class="fa fa-file-excel-o" aria-hidden="true" style="color: #539e53; font-size:100px;"></i>',
			'.pdf' => '<i class="fa fa-file-pdf-o" aria-hidden="true" style="color: #f74747; font-size:100px;"></i>',
			'.mp4' => '<i class="fa fa-file-video-o" aria-hidden="true" style="color: #824545; font-size:100px;"></i>',
			'.wmv' => '<i class="fa fa-file-video-o" aria-hidden="true" style="color: #824545; font-size:100px;"></i>',
			'.doc' => '<i class="fa fa-file-word-o" aria-hidden="true" style="color: skyblue; font-size:100px;"></i>',
			'.docx' => '<i class="fa fa-file-word-o" aria-hidden="true" style="color: skyblue; font-size:100px;"></i>',
			'.zip' => '<i class="fa fa-file-archive-o" aria-hidden="true" style="color: #824545; font-size:100px;"></i>',
			'.txt' => '<i class="fa fa-file" aria-hidden="true" style="color: lightgray; font-size:100px;"></i>',
		);

		if (array_key_exists($file_ext, $fileArr)) {
			return $fileArr[$file_ext];
		} else {
			return  "";
		}
	}
}

if (!function_exists('_str_limit')) {
	function _str_limit($text_content, $limit = 20)
	{
		if (!empty($text_content)) {
			if (strlen($text_content) > 20) {
				return (!empty($text_content)) ? substr(trim($text_content), 0, $limit) . "..." : "";
			} else {
				return trim($text_content);
			}
		} else {
			return "";
		}
	}
}

if (!function_exists('_str_limit_price')) {
	function _str_limit_price($text_content, $limit = 20)
	{
		if (!empty($text_content)) {
			if (strlen($text_content) > 10) {
				return (!empty($text_content)) ? substr(trim($text_content), 0, $limit) : "";
			} else {
				return trim($text_content);
			}
		} else {
			return "";
		}
	}
}


/*
	Check if file exist and permisssion to that folder try to set permission if system cant then generate the alert
*/
function CheckFilePermissionOrgenerateAlert($path, $message = null)
{
	if (file_exists($path)) {
		$permission = exec('stat -c "%a" ' . $path);
		if ($permission != 777) {
			exec('chmod 777 -R ' . $path);
			$permission = exec('stat -c "%a" ' . $path);
		}

		if ($permission != 777) {
			$html =  '<div class="col-md-12">
			<div class="alert-danger alert in alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>';
			if (!empty($message)) {
				$html .= 'System Is Unable to Set Permission on Folder ' . $path . ', Currently We have ' . $permission . ', For Smooth Working Please Set 777';
			} else {
				$html .= 'System Is Unable to Set Permission on Folder ' . $path . ', Currently We have ' . $permission;
			}
			$html .= '</div></div>';
			echo $html;
		}
	}
}


/*
	Check File FOlder Owner try to set owner if system cant then generate Alert
*/
function CheckFileOwnerorgenerateAlert($path)
{
	if (file_exists($path)) {
		$owner 		= 	exec('whoami');
		$userset 	=  	exec('stat -c "%U" ' . $path);

		if ($userset != $owner) {
			exec('chown ' . $owner . ':' . $owner . ' -R ' . $path);
			$userset =  exec('stat -c "%U" ' . $path);
			if ($userset != $owner) {
				$html = '<div class="alert-danger alert in alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
						System Is Unable to Set Owner ' . $owner . ' on Folder ' . $path  . ', Currently We have ' . $userset .
					'</div>';

				echo $html;
			}
		}
	}
}

// function setCache($id, $data, $ttl = 60, $raw = FALSE)
// {
// 	$ci = &get_instance();
// 	$ci->load->driver('cache');
// 	$ci->cache->memcached->save($id, $data, $ttl, $raw);
// }
// function getCache($id)
// {

// 	$ci = &get_instance();
// 	$ci->load->driver('cache');
// 	if ($ci->cache->memcached->get($id)) {
// 		return $ci->cache->memcached->get($id);
// 	} else {
// 		return false;
// 	}
// }

// function deleteCache($id)
// {
// 	$ci = &get_instance();
// 	$ci->load->driver('cache');
// 	return $ci->cache->memcached->delete($id);
// }

function fileCache($id, $data = "", $action = "save", $ttl = 1748000)
{
	
	$ci = &get_instance();
	$ci->load->driver('cache');
	if ($action == 'save') {
		$ci->cache->file->save($id, $data, $ttl);
	} else if ($action == "get") {
		return $ci->cache->file->get($id);
	} else if ($action == "delete") {
		return $ci->cache->file->delete($id);
	}
}


function fileExists($filePath)
{
	return is_file($filePath) && file_exists($filePath);
}


function str_rep($str)
{
	return str_replace("/", "-", $str);
}

function getCIObject()
{
	$ci = &get_instance();
	$ci->load->model('DatabaseOperationsHandler', 'database');
	return 	$ci;
}

function getAllPermissionsAndMenus()
{
	if (empty(fileCache(getAdminSlug(), '', 'get'))) {
		$ci = getCIObject();
		$data = $ci->database->getAllPermissionsAndMenus();
		fileCache(getAdminSlug(),  $data);
	}
}

function getUserAdminPermission()
{
	if (empty(fileCache(getUserSlug(), '', 'get'))) {
		$ci = getCIObject();
		$data = $ci->database->getUserAdminPermission($ci->session->userdata('user_id'));
		fileCache(getUserSlug(),  $data);
	}
}
function getUserId(){
	$ci = getCIObject();
	return $ci->session->userdata('user_id');
}

function getUserSlug($data=""){
	return "user_".getUserId().$data;
	
}

function getAdminSlug(){
	return "admin_".getUserId();
	
}
function getUserWiseMenu($id = 0)
{
	getAllPermissionsAndMenus();
	getUserAdminPermission();

	$ci = getCIObject();
	if (!empty($id) && !empty(fileCache(getUserSlug(), '', 'get'))) {
		return  in_array($id, array_column(fileCache(getUserSlug(), '', 'get'), 'id'));
	} else if (!empty($id) && $ci->session->userdata('user_id') == 1) {
		return true;
	} else {
		return false;
	}
}


function checkRoute($controller, $action)
{
	$ci = getCIObject();
	@$controllerArr  = array_column(fileCache(getUserSlug(), '', 'get'), 'controller');
	@$actionArr  = array_column(fileCache(getUserSlug(), '', 'get'), 'action');
	if (!empty($controllerArr) && !empty($actionArr)) {

		if (in_array($controller, $controllerArr) && in_array($action, $actionArr)) {
			return true;
		} else {
			return false;
		}
	} else if (!empty($id) && getUserId() == 1) {
		return true;
	} else {
		return false;
	}
}

function checkRoutePermission()
{
	$ci 			= 	getCIObject();
	$controller 	= 	$ci->uri->segment(1);
	$action 		= 	$ci->uri->segment(2);
	if (checkRoute($controller, $action)) {
		return true;
	} else if (!empty(getUserId()) && getUserId() == 1) {
		return true;
	} else {
		return false;
	}
}
/*
 * on frontend, on each page email subscriber popup opens so each page we have different tags so this function is basically pull tags for every page
 * email popup was removed as per client's requirements on 9 December 2020, now we are using this function only for getting page route that user opened
*/
function emailSubscriberPageTags(){

	$ci 		 = 	getCIObject();
	$controller  = 	$ci->uri->segment(1);
	$action 	 = 	$ci->uri->segment(2);
	$forListing  =  $ci->uri->segment(3);
	$slug 		 =  "";

	/*
	 * Incase of listing URL was like classified/<listing_type>/<slug>, but getting tags from table, we need only <slug> so that is why we are skipping "classified/<listing_type>" , <listing_type> can be domain, website, app etc
	 * Problem that we can face: when slug will be same in different types of listing then it will pick wrong tags
	*/

	//if($controller != 'product' && $controller != 'classified' && $controller != 'course-detail' && $controller != 'blog_post') {
		//we don't need this incase of solution, listing, course and blog detail page
		$slug = str_replace("/","",$controller);
	//}

	/*if(trim($action)!='' && $controller != 'classified') {
		//we don't need this incase of listing detail page
		if($controller != 'product' && $controller != 'course-detail' && $controller != 'blog_post') {
			$slug .= '/';
		}

		$slug .= $action;
	}*/
	if(trim($action)!="") {
		$slug .= '/'.str_replace("/","",$action);	
	}
	

	if($forListing != '') {
		$slug .= '/'.str_replace("/","",$forListing);
	}

	//Following is only for listing detail page
	/*if($forListing != '' && $controller != 'classified') {
		$slug .= '/'.$forListing;
	} else if($forListing != '' && $controller == 'classified') {
		$slug .= $forListing;
	}*/
	
	if (!$ci->uri->segment(1)) {
    	return 'home';
	} else {
		return $slug;
	}

	/*$pageTags = EMAIL_SUBSCRIBER_PAGE_TAGS;
	$ci 			= 	getCIObject();
	$controller 	= 	$ci->uri->segment(1);
	$action 		= 	$ci->uri->segment(2);
	$slug = $controller;
	if(trim($action)!='') {
		$slug .= '-'.$action;
	}
	
	if (!$ci->uri->segment(1) && isset($pageTags['home'])) {
    	return $pageTags['home'];
	} else if(isset($pageTags[$slug])) {
		return $pageTags[$slug];
	} else {
		return "";
	}*/

}

