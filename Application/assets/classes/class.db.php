<?php
class db {
	/**
	 * @access protected
	 * @return Mysqli A Mysqli object to do connection stuff to
	 */
	protected function connection() {
		global $mysqliHost, $mysqliUsername, $mysqliPassword, $mysqliDatabase;
		require_once __ROOT__ . '/assets/include/config.php';
		$mysqlData = get_mysql_data();
		$mysqli = new mysqli($mysqlData['host'], $mysqlData['username'], $mysqlData['pass'], $mysqlData['db']);
		$mysqli -> set_charset("utf8");
		return $mysqli;
	}

	/**
	 * run a MySQL query that has no variables.
	 * @param string The SQL query you want to run
	 * @param boolean If this is an insert query.
	 * @return Object an object with a status and a result. In case of an insert this result is an error about $stmt -> get_result() failing
	 */
	function query_0($sql, $insert) {
		$resultset = array();
		$mysqli = $this -> connection();
		if (!($stmt = $mysqli -> prepare($sql))) {
			$resultset['status'] = "failure";
			$resultset['result'] = "Prepare failed: (" . $mysqli -> errno . ") " . $mysqli -> error;
		}
		if (!$stmt -> execute()) {
			$resultset['status'] = "failure";
			$resultset['result'] = "Execute failed: (" . $stmt -> errno . ") " . $stmt -> error;
		}
		if (!($res = $stmt -> get_result())) {
			$resultset['status'] = "failure";
			$resultset['result'] = "Getting result set failed: (" . $stmt -> errno . ") " . $stmt -> error;
		} else {
			$resultset['status'] = "success";
			if (!$insert) {
				$results = $res -> fetch_all(MYSQL_ASSOC);
				$resultset['result'] = $results;
				$res -> free();
			}
		}
		$mysqli -> close();
		return $resultset;
	}
	
	/**
	 * run a MySQL query that has 1 variable.
	 * @param string The SQL query you want to run
	 * @param boolean If this is an insert query.
	 * @param string the sort of variable.
	 * @param string the variable to be filled out
	 * @see http://php.net/manual/en/mysqli-stmt.bind-param.php#types 
	 * @return Object an object with a status and a result. In case of an insert this result is an error about $stmt -> get_result() failing
	 */
	function query_1($sql, $insert, $argument_sort, $argument_1) {
		$resultset = array();
		$mysqli = $this -> connection();
		$argument_1 = $mysqli -> real_escape_string($argument_1);
		if (!($stmt = $mysqli -> prepare($sql))) {
			$resultset['status'] = "failure";
			$resultset['result'] = "Prepare failed: (" . $mysqli -> errno . ") " . $mysqli -> error;
		}
		if (!$stmt -> bind_param($argument_sort, $argument_1)) {
			$resultset['status'] = "failure";
			$resultset['result'] = "Execute failed: (" . $stmt -> errno . ") " . $stmt -> error;
		}
		if (!$stmt -> execute()) {
			$resultset['status'] = "failure";
			$resultset['result'] = "Execute failed: (" . $stmt -> errno . ") " . $stmt -> error;
		}
		if (!($res = $stmt -> get_result())) {
			$resultset['status'] = "failure";
			$resultset['result'] = "Getting result set failed: (" . $stmt -> errno . ") " . $stmt -> error;
		} else {
			$resultset['status'] = "success";
			if (!$insert) {
				$results = $res -> fetch_all(MYSQL_ASSOC);
				$resultset['result'] = $results;
				$res -> free();
			}
		}
		$mysqli -> close();
		return $resultset;
	}

