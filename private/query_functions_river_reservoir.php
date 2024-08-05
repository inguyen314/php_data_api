<?php
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_lake_storage($db, $cwms_ts_id)
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
function get_precip_lake($db, $location_id)
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
function get_inflow($db, $location_id)
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
function get_outflow($db, $location_id)
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
function get_rule_curve($db, $location_id)
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
function get_crest_forecast($db, $location_id)
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
function get_crest_data($db, $cwms_ts_id)
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