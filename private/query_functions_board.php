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
function get_generation($db) {
	$stmnt_query = null;
	$data = null;
	
	try {		
		$sql = "with cte_ts as (
			select date_time
				,value
				,quality_code
				,lag(value, 1, 0) over (order by date_time) as prev_value
				,(value - (lag(value, 1, 0) over (order by date_time))) as delta
			from table(rdl.timeseries.getreportdatabytype ('TIME_SERIES', 'Mark Twain Lk TW-Salt.Stage.Inst.15Minutes.0.29', 
			cast(cast(current_date as timestamp) at time zone 'UTC' as date) - interval '30' hour,
			cast(cast(current_date as timestamp) at time zone 'UTC' as date), 
			null, 
			null,--TOD time 
			null, 
			null, 
			'ft',--unit 
			'MVS',--office_id 
			'CST6CDT')--timezone
			)
		)
		select date_time
			,value
			,quality_code
			,prev_value
			,delta
		from cte_ts
		where delta < 10
		and delta > 0.3
		order by delta desc
		fetch first 1 rows only";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$data = (object) [
				"date_time" => $row['DATE_TIME'],
				"value" => $row['VALUE'],
				"quality_code" => $row['QUALITY_CODE'],
				"prev_value" => $row['PREV_VALUE'],
				"delta" => $row['DELTA']
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
function get_generation2($db) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "with cte_gen as (
					select generation, date_time, value, quality_code, prev_value, delta
					from (
						select generation, date_time, value, quality_code, prev_value, delta
						from (
							select 'generation' as generation
								,date_time
								,value
								,quality_code
								,lag(value, 1, 0) over (order by date_time) as prev_value
								,(value - lag(value, 1, 0) over (order by date_time)) as delta
							from table(rdl.timeseries.getreportdatabytype ('TIME_SERIES', 'Mark Twain Lk TW-Salt.Stage.Inst.15Minutes.0.29', 
								cast(cast(current_date as timestamp) at time zone 'UTC' as date) - interval '7' hour,
								cast(cast(current_date as timestamp) at time zone 'UTC' as date), 
								null, 
								null,--TOD time 
								null, 
								null, 
								'ft',--unit 
								'MVS',--office_id 
								'CST6CDT')--timezone
							)
						)
						where delta < 10 and delta > 0.3
						order by delta desc
					)
					where rownum <= 1
					
					union all
					
					select generation, date_time, value, quality_code, prev_value, delta
					from (
						select generation, date_time, value, quality_code, prev_value, delta
						from (
							select 'generation' as generation
								,date_time
								,value
								,quality_code
								,lag(value, 1, 0) over (order by date_time) as prev_value
								,(value - lag(value, 1, 0) over (order by date_time)) as delta
							from table(rdl.timeseries.getreportdatabytype ('TIME_SERIES', 'Mark Twain Lk TW-Salt.Stage.Inst.15Minutes.0.29', 
								cast(cast(current_date as timestamp) at time zone 'UTC' as date) - interval '24' hour,
								cast(cast(current_date as timestamp) at time zone 'UTC' as date) - interval '7' hour, 
								null, 
								null,--TOD time 
								null, 
								null, 
								'ft',--unit 
								'MVS',--office_id 
								'CST6CDT')--timezone
							)
						)
						where delta < 10 and delta > 0.3
						order by delta desc
					)
					where rownum <= 1
				),
				cte_gen_all as (
					select generation, date_time, value, quality_code, prev_value, delta 
					from cte_gen
					order by date_time asc
				),
				cte_rereg as (
					select 'generation' as generation
						,cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT') as date_time_rereg
						,value as value_rereg
						,cwms_ts_id as cwms_ts_id_rereg
						,cwms_util.split_text(cwms_ts_id, 1, '.') as location_id_rereg
						,unit_id as unit_id_rereg
					from CWMS_20.AV_TSV_DQU_24H
					where cwms_ts_id = 'ReReg Pool-Salt.Stage.Inst.15Minutes.0.29'
						and (unit_id = 'ft' or unit_id = 'cfs' or unit_id = 'F' or unit_id = 'mg/l' or unit_id = 'umho/cm')
						and date_time  >= cast(cast(current_date as timestamp) at time zone 'UTC' as date) - interval '24' HOUR
						and date_time  <= cast(cast(current_date as timestamp) at time zone 'UTC' as date) 
					order by date_time desc
					fetch first 1 rows only
				)
				select cte_gen_all.generation, cte_gen_all.date_time, cte_gen_all.value, cte_gen_all.quality_code, cte_gen_all.prev_value, cte_gen_all.delta
					,cte_rereg.date_time_rereg, cte_rereg.value_rereg, cte_rereg.cwms_ts_id_rereg, cte_rereg.location_id_rereg, cte_rereg.unit_id_rereg
				from cte_rereg
				left join cte_gen_all on
				cte_gen_all.generation = cte_rereg.generation
				order by cte_gen_all.date_time desc";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"generation" => $row['GENERATION'],
				"date_time" => $row['DATE_TIME'],
				"value" => $row['VALUE'],
				"quality_code" => $row['QUALITY_CODE'],
				"prev_value" => $row['PREV_VALUE'],
				"delta" => $row['DELTA'],
				"date_time_rereg" => $row['DATE_TIME_REREG'],
				"value_rereg" => $row['VALUE_REREG'],
				"cwms_ts_id_rereg" => $row['CWMS_TS_ID_REREG'],
				"location_id_rereg" => $row['LOCATION_ID_REREG'],
				"unit_id_rereg" => $row['UNIT_ID_REREG']
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
function get_inflow_by_location_id($db, $location_id) {
	$stmnt_query = null;
	$data = null;
	
	try {		
		$sql = "select cwms_util.split_text(cwms_ts_id, 1, '.') as location_id
					,value
					,cwms_ts_id
					,cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT') as date_time
					,unit_id
				from cwms_v_tsv_dqu_30d 
				where cwms_ts_id like '%Flow-In.Ave.~1Day.1Day.lakerep-rev' 
				and cwms_ts_id like '".$location_id."' || '%'
				and unit_id = 'cfs'
				and (cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT')) = to_date(to_char((cwms_util.change_timezone(sysdate, 'UTC', 'CST6CDT')), 'mm-dd-yyyy') || '00:00' ,'mm-dd-yyyy hh24:mi')  - interval '1' day
				order by data_entry_date desc
				fetch first 1 rows only";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$data = (object) [
				"location_id" => $row['LOCATION_ID'],
				"value" => $row['VALUE'],
				"cwms_ts_id" => $row['CWMS_TS_ID'],
				"date_time" => $row['DATE_TIME'],
				"unit_id" => $row['UNIT_ID']
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
function get_lake_storage_by_location_id($db, $cwms_ts_id) {
	$stmnt_query = null;
	$data = null;
	
	try {		
		$sql = "with cte_storage as (
					select date_time, value, unit_id, cwms_ts_id, cwms_util.split_text(cwms_ts_id, 1, '.') as location_id
					from CWMS_20.AV_TSV_DQU_30D
					where cwms_ts_id = '".$cwms_ts_id."' || '.Stor.Inst.30Minutes.0.RatingCOE'
					and date_time = to_date(to_char((cwms_util.change_timezone(sysdate, 'UTC', 'CST6CDT')), 'mm-dd-yyyy') || '00:00' ,'mm-dd-yyyy hh24:mi')
					and unit_id = 'ac-ft'
				),
				cte_top_bottom_data as (
					select location_id
						,specified_level_id
						,location_level_id
						,constant_level
						,level_unit 
					from CWMS_20.AV_LOCATION_LEVEL 
					where location_id in ('Carlyle Lk', 'Mark Twain Lk', 'Rend Lk', 'Lk Shelbyville', 'Wappapello Lk')
					and level_unit in ('ac-ft')
					and unit_system = 'EN'
					and specified_level_id in ('Top of Conservation','Bottom of Conservation', 'Top of Flood', 'Bottom of Flood')
				),
				cte_new_top_bottom_data as (
					select 
						case
							when location_id = 'Lk Shelbyville' then 'Lk Shelbyville-Kaskaskia'
							when location_id = 'Wappapello Lk' then 'Wappapello Lk-St Francis'
							when location_id = 'Rend Lk' then 'Rend Lk-Big Muddy'
							when location_id = 'Mark Twain Lk' then 'Mark Twain Lk-Salt'
							when location_id = 'Carlyle Lk' then 'Carlyle Lk-Kaskaskia'
							else 'na'
						end as location_id
						,specified_level_id
						,location_level_id
						,constant_level
						,level_unit 
					from cte_top_bottom_data
				),
				top_bottom_data as (
					select toc.constant_level as TOC, toc.location_id, toc.level_unit, toc.specified_level_id, toc.location_level_id 
						,toc.location_level_id as toc_location_level_id
						,boc.constant_level  as BOC
						,boc.location_level_id as boc_location_level_id
						,tof.constant_level as TOF
						,tof.location_level_id as tof_location_level_id
						,bof.constant_level as BOF
						,bof.location_level_id as bof_location_level_id
					from cte_new_top_bottom_data toc
						left outer join (
						select location_id ,specified_level_id ,constant_level ,level_unit, location_level_id 
						from cte_new_top_bottom_data 
						where specified_level_id = 'Bottom of Conservation' ) boc
						on toc.location_id = boc.location_id 
							left outer join (
							select location_id ,specified_level_id ,constant_level ,level_unit , location_level_id 
							from cte_new_top_bottom_data 
							where specified_level_id = 'Top of Flood' ) tof
							on toc.location_id = tof.location_id 
								left outer join (
								select location_id ,specified_level_id ,constant_level ,level_unit , location_level_id 
								from cte_new_top_bottom_data 
								where specified_level_id = 'Bottom of Flood' ) bof
								on toc.location_id = bof.location_id 
					where toc.location_id = '".$cwms_ts_id."' and toc.specified_level_id = 'Top of Conservation'
				)
				select cte_storage.date_time
					,cte_storage.value
					,cte_storage.unit_id
					,cte_storage.cwms_ts_id
					,cte_storage.location_id
					,top_bottom_data.toc 
					,top_bottom_data.toc_location_level_id 
					,top_bottom_data.boc  
					,top_bottom_data.boc_location_level_id 
					,top_bottom_data.tof  
					,top_bottom_data.tof_location_level_id 
					,top_bottom_data.bof 
					,top_bottom_data.bof_location_level_id 
				from cte_storage
					left join top_bottom_data top_bottom_data on
					cte_storage.location_id = top_bottom_data.location_id";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$data = (object) [
				"date_time" => $row['DATE_TIME'],
				"value" => $row['VALUE'],
				"unit_id" => $row['UNIT_ID'],
				"cwms_ts_id" => $row['CWMS_TS_ID'],
				"location_id" => $row['LOCATION_ID'],
				"toc" => $row['TOC'],
				"toc_location_level_id" => $row['TOC_LOCATION_LEVEL_ID'],
				"boc" => $row['BOC'],
				"boc_location_level_id" => $row['BOC_LOCATION_LEVEL_ID'],
				"tof" => $row['TOF'],
				"tof_location_level_id" => $row['TOF_LOCATION_LEVEL_ID'],
				"bof" => $row['BOF'],
				"bof_location_level_id" => $row['BOF_LOCATION_LEVEL_ID']
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
function get_lower_upper_flow_limit_by_tsid($db, $cwms_ts_id) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "select location_level_id
					,level_unit
					,constant_level
					,specified_level_id
					,cwms_util.split_text('".$cwms_ts_id."', 1, '.') as location_id
				from cwms_20.av_location_level
				where location_id = cwms_util.split_text('".$cwms_ts_id."', 1, '.')
				and specified_level_id like 'Flow%'
				and specified_level_id like '%Limit'
				and unit_system = 'EN'";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"location_level_id" => $row['LOCATION_LEVEL_ID'],
				"level_unit" => $row['LEVEL_UNIT'],
				"constant_level" => $row['CONSTANT_LEVEL'],
				"specified_level_id" => $row['SPECIFIED_LEVEL_ID'],
				"location_id" => $row['LOCATION_ID']		
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