	/**
	 * run a MySQL query that has 2 variables.
	 * @param string The SQL query you want to run
	 * @param boolean If this is an insert query.
	 * @param string the sort of variable.
	 * @param string variable #1
	 * @param string variable #2
	 * @see http://php.net/manual/en/mysqli-stmt.bind-param.php#types 
	 * @return Object an object with a status and a result. In case of an insert this result is an error about $stmt -> get_result() failing
	 */
	function query_2($sql, $insert, $argument_sort, $argument_1, $argument_2) {
		$resultset = array();
		$mysqli = $this -> connection();
		$argument_1 = $mysqli -> real_escape_string($argument_1);
		$argument_2 = $mysqli -> real_escape_string($argument_2);
		if (!($stmt = $mysqli -> prepare($sql))) {
			$resultset['status'] = "failure";
			$resultset['error'] = "Prepare failed: (" . $mysqli -> errno . ") " . $mysqli -> error;
		}
		if (!$stmt -> bind_param($argument_sort, $argument_1, $argument_2)) {
			$resultset['status'] = "failure";
			$resultset['error'] = "Execute failed: (" . $stmt -> errno . ") " . $stmt -> error;
		}
		if (!$stmt -> execute()) {
			$resultset['status'] = "failure";
			$resultset['result'] = "Execute failed: (" . $stmt -> errno . ") " . $stmt -> error;
		}
		if (!($res = $stmt -> get_result())) {
			$resultset['status'] = "failure";
			$resultset['result'] = "Getting result set failed: (" . $stmt -> errno . ") " . $stmt -> error;
		} else {
			$resultset['status'] = "success";
			if (!$insert) {
				$results = $res -> fetch_all(MYSQL_ASSOC);
				$resultset['result'] = $results;
				$res -> free();
			}
		}
		$mysqli -> close();
		return $resultset;
	}

	/**
	 * run a MySQL query that has 3 variables.
	 * @param string The SQL query you want to run
	 * @param boolean If this is an insert query.
	 * @param string the sort of variable.
	 * @param string variable #1
	 * @param string variable #2
	 * @param string variable #3
	 * @see http://php.net/manual/en/mysqli-stmt.bind-param.php#types 
	 * @return Object an object with a status and a result. In case of an insert this result is an error about $stmt -> get_result() failing
	 */
	function query_3($sql, $insert, $argument_sort, $argument_1, $argument_2, $argument_3) {
		$resultset = array();
		$mysqli = $this -> connection();
		$argument_1 = $mysqli -> real_escape_string($argument_1);
		$argument_2 = $mysqli -> real_escape_string($argument_2);
		$argument_3 = $mysqli -> real_escape_string($argument_3);
		if (!($stmt = $mysqli -> prepare($sql))) {
			$resultset['status'] = "failure";
			$resultset['error'] = "Prepare failed: (" . $mysqli -> errno . ") " . $mysqli -> error;
		}
		if (!$stmt -> bind_param($argument_sort, $argument_1, $argument_2, $argument_3)) {
			$resultset['status'] = "failure";
			$resultset['error'] = "Execute failed: (" . $stmt -> errno . ") " . $stmt -> error;
		}
		if (!$stmt -> execute()) {
			$resultset['status'] = "failure";
			$resultset['result'] = "Execute failed: (" . $stmt -> errno . ") " . $stmt -> error;
		}
		if (!($res = $stmt -> get_result())) {
			$resultset['status'] = "failure";
			$resultset['result'] = "Getting result set failed: (" . $stmt -> errno . ") " . $stmt -> error;
		} else {
			$resultset['status'] = "success";
			if (!$insert) {
				$results = $res -> fetch_all(MYSQL_ASSOC);
				$resultset['result'] = $results;
				$res -> free();
			}
		}
		$mysqli -> close();
		return $resultset;
	}

	/**
	 * run a MySQL query that has 4 variables.
	 * @param string The SQL query you want to run
	 * @param boolean If this is an insert query.
	 * @param string the sort of variable.
	 * @param string variable #1
	 * @param string variable #2
	 * @param string variable #3
	 * @param string variable #4
	 * @see http://php.net/manual/en/mysqli-stmt.bind-param.php#types 
	 * @return Object an object with a status and a result. In case of an insert this result is an error about $stmt -> get_result() failing
	 */
	function query_4($sql, $insert, $argument_sort, $argument_1, $argument_2, $argument_3, $argument_4) {
		$resultset = array();
		$mysqli = $this -> connection();
		$argument_1 = $mysqli -> real_escape_string($argument_1);
		$argument_2 = $mysqli -> real_escape_string($argument_2);
		$argument_3 = $mysqli -> real_escape_string($argument_3);
		$argument_4 = $mysqli -> real_escape_string($argument_4);
		if (!($stmt = $mysqli -> prepare($sql))) {
			$resultset['status'] = "failure";
			$resultset['error'] = "Prepare failed: (" . $mysqli -> errno . ") " . $mysqli -> error;
		}
		if (!$stmt -> bind_param($argument_sort, $argument_1, $argument_2, $argument_3, $argument_4)) {
			$resultset['status'] = "failure";
			$resultset['error'] = "Execute failed: (" . $stmt -> errno . ") " . $stmt -> error;
		}
		if (!$stmt -> execute()) {
			$resultset['status'] = "failure";
			$resultset['result'] = "Execute failed: (" . $stmt -> errno . ") " . $stmt -> error;
		}
		if (!($res = $stmt -> get_result())) {
			$resultset['status'] = "failure";
			$resultset['result'] = "Getting result set failed: (" . $stmt -> errno . ") " . $stmt -> error;
		} else {
			$resultset['status'] = "success";
			if (!$insert) {
				$results = $res -> fetch_all(MYSQL_ASSOC);
				$resultset['result'] = $results;
				$res -> free();
			}
		}
		$mysqli -> close();
		return $resultset;
	}

