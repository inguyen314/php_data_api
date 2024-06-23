<?php
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function find_netmiss_forecast($db, $tsid_netmiss, $tsid_netmiss_observe, $nws_day0_date) {
	$stmnt_query = null;
	$data = [];

	try {		
		$sql = "(select cwms_util.change_timezone(date_time, 'UTC', 'US/Central') as date_time
					,value
					,cwms_ts_id
					,cwms_util.split_text(cwms_ts_id, 1, '.') as location_id
					,unit_id
					,cwms_util.change_timezone(data_entry_date, 'UTC', 'US/Central') as data_entry_date
				from CWMS_20.AV_TSV_DQU_30D
				where cwms_ts_id = '".$tsid_netmiss."'
					and unit_id = 'ft')
				union all 
				(select date_time
					,value
					,cwms_ts_id
					,cwms_util.split_text(cwms_ts_id, 1, '.') as location_id
					,unit_id
					,data_entry_date
				from CWMS_20.AV_TSV_DQU_30D
				where cwms_ts_id = '".$tsid_netmiss_observe."'
					and unit_id = 'ft'
					and date_time = to_date('".$nws_day0_date."' || '06:00' ,'mm-dd-yyyy hh24:mi')) 
					
					order by date_time";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"date_time" => $row['DATE_TIME'],
				"value" => $row['VALUE'],
				"location_id" => $row['LOCATION_ID'],
				"cwms_ts_id" => $row['CWMS_TS_ID'],
				"unit_id" => $row['UNIT_ID'],
				"data_entry_date" => $row['DATA_ENTRY_DATE']
			];
			array_push($data,$obj);
		}
	}
	catch (Exception $e) {
		$e = oci_error($db);  
		trigger_error(htmlentities($e['message']), E_USER_ERROR);

		return null;
	}
	finally {
		oci_free_statement($stmnt_query); 
	}
	return $data;
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function find_netmiss($db, $tsid_netmiss) {
	$stmnt_query = null;
	$data = [];

	try {		
		$sql = "(select cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT') as date_time
        ,value
        ,cwms_ts_id
        ,cwms_util.split_text(cwms_ts_id, 1, '.') as location_id
        ,unit_id
        ,to_char(cwms_util.change_timezone(data_entry_date, 'UTC', 'CST6CDT'), 'mm/dd HH24:MI') as data_entry_date
    from CWMS_20.AV_TSV_DQU_30D
    where cwms_ts_id = '".$tsid_netmiss."'
        and unit_id = 'ft')
    order by date_time asc
	FETCH FIRST 1 ROW ONLY";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"date_time" => $row['DATE_TIME'],
				"value" => $row['VALUE'],
				"location_id" => $row['LOCATION_ID'],
				"cwms_ts_id" => $row['CWMS_TS_ID'],
				"unit_id" => $row['UNIT_ID'],
				"data_entry_date" => $row['DATA_ENTRY_DATE']
			];
			array_push($data,$obj);
		}
	}
	catch (Exception $e) {
		$e = oci_error($db);  
		trigger_error(htmlentities($e['message']), E_USER_ERROR);

		return null;
	}
	finally {
		oci_free_statement($stmnt_query); 
	}
	return $data;
}
?>
