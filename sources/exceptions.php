<?php
class databaseException extends Exception {
	public function errorMessage() {
		return "<div style='border: 1px solid #000;padding:10px'>".$this->getMessage()."</div>";
	}
}

/*
	try {
		if (mysqli_num_rows($pageInfo) > 1) {
			throw new databaseException("Database error: Multiple pages returned for unique ID");
		}
	}
	catch (Exception $e) {
		echo $e->errorMessage();
		die;
	}
*/