	/**
	 * run a MySQL query that has 5 variables.
	 * @param string The SQL query you want to run
	 * @param boolean If this is an insert query.
	 * @param string the sort of variable.
	 * @param string variable #1
	 * @param string variable #2
	 * @param string variable #3
	 * @param string variable #4
	 * @param string variable #5
	 * @see http://php.net/manual/en/mysqli-stmt.bind-param.php#types 
	 * @return Object an object with a status and a result. In case of an insert this result is an error about $stmt -> get_result() failing
	 */
	function query_5($sql, $insert, $argument_sort, $argument_1, $argument_2, $argument_3, $argument_4, $argument_5) {
		$resultset = array();
		$mysqli = $this -> connection();
		$argument_1 = $mysqli -> real_escape_string($argument_1);
		$argument_2 = $mysqli -> real_escape_string($argument_2);
		$argument_3 = $mysqli -> real_escape_string($argument_3);
		$argument_4 = $mysqli -> real_escape_string($argument_4);
		$argument_5 = $mysqli -> real_escape_string($argument_5);
		if (!($stmt = $mysqli -> prepare($sql))) {
			$resultset['status'] = "failure";
			$resultset['error'] = "Prepare failed: (" . $mysqli -> errno . ") " . $mysqli -> error;
		}
		if (!$stmt -> bind_param($argument_sort, $argument_1, $argument_2, $argument_3, $argument_4, $argument_5)) {
			$resultset['status'] = "failure";
			$resultset['error'] = "Execute failed: (" . $stmt -> errno . ") " . $stmt -> error;
		}
		if (!$stmt -> execute()) {
			$resultset['status'] = "failure";
			$resultset['result'] = "Execute failed: (" . $stmt -> errno . ") " . $stmt -> error;
		}
		if (!($res = $stmt -> get_result())) {
			$resultset['status'] = "failure";
			$resultset['result'] = "Getting result set failed: (" . $stmt -> errno . ") " . $stmt -> error;
		} else {
			$resultset['status'] = "success";
			if (!$insert) {
				$results = $res -> fetch_all(MYSQL_ASSOC);
				$resultset['result'] = $results;
				$res -> free();
			}
		}
		$mysqli -> close();
		return $resultset;
	}

	/**
	 * run a MySQL query that has 6 variables.
	 * @param string The SQL query you want to run
	 * @param boolean If this is an insert query.
	 * @param string the sort of variable.
	 * @param string variable #1
	 * @param string variable #2
	 * @param string variable #3
	 * @param string variable #4
	 * @param string variable #5
	 * @param string variable #6
	 * @see http://php.net/manual/en/mysqli-stmt.bind-param.php#types 
	 * @return Object an object with a status and a result. In case of an insert this result is an error about $stmt -> get_result() failing
	 */
	function query_6($sql, $insert, $argument_sort, $argument_1, $argument_2, $argument_3, $argument_4, $argument_5, $argument_6) {
		$resultset = array();
		$mysqli = $this -> connection();
		$argument_1 = $mysqli -> real_escape_string($argument_1);
		$argument_2 = $mysqli -> real_escape_string($argument_2);
		$argument_3 = $mysqli -> real_escape_string($argument_3);
		$argument_4 = $mysqli -> real_escape_string($argument_4);
		$argument_5 = $mysqli -> real_escape_string($argument_5);
		$argument_6 = $mysqli -> real_escape_string($argument_6);

		if (!($stmt = $mysqli -> prepare($sql))) {
			$resultset['status'] = "failure";
			$resultset['error'] = "Prepare failed: (" . $mysqli -> errno . ") " . $mysqli -> error;
		}
		if (!$stmt -> bind_param($argument_sort, $argument_1, $argument_2, $argument_3, $argument_4, $argument_5, $argument_6)) {
			$resultset['status'] = "failure";
			$resultset['error'] = "Execute failed: (" . $stmt -> errno . ") " . $stmt -> error;
		}
		if (!$stmt -> execute()) {
			$resultset['status'] = "failure";
			$resultset['result'] = "Execute failed: (" . $stmt -> errno . ") " . $stmt -> error;
		}
		if (!($res = $stmt -> get_result())) {
			$resultset['status'] = "failure";
			$resultset['result'] = "Getting result set failed: (" . $stmt -> errno . ") " . $stmt -> error;
		} else {
			$resultset['status'] = "success";
			if (!$insert) {
				$results = $res -> fetch_all(MYSQL_ASSOC);
				$resultset['result'] = $results;
				$res -> free();
			}
		}
		$mysqli -> close();
		return $resultset;
	}

