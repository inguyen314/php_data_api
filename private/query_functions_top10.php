<?php
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function find_datman_extents_per_location($db, $location_id)
{
	$stmnt_query = null;
	$data = null;

	try {
		$sql = "select location_id
					,parameter_id
					,extract(YEAR from earliest_time) as min_date_year
					,extract(YEAR from latest_time) as max_date_year 
					,ts_id
				from CWMS_20.AV_TS_EXTENTS_LOCAL
				where ts_id like '%datman-rev'
				and location_id = '" . $location_id . "'
				order by location_id asc";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {

			$data = (object) [
				"location_id" => $row['LOCATION_ID'],
				"parameter_id" => $row['PARAMETER_ID'],
				"min_date_year" => $row['MIN_DATE_YEAR'],
				"max_date_year" => $row['MAX_DATE_YEAR'],
				"ts_id" => $row['TS_ID']
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
function find_stage_29_from_location_id($db, $location_id)
{
	$stmnt_query = null;

	try {
		$sql = "select cwms_ts_id 
				from cwms_v_ts_id
				where location_id = '" . $location_id . "'
					and parameter_id = 'Stage'
					and version_id = '29'";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);
		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {
			$data =  $row['CWMS_TS_ID'];
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
function find_stage_rev_from_location_id($db, $location_id)
{
	$stmnt_query = null;

	try {
		$sql = "select cwms_ts_id 
				from cwms_v_ts_id
				where location_id = '" . $location_id . "'
					and parameter_id = 'Stage'
					and version_id = 'lrgsShef-rev'";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);
		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {
			$data =  $row['CWMS_TS_ID'];
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
function find_lake_flow_in_extents_per_location($db, $location_id)
{
	$stmnt_query = null;
	$data = null;

	try {
		$sql = "select location_id
		,parameter_id
		,extract(YEAR from earliest_time) as min_date_year
		,extract(YEAR from latest_time) as max_date_year 
		,ts_id
		from CWMS_20.AV_TS_EXTENTS_LOCAL
		where ts_id like '%lakerep-rev'
		and location_id = '" . $location_id . "'
		and parameter_id IN ('Flow-In')
		order by location_id asc";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {

			$data = (object) [
				"location_id" => $row['LOCATION_ID'],
				"parameter_id" => $row['PARAMETER_ID'],
				"min_date_year" => $row['MIN_DATE_YEAR'],
				"max_date_year" => $row['MAX_DATE_YEAR'],
				"ts_id" => $row['TS_ID']
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
function find_lake_flow_out_extents_per_location($db, $location_id)
{
	$stmnt_query = null;
	$data = null;

	try {
		$sql = "select location_id
		,parameter_id
		,extract(YEAR from earliest_time) as min_date_year
		,extract(YEAR from latest_time) as max_date_year 
		,ts_id
		from CWMS_20.AV_TS_EXTENTS_LOCAL
		where ts_id like '%lakerep-rev'
		and location_id = '" . $location_id . "'
		and parameter_id IN ('Flow-Out')
		order by location_id asc";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {

			$data = (object) [
				"location_id" => $row['LOCATION_ID'],
				"parameter_id" => $row['PARAMETER_ID'],
				"min_date_year" => $row['MIN_DATE_YEAR'],
				"max_date_year" => $row['MAX_DATE_YEAR'],
				"ts_id" => $row['TS_ID']
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
function find_flow_in_from_location_id($db, $location_id)
{
	$stmnt_query = null;

	try {
		$sql = "select cwms_ts_id 
				from cwms_v_ts_id
				where location_id = '" . $location_id . "'
					and parameter_id = 'Flow-In'
					and version_id = 'lakerep-rev'";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);
		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {
			$data =  $row['CWMS_TS_ID'];
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
function find_flow_out_from_location_id($db, $location_id)
{
	$stmnt_query = null;

	try {
		$sql = "select cwms_ts_id 
				from cwms_v_ts_id
				where location_id = '" . $location_id . "'
					and parameter_id = 'Flow-Out'
					and version_id = 'lakerep-rev'";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);
		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {
			$data =  $row['CWMS_TS_ID'];
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
function find_yearly_flow_max_rdl($db, $cwms_ts_id, $year)
{
	$stmnt_query = null;
	$data = null;

	try {
		$sql = "select date_time, value as max_value, quality_code from table(rdl.timeseries.getReportDataByType ('TS_AGG_MAX', '" . $cwms_ts_id . "', 
				to_date('01-01-'|| '" . $year . "' || ' 00:01' ,'mm-dd-yyyy hh24:mi'),
				to_date('12-31-' || '" . $year . "' || ' 23.59' ,'mm-dd-yyyy hh24:mi'),
				null,
				null,
				null,
				null, 
				'cfs',
				'MVS',
				'CST6CDT')
				)";

		//echo $sql;

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {

			$data = (object) [
				"date_time" => $row['DATE_TIME'],
				"max_value" => $row['MAX_VALUE'],
				"quality_code" => $row['QUALITY_CODE']
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
function find_yearly_flow_min_rdl($db, $cwms_ts_id, $year)
{
	$stmnt_query = null;
	$data = null;

	try {
		$sql = "select date_time, value as min_value, quality_code from table(rdl.timeseries.getReportDataByType ('TS_AGG_MIN', '" . $cwms_ts_id . "', 
				to_date('01-01-'|| '" . $year . "' || ' 00:01' ,'mm-dd-yyyy hh24:mi'),
				to_date('12-31-' || '" . $year . "' || ' 23.59' ,'mm-dd-yyyy hh24:mi'),
				null,--time_interval for example: TS_SNAP = 60 or 1 hour 
				null,--time_offset for example: 0,-8640 or 1400 or 0,-14400 for example: SNAPTOD 08:00
				null,--group_function goes with data_type = TIME_SERIES for example: MIN, MAX, AVG
				null,--group_interval goes with data_type = TIME_SERIES for example: DAY, MONTH, YEAR 
				'cfs',--unit 
				'MVS',--office_id 
				'US/Central')--timezone
				)";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {

			$data = (object) [
				"date_time" => $row['DATE_TIME'],
				"min_value" => $row['MIN_VALUE'],
				"quality_code" => $row['QUALITY_CODE']
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