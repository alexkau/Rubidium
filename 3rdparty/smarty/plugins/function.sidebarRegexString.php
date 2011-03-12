<?php
function smarty_function_sidebarRegexString($params, $template) {
	preg_match('/^[^&]+/', $params['urlInfo'], $matches);
	return $matches[0];
}
