<?php
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_bankfull_by_location_id($db, $location_id)
{
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
					and location_id = '" . $location_id . "' 
					and level_unit = 'cfs'
					and unit_system = 'EN'";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {
			$data = (object) [
				"location_id" => $row['LOCATION_ID'],
				"location_level_id" => $row['LOCATION_LEVEL_ID'],
				"level_date" => $row['LEVEL_DATE'],
				"constant_level" => $row['CONSTANT_LEVEL'],
				"level_unit" => $row['LEVEL_UNIT']
			];
		}
	} catch (Exception $e) {
		$e = oci_error($db);
		trigger_error(htmlentities($e['message']), E_USER_ERROR);
		return null;
	} finally {
		oci_free_statement($stmnt_query);
	}
	return $data;
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_lake_crest_forecast_by_location_id($db, $location_id)
{
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
				where project_id = '" . $location_id . "'";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {
			$data = (object) [
				"project_id" => $row['PROJECT_ID'],
				"crest" => $row['CREST'],
				"crst_dt" => $row['CRST_DT'],
				"data_entry_dt" => $row['DATA_ENTRY_DT'],
				"opt" => $row['OPT']
			];
		}
	} catch (Exception $e) {
		$e = oci_error($db);
		trigger_error(htmlentities($e['message']), E_USER_ERROR);
		return null;
	} finally {
		oci_free_statement($stmnt_query);
	}
	return $data;
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_crest_data_by_tsid($db, $cwms_ts_id)
{
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
					where cwms_ts_id  = '" . $cwms_ts_id . "'
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

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {

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
	} catch (Exception $e) {
		$e = oci_error($db);
		trigger_error(htmlentities($e['message']), E_USER_ERROR);

		return null;
	} finally {
		oci_free_statement($stmnt_query);
	}
	return $data;
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_generation($db)
{
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

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {
			$data = (object) [
				"date_time" => $row['DATE_TIME'],
				"value" => $row['VALUE'],
				"quality_code" => $row['QUALITY_CODE'],
				"prev_value" => $row['PREV_VALUE'],
				"delta" => $row['DELTA']
			];
		}
	} catch (Exception $e) {
		$e = oci_error($db);
		trigger_error(htmlentities($e['message']), E_USER_ERROR);
		return null;
	} finally {
		oci_free_statement($stmnt_query);
	}
	return $data;
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_generation2($db)
{
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

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {
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
	} catch (Exception $e) {
		$e = oci_error($db);
		trigger_error(htmlentities($e['message']), E_USER_ERROR);
		return null;
	} finally {
		oci_free_statement($stmnt_query);
	}
	return $data;
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_inflow_by_location_id($db, $location_id)
{
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
				and cwms_ts_id like '" . $location_id . "' || '%'
				and unit_id = 'cfs'
				and (cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT')) = to_date(to_char((cwms_util.change_timezone(sysdate, 'UTC', 'CST6CDT')), 'mm-dd-yyyy') || '00:00' ,'mm-dd-yyyy hh24:mi')  - interval '1' day
				order by data_entry_date desc
				fetch first 1 rows only";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {
			$data = (object) [
				"location_id" => $row['LOCATION_ID'],
				"value" => $row['VALUE'],
				"cwms_ts_id" => $row['CWMS_TS_ID'],
				"date_time" => $row['DATE_TIME'],
				"unit_id" => $row['UNIT_ID']
			];
		}
	} catch (Exception $e) {
		$e = oci_error($db);
		trigger_error(htmlentities($e['message']), E_USER_ERROR);
		return null;
	} finally {
		oci_free_statement($stmnt_query);
	}
	return $data;
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_lake_storage_by_location_id($db, $cwms_ts_id)
{
	$stmnt_query = null;
	$data = null;

	try {
		$sql = "with cte_storage as (
					select date_time, value, unit_id, cwms_ts_id, cwms_util.split_text(cwms_ts_id, 1, '.') as location_id
					from CWMS_20.AV_TSV_DQU_30D
					where cwms_ts_id = '" . $cwms_ts_id . "' || '.Stor.Inst.30Minutes.0.RatingCOE'
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
					where toc.location_id = '" . $cwms_ts_id . "' and toc.specified_level_id = 'Top of Conservation'
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

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {
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
	} catch (Exception $e) {
		$e = oci_error($db);
		trigger_error(htmlentities($e['message']), E_USER_ERROR);
		return null;
	} finally {
		oci_free_statement($stmnt_query);
	}
	return $data;
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_lower_upper_flow_limit_by_tsid($db, $cwms_ts_id)
{
	$stmnt_query = null;
	$data = [];

	try {
		$sql = "select location_level_id
					,level_unit
					,constant_level
					,specified_level_id
					,cwms_util.split_text('" . $cwms_ts_id . "', 1, '.') as location_id
				from cwms_20.av_location_level
				where location_id = cwms_util.split_text('" . $cwms_ts_id . "', 1, '.')
				and specified_level_id like 'Flow%'
				and specified_level_id like '%Limit'
				and unit_system = 'EN'";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"location_level_id" => $row['LOCATION_LEVEL_ID'],
				"level_unit" => $row['LEVEL_UNIT'],
				"constant_level" => $row['CONSTANT_LEVEL'],
				"specified_level_id" => $row['SPECIFIED_LEVEL_ID'],
				"location_id" => $row['LOCATION_ID']
			];
			array_push($data, $obj);
		}
	} catch (Exception $e) {
		$e = oci_error($db);
		trigger_error(htmlentities($e['message']), E_USER_ERROR);

		return null;
	} finally {
		oci_free_statement($stmnt_query);
	}
	return $data;
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_lwrp_by_tsid($db, $cwms_ts_id)
{
	$stmnt_query = null;
	$data = null;

	try {
		$sql = "select location_id
					,location_level_id
					,level_date
					,constant_level
					,level_unit
				from CWMS_20.AV_LOCATION_LEVEL
				where specified_level_id = 'LWRP' and location_id = cwms_util.split_text('" . $cwms_ts_id . "', 1, '.') and unit_system = 'EN'";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {
			$data = (object) [
				"location_id" => $row['LOCATION_ID'],
				"location_level_id" => $row['LOCATION_LEVEL_ID'],
				"level_date" => $row['LEVEL_DATE'],
				"constant_level" => $row['CONSTANT_LEVEL'],
				"level_unit" => $row['LEVEL_UNIT']
			];
		}
	} catch (Exception $e) {
		$e = oci_error($db);
		trigger_error(htmlentities($e['message']), E_USER_ERROR);
		return null;
	} finally {
		oci_free_statement($stmnt_query);
	}
	return $data;
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_note_by_location_id($db, $location_id)
{
	$stmnt_query = null;
	$data = null;

	try {
		$sql = "with cte_note as (
					select
					case
						when lake = 'SHELBYVILLE' then 'Lk Shelbyville-Kaskaskia'
						when lake = 'WAPPAPELLO' then 'Wappapello Lk-St Francis'
						when lake = 'REND' then 'Rend Lk-Big Muddy'
						when lake = 'MT' then 'Mark Twain Lk-Salt'
						when lake = 'CARLYLE' then 'Carlyle Lk-Kaskaskia'
						else 'na'
					end as project_id
					,cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT') as date_time
					,note
					from wm_mvs_lake.lake_note
					order by date_time desc
					fetch first 1 rows only
				)
				select project_id
					 ,date_time
					 ,note
				from cte_note
				where project_id = '" . $location_id . "'";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {
			$data = (object) [
				"project_id" => $row['PROJECT_ID'],
				"date_time" => $row['DATE_TIME'],
				"note" => $row['NOTE']
			];
		}
	} catch (Exception $e) {
		$e = oci_error($db);
		trigger_error(htmlentities($e['message']), E_USER_ERROR);
		return null;
	} finally {
		oci_free_statement($stmnt_query);
	}
	return $data;
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_nws_forecast_by_day($db, $cwms_ts_id, $nws_day1_date)
{
	$stmnt_query = null;
	$data = null;
	try {
		$sql = "select cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT') as date_time
					,value
					,cwms_ts_id
					,cwms_util.split_text(cwms_ts_id, 1, '.') as location_id
					,unit_id
					,to_char(cwms_util.change_timezone(data_entry_date, 'UTC', 'CST6CDT'), 'mm-dd-yyyy HH24:MI') as data_entry_date_org
					,to_char(cwms_util.change_timezone(data_entry_date, 'UTC', 'CST6CDT'), 'mm/dd HH24:MI') as data_entry_date
				from CWMS_20.AV_TSV_DQU_30D
				where cwms_ts_id = '" . $cwms_ts_id . "'
					and unit_id = 'ft'
					and date_time = to_date('" . $nws_day1_date . "' || '12:00' ,'mm-dd-yyyy hh24:mi')
				order by date_time desc
				fetch first 1 rows only";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {

			$data = (object) [
				"date_time" => $row['DATE_TIME'],
				"data_entry_date" => $row['DATA_ENTRY_DATE'],
				"data_entry_date_org" => $row['DATA_ENTRY_DATE_ORG'],
				"value" => $row['VALUE'],
				"unit_id" => $row['UNIT_ID'],
				"cwms_ts_id" => $row['CWMS_TS_ID'],
				"location_id" => $row['LOCATION_ID']
			];
		}
	} catch (Exception $e) {
		$e = oci_error($db);
		trigger_error(htmlentities($e['message']), E_USER_ERROR);

		return null;
	} finally {
		oci_free_statement($stmnt_query);
	}
	return $data;
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_outflow2_by_location_id($db, $location_id)
{
	$stmnt_query = null;
	$data = null;

	try {
		$sql = "-- EVENING
				with cte_rend_evening as (
					select 'Rend Lk-Big Muddy' as project_id 
						,(cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT')) as date_time
						,round(q_tom, -1) as evening_outflow_rend
					from wm_mvs_lake.rend_flow
					order by date_time desc
					fetch first row only
				),
				cte_wappapello_evening as (
					select 'Wappapello Lk-St Francis' as project_id
						,(cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT')) as date_time
						,q as evening_outflow_wappapello
					from wm_mvs_lake.wappapello_gate
					order by date_time desc
					fetch first row only
				),
				cte_shelbyville_evening as (
					select 'Lk Shelbyville-Kaskaskia' as project_id 
						,(cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT')) as date_time
						,q as evening_outflow_shelbyville
					from wm_mvs_lake.shelbyville_gate
					order by date_time desc
					fetch first row only
				),
				cte_carlyle_evening as (
					select 'Carlyle Lk-Kaskaskia' as project_id 
						,(cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT')) as date_time
						,q as evening_outflow_carlyle
					from wm_mvs_lake.carlyle_gate
					order by date_time desc
					fetch first row only
				),
				cte_mark_twain_evening as (
				select 
					case
						when lake = 'MT' then 'Mark Twain Lk-Salt'
					end as project_id
					,(cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT')) as date_time
					,outflow as evening_outflow_mark_twain
				from wm_mvs_lake.qlev_fcst
				where (cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT')) = to_date(to_char((cwms_util.change_timezone(sysdate, 'UTC', 'CST6CDT')), 'mm-dd-yyyy') || '00:00' ,'mm-dd-yyyy hh24:mi') - interval '0' day 
				and (cwms_util.change_timezone(fcst_date, 'UTC', 'CST6CDT')) = to_date(to_char((cwms_util.change_timezone(sysdate, 'UTC', 'CST6CDT')), 'mm-dd-yyyy') || '00:00' ,'mm-dd-yyyy hh24:mi') - interval '0' day
				and lake = 'MT'
				order by project_id asc
				),
				cte_all_evening_outflow as (
					select project_id, date_time, evening_outflow_rend as evening from cte_rend_evening
					union all
					select project_id, date_time, evening_outflow_wappapello as evening from cte_wappapello_evening
					union all
					select project_id, date_time, evening_outflow_shelbyville as evening from cte_shelbyville_evening
					union all    
					select project_id, date_time, evening_outflow_carlyle as evening from cte_carlyle_evening
					union all
					select project_id, date_time, evening_outflow_mark_twain as evening from cte_mark_twain_evening
				),
				-- MIDNIGHT
				cte_rend as (
				select 'Rend Lk-Big Muddy' as project_id 
					,(cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT')) as date_time
					,round(q_tom, -1) as midnight_outflow_rend
				from wm_mvs_lake.rend_flow
				where cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT') = to_date(to_char((cwms_util.change_timezone(sysdate, 'UTC', 'CST6CDT')), 'mm-dd-yyyy') || '00:00' ,'mm-dd-yyyy hh24:mi') - interval '1' day
				),
				cte_wappapello as (
				select 'Wappapello Lk-St Francis' as project_id
					,(cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT')) as date_time
					,q as midnight_outflow_wappapello
				from wm_mvs_lake.wappapello_gate
				where cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT') = to_date(to_char((cwms_util.change_timezone(sysdate, 'UTC', 'CST6CDT')), 'mm-dd-yyyy') || '00:00' ,'mm-dd-yyyy hh24:mi') - interval '0' day
				),
				cte_shelbyville as (
				select 'Lk Shelbyville-Kaskaskia' as project_id 
					,(cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT')) as date_time
					,q as midnight_outflow_shelbyville
				from wm_mvs_lake.shelbyville_gate
				where cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT') = to_date(to_char((cwms_util.change_timezone(sysdate, 'UTC', 'CST6CDT')), 'mm-dd-yyyy') || '00:00' ,'mm-dd-yyyy hh24:mi') - interval '0' day
				),
				cte_carlyle as (
				select 'Carlyle Lk-Kaskaskia' as project_id 
					,(cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT')) as date_time
					,q as midnight_outflow_carlyle
				from wm_mvs_lake.carlyle_gate
				where cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT') = to_date(to_char((cwms_util.change_timezone(sysdate, 'UTC', 'CST6CDT')), 'mm-dd-yyyy') || '00:00' ,'mm-dd-yyyy hh24:mi') - interval '0' day
				),
				cte_mark_twain as (
				select 
					case
						when lake = 'MT' then 'Mark Twain Lk-Salt'
					end as project_id
					,(cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT')) as date_time
					,outflow as midnight_outflow_mark_twain
				from wm_mvs_lake.qlev_fcst
				where (cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT')) = to_date(to_char((cwms_util.change_timezone(sysdate, 'UTC', 'CST6CDT')), 'mm-dd-yyyy') || '00:00' ,'mm-dd-yyyy hh24:mi') - interval '1' day 
				and (cwms_util.change_timezone(fcst_date, 'UTC', 'CST6CDT')) = to_date(to_char((cwms_util.change_timezone(sysdate, 'UTC', 'CST6CDT')), 'mm-dd-yyyy') || '00:00' ,'mm-dd-yyyy hh24:mi') - interval '0' day
				and lake = 'MT'
				order by project_id asc
				),
				cte_bankfull as (
					select 
					case
						when location_id = 'Lk Shelbyville' then 'Lk Shelbyville-Kaskaskia'
						when location_id = 'Wappapello Lk' then 'Wappapello Lk-St Francis'
						when location_id = 'Rend Lk' then 'Rend Lk-Big Muddy'
						when location_id = 'Mark Twain Lk' then 'Mark Twain Lk-Salt'
						when location_id = 'Carlyle Lk' then 'Carlyle Lk-Kaskaskia'
					end as project_id,
					location_level_id,
					level_date,
					constant_level,
					level_unit
				from 
					cwms_20.av_location_level
				where 
					specified_level_id = 'Bankfull' 
					and location_id = 
						case
							when '" . $location_id . "' = 'Lk Shelbyville-Kaskaskia' then 'Lk Shelbyville'
							when '" . $location_id . "' = 'Wappapello Lk-St Francis' then 'Wappapello Lk'
							when '" . $location_id . "' = 'Rend Lk-Big Muddy' then 'Rend Lk'
							when '" . $location_id . "' = 'Mark Twain Lk-Salt' then 'Mark Twain Lk'
							when '" . $location_id . "' = 'Carlyle Lk-Kaskaskia' then 'Carlyle Lk'
						end 
					and unit_system = 'EN'
					and level_unit = 'cfs'
				),
				cte_all_midnight_outflow as (
					select project_id, date_time, midnight_outflow_rend as midnight from cte_rend
					union all
					select project_id, date_time, midnight_outflow_wappapello as midnight from cte_wappapello
					union all
					select project_id, date_time, midnight_outflow_shelbyville as midnight from cte_shelbyville
					union all    
					select project_id, date_time, midnight_outflow_carlyle as midnight from cte_carlyle
					union all
					select project_id, date_time, midnight_outflow_mark_twain as midnight from cte_mark_twain
				)
				select cte_all_midnight_outflow.project_id
					,cte_all_midnight_outflow.date_time as midnight_date_time
					,cte_all_midnight_outflow.midnight
					
					,cte_all_evening_outflow.date_time as evening_date_time
					,cte_all_evening_outflow.evening

					,bankfull.constant_level as bankfull
                    ,bankfull.level_unit as bankfull_unit
				from cte_all_midnight_outflow
					left join cte_all_evening_outflow cte_all_evening_outflow on
					cte_all_evening_outflow.project_id = cte_all_midnight_outflow.project_id 
						left join cte_bankfull bankfull on
						cte_all_evening_outflow.project_id = bankfull.project_id
				where cte_all_midnight_outflow.project_id = '" . $location_id . "'
				and cte_all_evening_outflow.project_id = '" . $location_id . "'";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {
			$data = (object) [
				"project_id" => $row['PROJECT_ID'],
				"midnight_date_time" => $row['MIDNIGHT_DATE_TIME'],
				"midnight" => $row['MIDNIGHT'],
				"evening_date_time" => $row['EVENING_DATE_TIME'],
				"evening" => $row['EVENING'],
				"bankfull" => $row['BANKFULL'],
				"bankfull_unit" => $row['BANKFULL_UNIT']
			];
		}
	} catch (Exception $e) {
		$e = oci_error($db);
		trigger_error(htmlentities($e['message']), E_USER_ERROR);
		return null;
	} finally {
		oci_free_statement($stmnt_query);
	}
	return $data;
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_phase1_by_tsid($db, $cwms_ts_id)
{
	$stmnt_query = null;
	$data = null;

	try {
		$sql = "select location_id
					,location_level_id
					,level_date
					,constant_level 
				from CWMS_20.AV_LOCATION_LEVEL
				where specified_level_id = 'EOC Action Stage - Phase 1' and location_id = cwms_util.split_text('" . $cwms_ts_id . "', 1, '.') and unit_system = 'EN'";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {
			$data = (object) [
				"location_id" => $row['LOCATION_ID'],
				"location_level_id" => $row['LOCATION_LEVEL_ID'],
				"level_date" => $row['LEVEL_DATE'],
				"constant_level" => $row['CONSTANT_LEVEL']
			];
		}
	} catch (Exception $e) {
		$e = oci_error($db);
		trigger_error(htmlentities($e['message']), E_USER_ERROR);
		return null;
	} finally {
		oci_free_statement($stmnt_query);
	}
	return $data;
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_phase2_by_tsid($db, $cwms_ts_id)
{
	$stmnt_query = null;
	$data = null;

	try {
		$sql = "select location_id
					,location_level_id
					,level_date
					,constant_level 
				from CWMS_20.AV_LOCATION_LEVEL
				where specified_level_id = 'EOC Action Stage - Phase 2' and location_id = cwms_util.split_text('" . $cwms_ts_id . "', 1, '.') and unit_system = 'EN'";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {
			$data = (object) [
				"location_id" => $row['LOCATION_ID'],
				"location_level_id" => $row['LOCATION_LEVEL_ID'],
				"level_date" => $row['LEVEL_DATE'],
				"constant_level" => $row['CONSTANT_LEVEL']
			];
		}
	} catch (Exception $e) {
		$e = oci_error($db);
		trigger_error(htmlentities($e['message']), E_USER_ERROR);
		return null;
	} finally {
		oci_free_statement($stmnt_query);
	}
	return $data;
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_precip_by_location_id($db, $location_id)
{
	$stmnt_query = null;
	$data = null;

	try {
		$sql = "select cwms_util.split_text(cwms_ts_id, 1, '.') as location_id
					,value
					,cwms_ts_id
					,cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT') as date_time
					,unit_id
				from CWMS_20.AV_TSV_DQU_30D
				where cwms_ts_id = '" . $location_id . "' || '.Precip.Total.~1Day.1Day.lakerep-rev'
				and (cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT')) = to_date(to_char((cwms_util.change_timezone(sysdate, 'UTC', 'CST6CDT')), 'mm-dd-yyyy') || '00:00' ,'mm-dd-yyyy hh24:mi')
				and unit_id = 'in'
				order by date_time desc";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {
			$data = (object) [
				"location_id" => $row['LOCATION_ID'],
				"value" => $row['VALUE'],
				"cwms_ts_id" => $row['CWMS_TS_ID'],
				"date_time" => $row['DATE_TIME'],
				"unit_id" => $row['UNIT_ID']
			];
		}
	} catch (Exception $e) {
		$e = oci_error($db);
		trigger_error(htmlentities($e['message']), E_USER_ERROR);
		return null;
	} finally {
		oci_free_statement($stmnt_query);
	}
	return $data;
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_record_stage_by_tsid($db, $cwms_ts_id)
{
	$stmnt_query = null;
	$data = null;

	try {
		$sql = "select location_id
					,location_level_id
					,level_date
					,constant_level
					,level_unit
				from CWMS_20.AV_LOCATION_LEVEL
				where specified_level_id = 'Record Stage' and location_id = cwms_util.split_text('" . $cwms_ts_id . "', 1, '.') and unit_system = 'EN'";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {
			$data = (object) [
				"location_id" => $row['LOCATION_ID'],
				"location_level_id" => $row['LOCATION_LEVEL_ID'],
				"level_date" => $row['LEVEL_DATE'],
				"constant_level" => $row['CONSTANT_LEVEL'],
				"level_unit" => $row['LEVEL_UNIT']
			];
		}
	} catch (Exception $e) {
		$e = oci_error($db);
		trigger_error(htmlentities($e['message']), E_USER_ERROR);
		return null;
	} finally {
		oci_free_statement($stmnt_query);
	}
	return $data;
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_roller_tainter_by_tsid($db, $cwms_ts_id)
{
	$stmnt_query = null;
	$data = null;

	try {
		$sql = "select cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT') as date_time
					,value
					,cwms_ts_id
					,cwms_util.split_text(cwms_ts_id, 1, '.') as location_id
					,unit_id
					,to_char(to_date(cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT'),'mm-dd-yyyy HH24:MI'),'yyyy-mm-dd HH24:MI') as date_time_yyyy_mm_dd
				from CWMS_20.AV_TSV_DQU_30D
				where cwms_ts_id = '" . $cwms_ts_id . "'
					and (unit_id = 'ft' or unit_id = 'cfs' or unit_id = 'F' or unit_id = 'mg/l' or unit_id = 'umho/cm')
					--and cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT') = to_date('07-21-2022 07:00' ,'mm-dd-yyyy hh24:mi')
					and date_time  >= cast(cast(current_date as timestamp) at time zone 'UTC' as date) - interval '48' HOUR
					and date_time  <= cast(cast(current_date as timestamp) at time zone 'UTC' as date) 
				order by date_time desc
				fetch first 1 rows only";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {
			$data = (object) [
				"date_time" => $row['DATE_TIME'],
				"value" => $row['VALUE'],
				"unit_id" => $row['UNIT_ID'],
				"cwms_ts_id" => $row['CWMS_TS_ID'],
				"location_id" => $row['LOCATION_ID'],
				"date_time_yyyy_mm_dd" => $row['DATE_TIME_YYYY_MM_DD']
			];
		}
	} catch (Exception $e) {
		$e = oci_error($db);
		trigger_error(htmlentities($e['message']), E_USER_ERROR);
		return null;
	} finally {
		oci_free_statement($stmnt_query);
	}
	return $data;
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_rule_curve2_by_location_id($db, $location_id)
{
	$stmnt_query = null;
	$data = [];

	try {
		$sql = "with cte_rule_curve_spec as (
					select 
						case
							when lake = 'SHELBYVILLE' then 'Lk Shelbyville-Kaskaskia'
							when lake = 'WAPPAPELLO' then 'Wappapello Lk-St Francis'
							when lake = 'REND' then 'Rend Lk-Big Muddy'
							when lake = 'MT' then 'Mark Twain Lk-Salt'
							when lake = 'CARLYLE' then 'Carlyle Lk-Kaskaskia'
							else 'na'
						end as project_id,
						lev
					from wm_mvs_lake.rule_curve_spec
				),
				cte_rule_curve as (           
					select 
						case
							when lake = 'SHELBYVILLE' then 'Lk Shelbyville-Kaskaskia'
							when lake = 'WAPPAPELLO' then 'Wappapello Lk-St Francis'
							when lake = 'REND' then 'Rend Lk-Big Muddy'
							when lake = 'MT' then 'Mark Twain Lk-Salt'
							when lake = 'CARLYLE' then 'Carlyle Lk-Kaskaskia'
							else 'na'
						end as project_id,
						to_number(lev) as lev -- Assuming lev is a numeric type
					from wm_mvs_lake.rule_curve
					where to_date(substr(dt_s, 1, 5) || to_char(sysdate, 'YYYY') || substr(dt_s, 6), 'MM-DDYYYY HH24:MI') <= sysdate
					and to_date(substr(dt_e, 1, 5) || to_char(sysdate, 'YYYY') || substr(dt_e, 6), 'MM-DDYYYY HH24:MI') >= sysdate
				)
				
				select project_id, lev
				from cte_rule_curve_spec
				where project_id = '" . $location_id . "'
				
				union all
				
				select project_id, lev
				from cte_rule_curve
				where project_id = '" . $location_id . "'";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"project_id" => $row['PROJECT_ID'],
				"lev" => $row['LEV']
			];
			array_push($data, $obj);
		}
	} catch (Exception $e) {
		$e = oci_error($db);
		trigger_error(htmlentities($e['message']), E_USER_ERROR);

		return null;
	} finally {
		oci_free_statement($stmnt_query);
	}
	return $data;
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_schd($db)
{
	$stmnt_query = null;
	$data = null;

	try {
		$sql = "select schd
					,date_time
					,spc_inst
				from wm_mvs_lake.mt_schd
				order by date_time desc
				fetch next 1 row only";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {
			$data = (object) [
				"schd" => $row['SCHD'],
				"date_time" => $row['DATE_TIME'],
				"spc_inst" => $row['SPC_INST']
			];
		}
	} catch (Exception $e) {
		$e = oci_error($db);
		trigger_error(htmlentities($e['message']), E_USER_ERROR);
		return null;
	} finally {
		oci_free_statement($stmnt_query);
	}
	return $data;
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_stage_data_by_tsid($db, $cwms_ts_id)
{
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
					where cwms_ts_id = '" . $cwms_ts_id . "'
					and (unit_id = 'ppm' or unit_id = 'F' or unit_id = CASE WHEN cwms_util.split_text(cwms_ts_id,2,'.') IN ('Stage','Elev') THEN 'ft' WHEN cwms_util.split_text(cwms_ts_id,2,'.') IN ('Precip','Depth') THEN 'in' END or unit_id = 'cfs' or unit_id = 'umho/cm' or unit_id = 'volt')
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
					where cwms_ts_id = '" . $cwms_ts_id . "'
					and (unit_id = 'ppm' or unit_id = 'F' or unit_id = CASE WHEN cwms_util.split_text(cwms_ts_id,2,'.') IN ('Stage','Elev') THEN 'ft' WHEN cwms_util.split_text(cwms_ts_id,2,'.') IN ('Precip','Depth') THEN 'in' END or unit_id = 'cfs' or unit_id = 'umho/cm' or unit_id = 'volt')
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
					where cwms_ts_id = '" . $cwms_ts_id . "'
					and (unit_id = 'ppm' or unit_id = 'F' or unit_id = CASE WHEN cwms_util.split_text(cwms_ts_id,2,'.') IN ('Stage','Elev') THEN 'ft' WHEN cwms_util.split_text(cwms_ts_id,2,'.') IN ('Precip','Depth') THEN 'in' END or unit_id = 'cfs' or unit_id = 'umho/cm' or unit_id = 'volt')
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

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {

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
	} catch (Exception $e) {
		$e = oci_error($db);
		trigger_error(htmlentities($e['message']), E_USER_ERROR);

		return null;
	} finally {
		oci_free_statement($stmnt_query);
	}
	return $data;
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_turbine_by_location_id($db, $location_id)
{
	$stmnt_query = null;
	$data = null;

	try {
		$sql = "select cwms_util.split_text(cwms_ts_id, 1, '.') as location_id
					,value
					,cwms_ts_id
					,cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT') as date_time
					,unit_id
				from CWMS_20.AV_TSV_DQU_30D
				where cwms_ts_id = '" . $location_id . "' || '.Flow-Turb.Ave.~1Day.1Day.lakerep-rev'
				and (cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT')) = to_date(to_char((cwms_util.change_timezone(sysdate, 'UTC', 'CST6CDT')), 'mm-dd-yyyy') || '00:00' ,'mm-dd-yyyy hh24:mi')
				and unit_id = 'cfs'
				order by date_time desc";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {
			$data = (object) [
				"location_id" => $row['LOCATION_ID'],
				"value" => $row['VALUE'],
				"cwms_ts_id" => $row['CWMS_TS_ID'],
				"date_time" => $row['DATE_TIME'],
				"unit_id" => $row['UNIT_ID']
			];
		}
	} catch (Exception $e) {
		$e = oci_error($db);
		trigger_error(htmlentities($e['message']), E_USER_ERROR);
		return null;
	} finally {
		oci_free_statement($stmnt_query);
	}
	return $data;
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------