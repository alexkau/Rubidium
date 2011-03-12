<?
class module_page_admin_manage {
	function execute() {
		module_page_admin::$pageContent['pageList'] = self::getPageList();
	}
	function getPageList() {
		$pageList = classDB::getTable('module_page_pages', 'id', '*', '', '');
		print_r($pageList);
		return $pageList;
	}	
}