	/**
	 * run a MySQL query that has 7 variables.
	 * @param string The SQL query you want to run
	 * @param boolean If this is an insert query.
	 * @param string the sort of variable.
	 * @param string variable #1
	 * @param string variable #2
	 * @param string variable #3
	 * @param string variable #4
	 * @param string variable #5
	 * @param string variable #6
	 * @param string variable #7
	 * @see http://php.net/manual/en/mysqli-stmt.bind-param.php#types 
	 * @return Object an object with a status and a result. In case of an insert this result is an error about $stmt -> get_result() failing
	 */
	function query_7($sql, $insert, $argument_sort, $argument_1, $argument_2, $argument_3, $argument_4, $argument_5, $argument_6, $argument_7) {
		$resultset = array();
		$mysqli = $this -> connection();
		$argument_1 = $mysqli -> real_escape_string($argument_1);
		$argument_2 = $mysqli -> real_escape_string($argument_2);
		$argument_3 = $mysqli -> real_escape_string($argument_3);
		$argument_4 = $mysqli -> real_escape_string($argument_4);
		$argument_5 = $mysqli -> real_escape_string($argument_5);
		$argument_6 = $mysqli -> real_escape_string($argument_6);
		$argument_7 = $mysqli -> real_escape_string($argument_7);
		if (!($stmt = $mysqli -> prepare($sql))) {
			$resultset['status'] = "failure";
			$resultset['error'] = "Prepare failed: (" . $mysqli -> errno . ") " . $mysqli -> error;
		}
		if (!$stmt -> bind_param($argument_sort, $argument_1, $argument_2, $argument_3, $argument_4, $argument_5, $argument_6, $argument_7)) {
			$resultset['status'] = "failure";
			$resultset['error'] = "Execute failed: (" . $stmt -> errno . ") " . $stmt -> error;
		}
		if (!$stmt -> execute()) {
			$resultset['status'] = "failure";
			$resultset['result'] = "Execute failed: (" . $stmt -> errno . ") " . $stmt -> error;
		}
		if (!($res = $stmt -> get_result())) {
			$resultset['status'] = "failure";
			$resultset['result'] = "Getting result set failed: (" . $stmt -> errno . ") " . $stmt -> error;
		} else {
			$resultset['status'] = "success";
			if (!$insert) {
				$results = $res -> fetch_all(MYSQL_ASSOC);
				$resultset['result'] = $results;
				$res -> free();
			}
		}
		$mysqli -> close();
		return $resultset;
	}

