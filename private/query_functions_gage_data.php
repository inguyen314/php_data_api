<?php
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_stage_data($db, $cwms_ts_id) {
	$stmnt_query = null;
	$data = null;
	
	try {		
		$sql = "with cte_last_max as (                
					select ts_code, 
						date_time, 
						cwms_ts_id, 
						cwms_util.split_text(cwms_ts_id, 1, '.') as location_id, 
						cwms_util.split_text(cwms_ts_id, 2, '.') as parameter_id, 
						value, 
						unit_id, 
						quality_code
					from CWMS_20.AV_TSV_DQU_30D
					where cwms_ts_id = '".$cwms_ts_id."'
					and (unit_id = 'ppm' or unit_id = 'F' or unit_id = CASE WHEN cwms_util.split_text(cwms_ts_id,2,'.') IN ('Stage','Elev') THEN 'ft' WHEN cwms_util.split_text(cwms_ts_id,2,'.') IN ('Precip','Depth') THEN 'in' END or unit_id = 'cfs' or unit_id = 'umho/cm' or unit_id = 'volt' or unit_id = 'su' or unit_id = 'FNU' or unit_id = 'mph' or unit_id = 'in-hg' or unit_id = 'deg')
					order by date_time desc
					fetch first 1 rows only
				),
				cte_6_hr as (
					select ts_code, 
						date_time, 
						cwms_ts_id, 
						cwms_util.split_text(cwms_ts_id, 1, '.') as location_id, 
						cwms_util.split_text(cwms_ts_id, 2, '.') as parameter_id, 
						value as value_6_hr, 
						unit_id, 
						quality_code
					from CWMS_20.AV_TSV_DQU_30D
					where cwms_ts_id = '".$cwms_ts_id."'
					and (unit_id = 'ppm' or unit_id = 'F' or unit_id = CASE WHEN cwms_util.split_text(cwms_ts_id,2,'.') IN ('Stage','Elev') THEN 'ft' WHEN cwms_util.split_text(cwms_ts_id,2,'.') IN ('Precip','Depth') THEN 'in' END or unit_id = 'cfs' or unit_id = 'umho/cm' or unit_id = 'volt' or unit_id = 'su' or unit_id = 'FNU' or unit_id = 'mph' or unit_id = 'in-hg' or unit_id = 'deg')
					and date_time = to_date((select (date_time - interval '6' hour) from cte_last_max) ,'mm-dd-yyyy hh24:mi:ss')
					order by date_time desc
					fetch first 1 rows only
				),
				cte_24_hr as (
					select ts_code, 
						date_time, 
						cwms_ts_id, 
						cwms_util.split_text(cwms_ts_id, 1, '.') as location_id, 
						cwms_util.split_text(cwms_ts_id, 2, '.') as parameter_id, 
						value as value_24_hr, 
						unit_id, 
						quality_code
					from CWMS_20.AV_TSV_DQU_30D
					where cwms_ts_id = '".$cwms_ts_id."'
					and (unit_id = 'ppm' or unit_id = 'F' or unit_id = CASE WHEN cwms_util.split_text(cwms_ts_id,2,'.') IN ('Stage','Elev') THEN 'ft' WHEN cwms_util.split_text(cwms_ts_id,2,'.') IN ('Precip','Depth') THEN 'in' END or unit_id = 'cfs' or unit_id = 'umho/cm' or unit_id = 'volt' or unit_id = 'su' or unit_id = 'FNU' or unit_id = 'mph' or unit_id = 'in-hg' or unit_id = 'deg')
					and date_time = to_date((select (date_time - interval '24' hour) from cte_last_max) ,'mm-dd-yyyy hh24:mi:ss')
					order by date_time desc
					fetch first 1 rows only
				)
				select last_max.ts_code, 
					last_max.date_time, 
					cwms_util.change_timezone(last_max.date_time, 'UTC', 'CST6CDT' ) as date_time_cst, 
					last_max.cwms_ts_id, 
					last_max.location_id, 
					last_max.parameter_id,
					last_max.value, 
					last_max.unit_id, 
					last_max.quality_code,
					
					cte_6_hr.date_time as date_time_6, 
					cwms_util.change_timezone(cte_6_hr.date_time, 'UTC', 'CST6CDT' ) as date_time_6_cst, 
					cte_6_hr.value_6_hr as value_6,
					
					cte_24_hr.date_time as date_time_24, 
					cwms_util.change_timezone(cte_24_hr.date_time, 'UTC', 'CST6CDT' ) as date_time_24_cst, 
					cte_24_hr.value_24_hr as value_24,

					(last_max.value - cte_6_hr.value_6_hr) as delta_6,
					(last_max.value - cte_24_hr.value_24_hr) as delta_24,

					sysdate - interval '8' hour as late_date
				from cte_last_max last_max
					left join cte_6_hr cte_6_hr
					on last_max.cwms_ts_id = cte_6_hr.cwms_ts_id
						left join cte_24_hr cte_24_hr
						on last_max.cwms_ts_id = cte_24_hr.cwms_ts_id";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			
			$data = (object) [
				"ts_code" => $row['TS_CODE'],
				"date_time" => $row['DATE_TIME'],
				"date_time_cst" => $row['DATE_TIME_CST'],
				"cwms_ts_id" => $row['CWMS_TS_ID'],
				"location_id" => $row['LOCATION_ID'],
				"parameter_id" => $row['PARAMETER_ID'],
				"value" => $row['VALUE'],
				"unit_id" => $row['UNIT_ID'],
				"quality_code" => $row['QUALITY_CODE'],
				"date_time_6" => $row['DATE_TIME_6'],
				"date_time_6_cst" => $row['DATE_TIME_6_CST'],
				"value_6" => $row['VALUE_6'],
				"date_time_24" => $row['DATE_TIME_24'],
				"date_time_24_cst" => $row['DATE_TIME_24_CST'],
				"value_24" => $row['VALUE_24'],
				"delta_6" => $row['DELTA_6'],
				"delta_24" => $row['DELTA_24'],
				"late_date" => $row['LATE_DATE']
			];
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
function find_nws_forecast($db, $cwms_ts_id, $nws_day1_date, $nws_day2_date, $nws_day3_date) {
	$stmnt_query = null;
	$data = null;
	try {		
		$sql = "with cte_day1 as (select cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT') as date_time
					,value
					,cwms_ts_id
					,cwms_util.split_text(cwms_ts_id, 1, '.') as location_id
					,unit_id
					,to_char(cwms_util.change_timezone(data_entry_date, 'UTC', 'CST6CDT'), 'mm/dd HH24:MI') as data_entry_date
				from CWMS_20.AV_TSV_DQU
				where cwms_ts_id = '".$cwms_ts_id."'
					and unit_id = 'ft'
					and date_time = to_date('".$nws_day1_date."' || '12:00' ,'mm-dd-yyyy hh24:mi')
				),
				
				day_2 as (
				select cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT') as date_time
					,value
					,cwms_ts_id
					,cwms_util.split_text(cwms_ts_id, 1, '.') as location_id
					,unit_id
					,to_char(cwms_util.change_timezone(data_entry_date, 'UTC', 'CST6CDT'), 'mm/dd HH24:MI') as data_entry_date
				from CWMS_20.AV_TSV_DQU
				where cwms_ts_id = '".$cwms_ts_id."'
					and unit_id = 'ft'
					and date_time = to_date('".$nws_day2_date."' || '12:00' ,'mm-dd-yyyy hh24:mi')
				),
				
				day_3 as (
				select cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT') as date_time
					,value
					,cwms_ts_id
					,cwms_util.split_text(cwms_ts_id, 1, '.') as location_id
					,unit_id
					,to_char(cwms_util.change_timezone(data_entry_date, 'UTC', 'CST6CDT'), 'mm/dd HH24:MI') as data_entry_date
				from CWMS_20.AV_TSV_DQU
				where cwms_ts_id = '".$cwms_ts_id."'
					and unit_id = 'ft'
					and date_time = to_date('".$nws_day3_date."' || '12:00' ,'mm-dd-yyyy hh24:mi')
				)
				
				select day1.date_time as date_time_day1, day1.value as value_day1, day1.cwms_ts_id as cwms_ts_id_day1, day1.location_id as location_id_day1, day1.unit_id as unit_id_day1, day1.data_entry_date as data_entry_date_day1
					,day2.date_time as date_time_day2, day2.value as value_day2, day2.cwms_ts_id as cwms_ts_id_day2, day2.location_id as location_id_day2, day2.unit_id as unit_id_day2, day2.data_entry_date as data_entry_date_day2
					,day3.date_time as date_time_day3, day3.value as value_day3, day3.cwms_ts_id as cwms_ts_id_day3, day3.location_id as location_id_day3, day3.unit_id as unit_id_day3, day3.data_entry_date as data_entry_date_day3
				from cte_day1 day1
					left join day_2 day2
					on day1.location_id = day2.location_id
						left join day_3 day3
						on day1.location_id = day3.location_id
				";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			
			$data = (object) [
				"date_time_day1" => $row['DATE_TIME_DAY1'],
				"data_entry_date_day1" => $row['DATA_ENTRY_DATE_DAY1'],
				"value_day1" => $row['VALUE_DAY1'],
				"unit_id_day1" => $row['UNIT_ID_DAY1'],
				"cwms_ts_id_day1" => $row['CWMS_TS_ID_DAY1'],
				"location_id_day1" => $row['LOCATION_ID_DAY1'],
				"date_time_day2" => $row['DATE_TIME_DAY2'],
				"data_entry_date_day2" => $row['DATA_ENTRY_DATE_DAY2'],
				"value_day2" => $row['VALUE_DAY2'],
				"unit_id_day2" => $row['UNIT_ID_DAY2'],
				"cwms_ts_id_day2" => $row['CWMS_TS_ID_DAY2'],
				"location_id_day2" => $row['LOCATION_ID_DAY2'],
				"date_time_day3" => $row['DATE_TIME_DAY3'],
				"data_entry_date_day3" => $row['DATA_ENTRY_DATE_DAY3'],
				"value_day3" => $row['VALUE_DAY3'],
				"unit_id_day3" => $row['UNIT_ID_DAY3'],
				"cwms_ts_id_day3" => $row['CWMS_TS_ID_DAY3'],
				"location_id_day3" => $row['LOCATION_ID_DAY3']
			];
			
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
function get_record_stage($db, $location_id) {
	$stmnt_query = null;
	$data = null;
	
	try {		
		$sql = "select location_id
					,location_level_id
					,level_date
					,constant_level
					,level_unit
				from CWMS_20.AV_LOCATION_LEVEL
				where specified_level_id = 'Record Stage' 
				and location_id = '".$location_id."' 
				and unit_system = 'EN'";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$data = (object) [
				"location_id" => $row['LOCATION_ID'],
				"location_level_id" => $row['LOCATION_LEVEL_ID'],
				"level_date" => $row['LEVEL_DATE'],
				"constant_level" => $row['CONSTANT_LEVEL'],
				"level_unit" => $row['LEVEL_UNIT']
			];
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
function get_table_data($db, $cwms_ts_id, $start_day, $end_day) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "select cwms_ts_id
					,cwms_util.change_timezone(tsv.date_time, 'UTC', 'CST6CDT' ) as date_time
					,cwms_util.split_text('".$cwms_ts_id."' ,1,'.') as location_id
					,cwms_util.split_text('".$cwms_ts_id."' ,2,'.') as parameter_id
					,cwms_util.split_text('".$cwms_ts_id."' ,6,'.') as version_id
					,value
					,unit_id
					,quality_code
				from cwms_v_tsv_dqu  tsv
					where 
						tsv.cwms_ts_id = '".$cwms_ts_id."'  
						and date_time  >= cast(cast(current_date as timestamp) at time zone 'UTC' as date) + interval '".$start_day."' DAY
						and date_time  <= cast(cast(current_date as timestamp) at time zone 'UTC' as date) + interval '".$end_day."' DAY
						and (tsv.unit_id = 'ppm' or tsv.unit_id = 'F' or tsv.unit_id = CASE WHEN cwms_util.split_text(tsv.cwms_ts_id,2,'.') IN ('Stage','Elev','Opening') THEN 'ft' WHEN cwms_util.split_text(tsv.cwms_ts_id,2,'.') IN ('Precip','Depth') THEN 'in' END or tsv.unit_id = 'cfs' or tsv.unit_id = 'umho/cm' or tsv.unit_id = 'volt' or tsv.unit_id = 'ac-ft')
						and tsv.office_id = 'MVS' 
						and tsv.aliased_item is null
					order by date_time desc";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			
			$obj = (object) [
				"cwms_ts_id" => $row['CWMS_TS_ID'],
				"date_time" => $row['DATE_TIME'],
				"location_id" => $row['LOCATION_ID'],
				"parameter_id" => $row['PARAMETER_ID'],
				"version_id" => $row['VERSION_ID'],
				"value" => $row['VALUE'],
				"unit_id" => $row['UNIT_ID'],
				"quality_code" => $row['QUALITY_CODE']
			];
			array_push($data, $obj);
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
function find_nws_forecast2($db, $cwms_ts_id, $nws_day1_date, $nws_day2_date, $nws_day3_date) {
	$stmnt_query = null;
	$data = null;
	try {		
		$sql = "with cte_day1 as (select cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT') as date_time
					,value
					,cwms_ts_id
					,cwms_util.split_text(cwms_ts_id, 1, '.') as location_id
					,unit_id
					,to_char(cwms_util.change_timezone(data_entry_date, 'UTC', 'CST6CDT'), 'mm/dd HH24:MI') as data_entry_date
					,to_char(cwms_util.change_timezone(data_entry_date, 'UTC', 'CST6CDT'), 'mm-dd-yyyy HH24:MI') as data_entry_date_org
				from CWMS_20.AV_TSV_DQU
				where cwms_ts_id = '".$cwms_ts_id."'
					and unit_id = 'ft'
					and date_time = to_date('".$nws_day1_date."' || '12:00' ,'mm-dd-yyyy hh24:mi')
				),
				
				day_2 as (
				select cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT') as date_time
					,value
					,cwms_ts_id
					,cwms_util.split_text(cwms_ts_id, 1, '.') as location_id
					,unit_id
					,to_char(cwms_util.change_timezone(data_entry_date, 'UTC', 'CST6CDT'), 'mm/dd HH24:MI') as data_entry_date
					,to_char(cwms_util.change_timezone(data_entry_date, 'UTC', 'CST6CDT'), 'mm-dd-yyyy HH24:MI') as data_entry_date_org
				from CWMS_20.AV_TSV_DQU
				where cwms_ts_id = '".$cwms_ts_id."'
					and unit_id = 'ft'
					and date_time = to_date('".$nws_day2_date."' || '12:00' ,'mm-dd-yyyy hh24:mi')
				),
				
				day_3 as (
				select cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT') as date_time
					,value
					,cwms_ts_id
					,cwms_util.split_text(cwms_ts_id, 1, '.') as location_id
					,unit_id
					,to_char(cwms_util.change_timezone(data_entry_date, 'UTC', 'CST6CDT'), 'mm/dd HH24:MI') as data_entry_date
					,to_char(cwms_util.change_timezone(data_entry_date, 'UTC', 'CST6CDT'), 'mm-dd-yyyy HH24:MI') as data_entry_date_org
				from CWMS_20.AV_TSV_DQU
				where cwms_ts_id = '".$cwms_ts_id."'
					and unit_id = 'ft'
					and date_time = to_date('".$nws_day3_date."' || '12:00' ,'mm-dd-yyyy hh24:mi')
				)
				
				select day1.date_time as date_time_day1, day1.value as value_day1, day1.cwms_ts_id as cwms_ts_id_day1, day1.location_id as location_id_day1, day1.unit_id as unit_id_day1, day1.data_entry_date as data_entry_date_day1, day1.data_entry_date_org as data_entry_date_org_day1
					,day2.date_time as date_time_day2, day2.value as value_day2, day2.cwms_ts_id as cwms_ts_id_day2, day2.location_id as location_id_day2, day2.unit_id as unit_id_day2, day2.data_entry_date as data_entry_date_day2, day2.data_entry_date_org as data_entry_date_org_day2
					,day3.date_time as date_time_day3, day3.value as value_day3, day3.cwms_ts_id as cwms_ts_id_day3, day3.location_id as location_id_day3, day3.unit_id as unit_id_day3, day3.data_entry_date as data_entry_date_day3, day3.data_entry_date_org as data_entry_date_org_day3
				from cte_day1 day1
					left join day_2 day2
					on day1.location_id = day2.location_id
						left join day_3 day3
						on day1.location_id = day3.location_id
				";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			
			$data = (object) [
				"date_time_day1" => $row['DATE_TIME_DAY1'],
				"data_entry_date_day1" => $row['DATA_ENTRY_DATE_DAY1'],
				"data_entry_date_org_day1" => $row['DATA_ENTRY_DATE_ORG_DAY1'],
				"value_day1" => $row['VALUE_DAY1'],
				"unit_id_day1" => $row['UNIT_ID_DAY1'],
				"cwms_ts_id_day1" => $row['CWMS_TS_ID_DAY1'],
				"location_id_day1" => $row['LOCATION_ID_DAY1'],
				"date_time_day2" => $row['DATE_TIME_DAY2'],
				"data_entry_date_day2" => $row['DATA_ENTRY_DATE_DAY2'],
				"data_entry_date_org_day2" => $row['DATA_ENTRY_DATE_ORG_DAY2'],
				"value_day2" => $row['VALUE_DAY2'],
				"unit_id_day2" => $row['UNIT_ID_DAY2'],
				"cwms_ts_id_day2" => $row['CWMS_TS_ID_DAY2'],
				"location_id_day2" => $row['LOCATION_ID_DAY2'],
				"date_time_day3" => $row['DATE_TIME_DAY3'],
				"data_entry_date_day3" => $row['DATA_ENTRY_DATE_DAY3'],
				"data_entry_date_org_day3" => $row['DATA_ENTRY_DATE_ORG_DAY3'],
				"value_day3" => $row['VALUE_DAY3'],
				"unit_id_day3" => $row['UNIT_ID_DAY3'],
				"cwms_ts_id_day3" => $row['CWMS_TS_ID_DAY3'],
				"location_id_day3" => $row['LOCATION_ID_DAY3']
			];
			
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
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_record_stage2($db, $cwms_ts_id) {
	$stmnt_query = null;
	$data = null;
	
	try {		
		$sql = "select location_id
					,location_level_id
					,level_date
					,constant_level
					,level_unit
				from CWMS_20.AV_LOCATION_LEVEL
				where specified_level_id = 'Record Stage' and location_id = cwms_util.split_text('".$cwms_ts_id."', 1, '.') and unit_system = 'EN'";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$data = (object) [
				"location_id" => $row['LOCATION_ID'],
				"location_level_id" => $row['LOCATION_LEVEL_ID'],
				"level_date" => $row['LEVEL_DATE'],
				"constant_level" => $row['CONSTANT_LEVEL'],
				"level_unit" => $row['LEVEL_UNIT']
			];
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