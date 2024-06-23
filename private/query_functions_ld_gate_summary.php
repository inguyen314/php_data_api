<?php
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function find_ld_gate($db, $pool, $tw, $hinge, $taint, $roll) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "with cte_pool as (
				select cwms_ts_id
					, cwms_util.change_timezone(tsv.date_time, 'UTC', 'CST6CDT') as date_time
					, cwms_util.split_text('".$pool."', 1, '.') as location_id
					, cwms_util.split_text('".$pool."', 2, '.') as parameter_id
					, value
					, unit_id
					, quality_code
				from cwms_v_tsv_dqu tsv
				where 
					tsv.cwms_ts_id = '".$pool."'  
					and date_time >= cast(cast(current_date as timestamp) at time zone 'UTC' as date) - interval '24' hour
					and date_time <= cast(cast(current_date as timestamp) at time zone 'UTC' as date) + interval '0' day
					and (tsv.unit_id = 'ppm' or tsv.unit_id = 'F' or tsv.unit_id = 
						case 
							when cwms_util.split_text(tsv.cwms_ts_id, 2, '.') in ('Stage', 'Elev','Opening') then 'ft' 
							when cwms_util.split_text(tsv.cwms_ts_id, 2, '.') in ('Precip', 'Depth') then 'in' 
							when cwms_util.split_text(tsv.cwms_ts_id, 2, '.') in ('Conc-DO') then 'ppm'
						end or tsv.unit_id in ('cfs', 'umho/cm', 'volt'))
					and tsv.office_id = 'MVS' 
					and tsv.aliased_item is null
					-- Exclude rows where the minutes part of date_time is not 0 (i.e., 30-minute intervals)
					and to_number(to_char(tsv.date_time, 'MI')) = 0
				),
				tw as (
				select cwms_ts_id
					, cwms_util.change_timezone(tsv.date_time, 'UTC', 'CST6CDT') as date_time
					, cwms_util.split_text('".$tw."', 1, '.') as location_id
					, cwms_util.split_text('".$tw."', 2, '.') as parameter_id
					, value
					, unit_id
					, quality_code
				from cwms_v_tsv_dqu tsv
				where 
					tsv.cwms_ts_id = '".$tw."'  
					and date_time >= cast(cast(current_date as timestamp) at time zone 'UTC' as date) - interval '24' hour
					and date_time <= cast(cast(current_date as timestamp) at time zone 'UTC' as date) + interval '0' day
					and (tsv.unit_id = 'ppm' or tsv.unit_id = 'F' or tsv.unit_id = 
						case 
							when cwms_util.split_text(tsv.cwms_ts_id, 2, '.') in ('Stage', 'Elev','Opening') then 'ft' 
							when cwms_util.split_text(tsv.cwms_ts_id, 2, '.') in ('Precip', 'Depth') then 'in' 
							when cwms_util.split_text(tsv.cwms_ts_id, 2, '.') in ('Conc-DO') then 'ppm'
						end or tsv.unit_id in ('cfs', 'umho/cm', 'volt'))
					and tsv.office_id = 'MVS' 
					and tsv.aliased_item is null
					-- Exclude rows where the minutes part of date_time is not 0 (i.e., 30-minute intervals)
					and to_number(to_char(tsv.date_time, 'MI')) = 0
				),
				hinge as (
				select cwms_ts_id
					, cwms_util.change_timezone(tsv.date_time, 'UTC', 'CST6CDT') as date_time
					, cwms_util.split_text('".$hinge."', 1, '.') as location_id
					, cwms_util.split_text('".$hinge."', 2, '.') as parameter_id
					, value
					, unit_id
					, quality_code
				from cwms_v_tsv_dqu tsv
				where 
					tsv.cwms_ts_id = '".$hinge."'  
					and date_time >= cast(cast(current_date as timestamp) at time zone 'UTC' as date) - interval '24' hour
					and date_time <= cast(cast(current_date as timestamp) at time zone 'UTC' as date) + interval '0' day
					and (tsv.unit_id = 'ppm' or tsv.unit_id = 'F' or tsv.unit_id = 
						case 
							when cwms_util.split_text(tsv.cwms_ts_id, 2, '.') in ('Stage', 'Elev','Opening') then 'ft' 
							when cwms_util.split_text(tsv.cwms_ts_id, 2, '.') in ('Precip', 'Depth') then 'in' 
							when cwms_util.split_text(tsv.cwms_ts_id, 2, '.') in ('Conc-DO') then 'ppm'
						end or tsv.unit_id in ('cfs', 'umho/cm', 'volt'))
					and tsv.office_id = 'MVS' 
					and tsv.aliased_item is null
					-- Exclude rows where the minutes part of date_time is not 0 (i.e., 30-minute intervals)
					and to_number(to_char(tsv.date_time, 'MI')) = 0
				),
				taint as (
				select cwms_ts_id
					, cwms_util.change_timezone(tsv.date_time, 'UTC', 'CST6CDT') as date_time
					, cwms_util.split_text('".$taint."', 1, '.') as location_id
					, cwms_util.split_text('".$taint."', 2, '.') as parameter_id
					, value
					, unit_id
					, quality_code
				from cwms_v_tsv_dqu tsv
				where 
					tsv.cwms_ts_id = '".$taint."'  
					and date_time >= cast(cast(current_date as timestamp) at time zone 'UTC' as date) - interval '24' hour
					and date_time <= cast(cast(current_date as timestamp) at time zone 'UTC' as date) + interval '0' day
					and (tsv.unit_id = 'ppm' or tsv.unit_id = 'F' or tsv.unit_id = 
						case 
							when cwms_util.split_text(tsv.cwms_ts_id, 2, '.') in ('Stage', 'Elev','Opening') then 'ft' 
							when cwms_util.split_text(tsv.cwms_ts_id, 2, '.') in ('Precip', 'Depth') then 'in' 
							when cwms_util.split_text(tsv.cwms_ts_id, 2, '.') in ('Conc-DO') then 'ppm'
						end or tsv.unit_id in ('cfs', 'umho/cm', 'volt'))
					and tsv.office_id = 'MVS' 
					and tsv.aliased_item is null
					-- Exclude rows where the minutes part of date_time is not 0 (i.e., 30-minute intervals)
					and to_number(to_char(tsv.date_time, 'MI')) = 0
				),
				roll as (
				select cwms_ts_id
					, cwms_util.change_timezone(tsv.date_time, 'UTC', 'CST6CDT') as date_time
					, cwms_util.split_text('".$roll."', 1, '.') as location_id
					, cwms_util.split_text('".$roll."', 2, '.') as parameter_id
					, value
					, unit_id
					, quality_code
				from cwms_v_tsv_dqu tsv
				where 
					tsv.cwms_ts_id = '".$roll."'  
					and date_time >= cast(cast(current_date as timestamp) at time zone 'UTC' as date) - interval '24' hour
					and date_time <= cast(cast(current_date as timestamp) at time zone 'UTC' as date) + interval '0' day
					and (tsv.unit_id = 'ppm' or tsv.unit_id = 'F' or tsv.unit_id = 
						case 
							when cwms_util.split_text(tsv.cwms_ts_id, 2, '.') in ('Stage', 'Elev','Opening') then 'ft' 
							when cwms_util.split_text(tsv.cwms_ts_id, 2, '.') in ('Precip', 'Depth') then 'in' 
							when cwms_util.split_text(tsv.cwms_ts_id, 2, '.') in ('Conc-DO') then 'ppm'
						end or tsv.unit_id in ('cfs', 'umho/cm', 'volt'))
					and tsv.office_id = 'MVS' 
					and tsv.aliased_item is null
					-- Exclude rows where the minutes part of date_time is not 0 (i.e., 30-minute intervals)
					and to_number(to_char(tsv.date_time, 'MI')) = 0
				)
				select  pool.date_time, pool.cwms_ts_id as pool_cwms_ts_id, pool.value as pool, pool.location_id as pool_location_id,
						tw.cwms_ts_id as tw_cwms_ts_id, tw.value as tw, tw.location_id as tw_location_id,
						hinge.cwms_ts_id as hinge_cwms_ts_id, hinge.value as hinge, hinge.location_id as hinge_location_id,
						taint.cwms_ts_id as taint_cwms_ts_id, taint.value as taint, taint.location_id as taint_location_id,
						roll.cwms_ts_id as roll_cwms_ts_id, roll.value as roll, roll.location_id as roll_location_id
						--pool.cwms_ts_id, pool.date_time, pool.location_id, pool.parameter_id, pool.value, pool.unit_id, pool.quality_code,
						--tw.cwms_ts_id, tw.date_time, tw.location_id, tw.parameter_id, tw.value, tw.unit_id, tw.quality_code,
						--hinge.cwms_ts_id, hinge.date_time, hinge.location_id, hinge.parameter_id, hinge.value, hinge.unit_id, hinge.quality_code,
						--taint.cwms_ts_id, taint.date_time, taint.location_id, taint.parameter_id, taint.value, taint.unit_id, taint.quality_code,
						--roll.cwms_ts_id, roll.date_time, roll.location_id, roll.parameter_id, roll.value, roll.unit_id, roll.quality_code
				from  cte_pool pool
					left join tw tw on
					pool.date_time=tw.date_time
						left join hinge hinge on
						pool.date_time=hinge.date_time
							left join taint taint on
							pool.date_time=taint.date_time
								left join roll roll on
								pool.date_time=roll.date_time
				order by pool.date_time desc";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {	
			$obj = (object) [
				"date_time" => $row['DATE_TIME'],
				"pool_cwms_ts_id" => $row['POOL_CWMS_TS_ID'],
				"pool" => $row['POOL'],
				"pool_location_id" => $row['POOL_LOCATION_ID'],
				"tw_cwms_ts_id" => $row['TW_CWMS_TS_ID'],
				"tw" => $row['TW'],
				"tw_location_id" => $row['TW_LOCATION_ID'],
				"hinge_cwms_ts_id" => $row['HINGE_CWMS_TS_ID'],
				"hinge" => $row['HINGE'],
				"hinge_location_id" => $row['HINGE_LOCATION_ID'],
				"taint_cwms_ts_id" => $row['TAINT_CWMS_TS_ID'],
				"taint" => $row['TAINT'],
				"taint_location_id" => $row['TAINT_LOCATION_ID'],
				"roll_cwms_ts_id" => $row['ROLL_CWMS_TS_ID'],
				"roll" => $row['ROLL'],
				"roll_location_id" => $row['ROLL_LOCATION_ID'],
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
?>
