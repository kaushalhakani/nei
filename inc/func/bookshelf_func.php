<?php
function query($sql) {
	// do query
	$this->query_id = @mysql_query($sql, $this->link_id);

	if (!$this->query_id) {
		//$this->oops("<b>MySQL Query fail:</b> $sql");
		return 0;
	}

	$this->affected_rows = @mysql_affected_rows($this->link_id);

	return $this->query_id;
}#-#query()


#-#############################################
# desc: fetches and returns results one line at a time
# param: query_id for mysql run. if none specified, last used
# return: (array) fetched record(s)
function fetch_array($query_id=-1) {
	// retrieve row
	if ($query_id!=-1) {
		$this->query_id=$query_id;
	}

	if (isset($this->query_id)) {
		$record = @mysql_fetch_assoc($this->query_id);
	}else{
		//$this->oops("Invalid query_id: <b>$this->query_id</b>. Records could not be fetched.");
	}

	return $record;
}#-#fetch_array()


#-#############################################
# desc: returns all the results (not one row)
# param: (MySQL query) the query to run on server
# returns: assoc array of ALL fetched results
function fetch_all_array($sql) {
	$query_id = $this->query($sql);
	$out = array();
	
	while ($row = $this->fetch_array($query_id)){
		$out[] = $row;
	}
	$this->free_result($query_id);
	return $out;
}#-#fetch_all_array()


#-#############################################
# desc: frees the resultset
# param: query_id for mysql run. if none specified, last used
function free_result($query_id=-1) {
	if ($query_id!=-1) {
		$this->query_id=$query_id;
	}
	if($this->query_id!=0 && !@mysql_free_result($this->query_id)) {
		//$this->oops("Result ID: <b>$this->query_id</b> could not be freed.");
	}
}#-#free_result()
?>