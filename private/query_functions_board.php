<?php
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_bankfull_by_location_id($db, $location_id) {
	$stmnt_query = null;
	$data = null;

	if ($location_id == "Carlyle Lk-Kaskaskia") {
		$location_id = "Carlyle Lk";
	} else if ($location_id == "Lk Shelbyville-Kaskaskia") {
		$location_id = "Lk Shelbyville";
	} else if ($location_id == 'Wappapello Lk-St Francis') {
		$location_id = "Wappapello Lk";
	} else if ($location_id == "Mark Twain Lk-Salt") {
		$location_id = "Mark Twain Lk";
	} else if ($location_id == "Rend Lk-Big Muddy") {
		$location_id = "Rend Lk";
	} else {

	}
	
	try {		
		$sql = "select case
						when location_id = 'Lk Shelbyville' then 'Lk Shelbyville-Kaskaskia'
						when location_id = 'Wappapello Lk' then 'Wappapello Lk-St Francis'
						when location_id = 'Rend Lk' then 'Rend Lk-Big Muddy'
						when location_id = 'Mark Twain Lk' then 'Mark Twain Lk-Salt'
						when location_id = 'Carlyle Lk' then 'Carlyle Lk-Kaskaskia'
						else 'na'
					end as location_id
					,location_level_id
					,level_date
					,constant_level
					,level_unit
				from CWMS_20.AV_LOCATION_LEVEL
				where specified_level_id = 'Bankfull' 
					and location_id = '".$location_id."' 
					and level_unit = 'cfs'
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
function get_lake_crest_forecast_by_location_id($db, $location_id) {
	$stmnt_query = null;
	$data = null;
	
	try {		
		$sql = "with cte_crest_data as (
					select 
						case
						when lake = 'SHELBYVILLE' then 'Lk Shelbyville-Kaskaskia'
						when lake = 'WAPPAPELLO' then 'Wappapello Lk-St Francis'
						when lake = 'REND' then 'Rend Lk-Big Muddy'
						when lake = 'MT' then 'Mark Twain Lk-Salt'
						when lake = 'CARLYLE' then 'Carlyle Lk-Kaskaskia'
							else 'na'
						end as project_id,
						crest, 
						crst_dt, 
						data_entry_dt, 
						opt
					from wm_mvs_lake.crst_fcst
					where (cwms_util.change_timezone(data_entry_dt, 'UTC', 'CST6CDT')) = to_date(to_char(current_date, 'mm-dd-yyyy') || '00:00' ,'mm-dd-yyyy hh24:mi') - interval '0' day
					order by project_id
				)
				select project_id
					,crest
					,crst_dt
					,data_entry_dt
					,opt
				from cte_crest_data
				where project_id = '".$location_id."'";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$data = (object) [
				"project_id" => $row['PROJECT_ID'],
				"crest" => $row['CREST'],
				"crst_dt" => $row['CRST_DT'],
				"data_entry_dt" => $row['DATA_ENTRY_DT'],
				"opt" => $row['OPT']
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
function get_crest_data_by_tsid($db, $cwms_ts_id) {
	$stmnt_query = null;
	$data = null;
	try {		
		$sql = "with cte_crest as (
					select cwms_ts_id
						,cwms_util.split_text(cwms_ts_id, 1, '.') as location_id
						,(cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT')) as date_time
						,value
						,unit_id
						,quality_code
						,data_entry_date
					from cwms_v_tsv_dqu_30d 
					where cwms_ts_id  = '".$cwms_ts_id."'
					and unit_id = 'ft'
					order by data_entry_date desc
					fetch first 1 rows only
				)
				select cwms_ts_id
					,location_id
					,date_time
					,value
					,unit_id
					,quality_code
					,data_entry_date
				from cte_crest
				where date_time >= to_date(to_char(sysdate - 6/24, 'mm-dd-yyyy hh24:mi') ,'mm-dd-yyyy hh24:mi')";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			
			$data = (object) [
				"location_id" => $row['LOCATION_ID'],
				"cwms_ts_id" => $row['CWMS_TS_ID'],
				"date_time" => $row['DATE_TIME'],
				"value" => $row['VALUE'],
				"unit_id" => $row['UNIT_ID'],
				"quality_code" => $row['QUALITY_CODE'],
				"data_entry_date" => $row['DATA_ENTRY_DATE']
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
?>