	/**
	 * run a MySQL query that has 8 variables.
	 * @param string The SQL query you want to run
	 * @param boolean If this is an insert query.
	 * @param string the sort of variable.
	 * @param string variable #1
	 * @param string variable #2
	 * @param string variable #3
	 * @param string variable #4
	 * @param string variable #5
	 * @param string variable #6
	 * @param string variable #7
	 * @param string variable #8
	 * @see http://php.net/manual/en/mysqli-stmt.bind-param.php#types 
	 * @return Object an object with a status and a result. In case of an insert this result is an error about $stmt -> get_result() failing
	 */
	function query_8($sql, $insert, $argument_sort, $argument_1, $argument_2, $argument_3, $argument_4, $argument_5, $argument_6, $argument_7, $argument_8) {
		$resultset = array();
		$mysqli = $this -> connection();
		$argument_1 = $mysqli -> real_escape_string($argument_1);
		$argument_2 = $mysqli -> real_escape_string($argument_2);
		$argument_3 = $mysqli -> real_escape_string($argument_3);
		$argument_4 = $mysqli -> real_escape_string($argument_4);
		$argument_5 = $mysqli -> real_escape_string($argument_5);
		$argument_6 = $mysqli -> real_escape_string($argument_6);
		$argument_7 = $mysqli -> real_escape_string($argument_7);
		$argument_8 = $mysqli -> real_escape_string($argument_8);
		if (!($stmt = $mysqli -> prepare($sql))) {
			$resultset['status'] = "failure";
			$resultset['error'] = "Prepare failed: (" . $mysqli -> errno . ") " . $mysqli -> error;
		}
		if (!$stmt -> bind_param($argument_sort, $argument_1, $argument_2, $argument_3, $argument_4, $argument_5, $argument_6, $argument_7, $argument_8)) {
			$resultset['status'] = "failure";
			$resultset['error'] = "Execute failed: (" . $stmt -> errno . ") " . $stmt -> error;
		}
		if (!$stmt -> execute()) {
			$resultset['status'] = "failure";
			$resultset['result'] = "Execute failed: (" . $stmt -> errno . ") " . $stmt -> error;
		}
		if (!($res = $stmt -> get_result())) {
			$resultset['status'] = "failure";
			$resultset['result'] = "Getting result set failed: (" . $stmt -> errno . ") " . $stmt -> error;
		} else {
			$resultset['status'] = "success";
			if (!$insert) {
				$results = $res -> fetch_all(MYSQL_ASSOC);
				$resultset['result'] = $results;
				$res -> free();
			}
		}
		$mysqli -> close();
		return $resultset;
	}

	/**
	 * run a MySQL query that has 9 variables.
	 * @param string The SQL query you want to run
	 * @param boolean If this is an insert query.
	 * @param string the sort of variable.
	 * @param string variable #1
	 * @param string variable #2
	 * @param string variable #3
	 * @param string variable #4
	 * @param string variable #5
	 * @param string variable #6
	 * @param string variable #7
	 * @param string variable #8
	 * @param string variable #9
	 * @see http://php.net/manual/en/mysqli-stmt.bind-param.php#types 
	 * @return Object an object with a status and a result. In case of an insert this result is an error about $stmt -> get_result() failing
	 */
	function query_9($sql, $insert, $argument_sort, $argument_1, $argument_2, $argument_3, $argument_4, $argument_5, $argument_6, $argument_7, $argument_8, $argument_9) {
		$resultset = array();
		$mysqli = $this -> connection();
		$argument_1 = $mysqli -> real_escape_string($argument_1);
		$argument_2 = $mysqli -> real_escape_string($argument_2);
		$argument_3 = $mysqli -> real_escape_string($argument_3);
		$argument_4 = $mysqli -> real_escape_string($argument_4);
		$argument_5 = $mysqli -> real_escape_string($argument_5);
		$argument_6 = $mysqli -> real_escape_string($argument_6);
		$argument_7 = $mysqli -> real_escape_string($argument_7);
		$argument_8 = $mysqli -> real_escape_string($argument_8);
		$argument_9 = $mysqli -> real_escape_string($argument_9);
		if (!($stmt = $mysqli -> prepare($sql))) {
			$resultset['status'] = "failure";
			$resultset['error'] = "Prepare failed: (" . $mysqli -> errno . ") " . $mysqli -> error;
		}
		if (!$stmt -> bind_param($argument_sort, $argument_1, $argument_2, $argument_3, $argument_4, $argument_5, $argument_6, $argument_7, $argument_8, $argument_9)) {
			$resultset['status'] = "failure";
			$resultset['error'] = "Execute failed: (" . $stmt -> errno . ") " . $stmt -> error;
		}
		if (!$stmt -> execute()) {
			$resultset['status'] = "failure";
			$resultset['result'] = "Execute failed: (" . $stmt -> errno . ") " . $stmt -> error;
		}
		if (!($res = $stmt -> get_result())) {
			$resultset['status'] = "failure";
			$resultset['result'] = "Getting result set failed: (" . $stmt -> errno . ") " . $stmt -> error;
		} else {
			$resultset['status'] = "success";
			if (!$insert) {
				$results = $res -> fetch_all(MYSQL_ASSOC);
				$resultset['result'] = $results;
				$res -> free();
			}else{
				$resultset['result'] = $res;
			}
		}
		$mysqli -> close();
		return $resultset;
	}

}
?>