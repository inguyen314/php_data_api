<?php
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function find_admin_by_username($db, $username) {
	$stmnt_query = null;
	$data = null;
	
	try {
		$sql = "SELECT * FROM WM_MVS_CF.ADMINS ";
		$sql .= "WHERE USERNAME = '" . $username . "'";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);		
		
		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$data = (object) 
			[
				"ID" => intval($row['ID']),
				"FIRST_NAME" => $row['FIRST_NAME'],
				"LAST_NAME" => $row['LAST_NAME'],
				"EMAIL" => $row['EMAIL'],
				"USERNAME" => $row['USERNAME'],
				"HASHED_PASSWORD" => $row['HASHED_PASSWORD']
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
function set_options($db) {
	$stmnt_query = null;
	
    try {
		$sql = "alter session set  NLS_DATE_FORMAT='mm-dd-yyyy hh24:mi'";
        $stmnt_query = oci_parse($db, $sql);
        $status = oci_execute($stmnt_query);
        if ( !$status ) {
            $e = oci_error($db);
            trigger_error(htmlentities($e['message']), E_USER_ERROR);
        }
    }
    catch (Exception $e) {
        $status = "ERROR: Could set database session options";
    }
	finally {
		oci_free_statement($stmnt_query); 
	}
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function set_options2($db) {
	//change format to = yyyy-mm-dd hh24:mi
	$stmnt_query = null;
	
    try {
        // mm-dd-yyyy hh24:mi
		$sql = "alter session set  NLS_DATE_FORMAT='yyyy-mm-dd hh24:mi'";
        $stmnt_query = oci_parse($db, $sql);
        $status = oci_execute($stmnt_query);
        if ( !$status ) {
            $e = oci_error($db);
            trigger_error(htmlentities($e['message']), E_USER_ERROR);
            // throw new \RuntimeException(self::$status);
        }
    }
    catch (Exception $e) {
        $status = "ERROR: Could set database session options";
        // throw new \RuntimeException(self::$status);
    }
	finally {
		oci_free_statement($stmnt_query); 
	}
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function find_gage_control_basin($db, $basin) {
	$stmnt_query = null;
	$data = [];

	try {		
		$sql = "select 	
					loc.location_id, loc.elevation, loc.latitude, loc.longitude, loc.vertical_datum, loc.public_name, loc.location_kind_id
					,station.station, station.drainage_area, station.area_unit
					,location_level.constant_level as flood_level, location_level.location_level_id as flood_level_location_level_id, location_level.level_unit as flood_level_level_unit
					,location_level2.constant_level as ngvd29, location_level2.location_level_id as ngvd29_location_level_id, location_level2.level_unit as ngvd29_level_unit
					,cga.group_id as owner
					,cga2.group_id as basin
				from cwms_20.av_loc loc
					left join cwms_20.av_stream_location station
					on loc.location_id = station.location_id
						left join cwms_20.av_location_level location_level
						on loc.location_id = location_level.location_id
							left join cwms_20.av_location_level location_level2
							on loc.location_id = location_level2.location_id
								left join cwms_20.av_loc_grp_assgn cga
								on loc.location_id = cga.location_id
									left join cwms_20.av_loc_grp_assgn cga2
									on loc.location_id = cga2.location_id
				where 
					loc.unit_system = 'EN'
					and station.unit_system = 'EN' 
					and location_level.unit_system = 'EN'
					and location_level.level_unit = 'ft'  
					and location_level.specified_level_id = 'Flood'
					and location_level2.unit_system = 'EN'
					and location_level2.level_unit = 'ft'  
					and location_level2.specified_level_id = 'NGVD29'
					and cga.category_id = 'RDL_MVS'
					and cga2.category_id = 'RDL_Basins'
					and cga2.group_id = '".$basin."'";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"location_id" => $row['LOCATION_ID'],
				"elevation" => $row['ELEVATION'],
				"latitude" => $row['LATITUDE'],
				"longitude" => $row['LONGITUDE'],
				"vertical_datum" => $row['VERTICAL_DATUM'],
				"public_name" => $row['PUBLIC_NAME'],
				"location_kind_id" => $row['LOCATION_KIND_ID'],

				"station" => $row['STATION'],
				"drainage_area" => $row['DRAINAGE_AREA'],
				"area_unit" => $row['AREA_UNIT'],

				"flood_level" => $row['FLOOD_LEVEL'],
				"flood_level_location_level_id" => $row['FLOOD_LEVEL_LOCATION_LEVEL_ID'],
				"flood_level_level_unit" => $row['FLOOD_LEVEL_LEVEL_UNIT'],
				
				"ngvd29" => $row['NGVD29'],
				"ngvd29_location_level_id" => $row['NGVD29_LOCATION_LEVEL_ID'],
				"ngvd29_level_unit" => $row['NGVD29_LEVEL_UNIT'],
				
				"owner" => $row['OWNER'],
				"basin" => $row['BASIN']
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
function find_gage_control_location_id($db, $location_id) {
	$stmnt_query = null;
	$data = null;

	try {		
		$sql = "select 	
					loc.location_id, loc.elevation, loc.latitude, loc.longitude, loc.vertical_datum, loc.public_name, loc.location_kind_id
					,station.station, station.drainage_area, station.area_unit
					,location_level.constant_level as flood_level, location_level.location_level_id as flood_level_location_level_id, location_level.level_unit as flood_level_level_unit
					,location_level2.constant_level as ngvd29, location_level2.location_level_id as ngvd29_location_level_id, location_level2.level_unit as ngvd29_level_unit
					,cga.group_id as owner
					,cga2.group_id as basin
				from cwms_20.av_loc loc
					left join cwms_20.av_stream_location station
					on loc.location_id = station.location_id
						left join cwms_20.av_location_level location_level
						on loc.location_id = location_level.location_id
							left join cwms_20.av_location_level location_level2
							on loc.location_id = location_level2.location_id
								left join cwms_20.av_loc_grp_assgn cga
								on loc.location_id = cga.location_id
									left join cwms_20.av_loc_grp_assgn cga2
									on loc.location_id = cga2.location_id
				where 
					loc.unit_system = 'EN'
					and station.unit_system = 'EN' 
					and location_level.unit_system = 'EN'
					and location_level.level_unit = 'ft'  
					and location_level.specified_level_id = 'Flood'
					and location_level2.unit_system = 'EN'
					and location_level2.level_unit = 'ft'  
					and location_level2.specified_level_id = 'NGVD29'
					and cga.category_id = 'RDL_MVS'
					and cga2.category_id = 'RDL_Basins'
					and loc.location_id = '".$location_id."'";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$data = (object) [
				"location_id" => $row['LOCATION_ID'],
				"elevation" => $row['ELEVATION'],
				"latitude" => $row['LATITUDE'],
				"longitude" => $row['LONGITUDE'],
				"vertical_datum" => $row['VERTICAL_DATUM'],
				"public_name" => $row['PUBLIC_NAME'],
				"location_kind_id" => $row['LOCATION_KIND_ID'],

				"station" => $row['STATION'],
				"drainage_area" => $row['DRAINAGE_AREA'],
				"area_unit" => $row['AREA_UNIT'],

				"flood_level" => $row['FLOOD_LEVEL'],
				"flood_level_location_level_id" => $row['FLOOD_LEVEL_LOCATION_LEVEL_ID'],
				"flood_level_level_unit" => $row['FLOOD_LEVEL_LEVEL_UNIT'],
				
				"ngvd29" => $row['NGVD29'],
				"ngvd29_location_level_id" => $row['NGVD29_LOCATION_LEVEL_ID'],
				"ngvd29_level_unit" => $row['NGVD29_LEVEL_UNIT'],
				
				"owner" => $row['OWNER'],
				"basin" => $row['BASIN']
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
function find_gage_control($db) {
	$stmnt_query = null;
	$data = [];

	try {		
		$sql = "select 	
					loc.location_id, loc.elevation, loc.latitude, loc.longitude, loc.vertical_datum, loc.public_name, loc.location_kind_id
					,station.station, station.drainage_area, station.area_unit
					,location_level.constant_level as flood_level, location_level.location_level_id as flood_level_location_level_id, location_level.level_unit as flood_level_level_unit
					,location_level2.constant_level as ngvd29, location_level2.location_level_id as ngvd29_location_level_id, location_level2.level_unit as ngvd29_level_unit
					,cga.group_id as owner
					,cga2.group_id as basin
				from cwms_20.av_loc loc
					left join cwms_20.av_stream_location station
					on loc.location_id = station.location_id
						left join cwms_20.av_location_level location_level
						on loc.location_id = location_level.location_id
							left join cwms_20.av_location_level location_level2
							on loc.location_id = location_level2.location_id
								left join cwms_20.av_loc_grp_assgn cga
								on loc.location_id = cga.location_id
									left join cwms_20.av_loc_grp_assgn cga2
									on loc.location_id = cga2.location_id
				where 
					loc.unit_system = 'EN'
					and station.unit_system = 'EN' 
					and location_level.unit_system = 'EN'
					and location_level.level_unit = 'ft'  
					and location_level.specified_level_id = 'Flood'
					and location_level2.unit_system = 'EN'
					and location_level2.level_unit = 'ft'  
					and location_level2.specified_level_id = 'NGVD29'
					and cga.category_id = 'RDL_MVS'
					and cga2.category_id = 'RDL_Basins'";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"location_id" => $row['LOCATION_ID'],
				"elevation" => $row['ELEVATION'],
				"latitude" => $row['LATITUDE'],
				"longitude" => $row['LONGITUDE'],
				"vertical_datum" => $row['VERTICAL_DATUM'],
				"public_name" => $row['PUBLIC_NAME'],
				"location_kind_id" => $row['LOCATION_KIND_ID'],

				"station" => $row['STATION'],
				"drainage_area" => $row['DRAINAGE_AREA'],
				"area_unit" => $row['AREA_UNIT'],

				"flood_level" => $row['FLOOD_LEVEL'],
				"flood_level_location_level_id" => $row['FLOOD_LEVEL_LOCATION_LEVEL_ID'],
				"flood_level_level_unit" => $row['FLOOD_LEVEL_LEVEL_UNIT'],
				
				"ngvd29" => $row['NGVD29'],
				"ngvd29_location_level_id" => $row['NGVD29_LOCATION_LEVEL_ID'],
				"ngvd29_level_unit" => $row['NGVD29_LEVEL_UNIT'],
				
				"owner" => $row['OWNER'],
				"basin" => $row['BASIN']
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
function find_db_info($db) {
	$stmnt_query = null;
	$data = null;
	
	try {
		$sql = 'SELECT banner FROM v$version';
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);		
		
		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {		
			$data = (object) 
			[
				"banner" => $row['BANNER']
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
function v_session($db,$session_username) {
	$stmnt_query = null;
	$data = [];
	
	try {
		$sql = "select count(*) as session_count, status, process, program, machine, schemaname ";
		$sql .= 'from v$session ';
		$sql .= "where username='".$session_username."'";
		$sql .= "group by status, process, program, machine, schemaname";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"session_count" => $row['SESSION_COUNT'],
				"status" => $row['STATUS'],
				"process" => $row['PROCESS'],
				"program" => $row['PROGRAM'],
				"machine" => $row['MACHINE'],
				"schemaname" => $row['SCHEMANAME']
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
function v_session_active($db) {
	$stmnt_query = null;
	$data = [];
	
	try {
		$sql = "SELECT COUNT(*) as active_sessions ";
		$sql .= 'from v$session ';
		$sql .= "where status='ACTIVE'";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"active_sessions" => $row['ACTIVE_SESSIONS']
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
function cp_comp_tasklist($db) {
	$stmnt_query = null;
	$data = [];
	
	try {
		$sql = "select loading_application_id,count(loading_application_id) as count from CCP.CP_COMP_TASKLIST group by loading_application_id";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"loading_application_id" => $row['LOADING_APPLICATION_ID'],
				"count" => $row['COUNT']
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
function find_loading_application($db) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "SELECT
					loading_application_name,
					COUNT(loading_application_name)
				FROM
					ccp.cp_comp_tasklist t,
					ccp.hdb_loading_application a
				WHERE
					a.loading_application_id = t.loading_application_id
				GROUP BY
					loading_application_name";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"loading_application_name" => $row['LOADING_APPLICATION_NAME'],
				"count_loading_application_name" => $row['COUNT_LOADING_APPLICATION_NAME']				
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
function find_comp_retry($db) {
	$stmnt_query = null;
	$data = [];

	try {				
		$sql = "select site_datatype_id, site, loading_app, number_comps 
			from (SELECT DISTINCT tl.site_datatype_id,
			(SELECT b.cwms_ts_id FROM cwms_20.av_cwms_ts_id b WHERE b.ts_code=tl.site_datatype_id) AS site,
			(SELECT a.loading_application_name FROM ccp.hdb_loading_application a WHERE a.loading_application_id = tl.loading_application_id ) AS loading_app,
			Count(tl.site_datatype_id) OVER (partition BY tl.site_datatype_id) AS number_comps
			FROM cp_comp_tasklist tl where fail_time is not null 
			ORDER BY number_comps desc)";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"site_datatype_id" => $row['SITE_DATATYPE_ID'],
				"site" => $row['SITE'],
				"loading_app" => $row['LOADING_APP'],
				"number_comps" => $row['NUMBER_COMPS']
			];
			array_push($data, $obj);
		}
	}
	catch (Exception $e)  {
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
function find_username_at_log_message($db) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "select distinct session_username from CWMS_20.at_log_message";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"session_username" => $row['SESSION_USERNAME']			
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
function find_at_log_message($db,$session_username) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "select msg_id
					,office_code
					,log_timestamp_utc
					,msg_level
					,component
					,instance
					,host
					,port
					,report_timestamp_utc
					,session_username
					,session_osuser
					,session_process
					,session_machine
					,msg_type
					,msg_text
				from CWMS_20.at_log_message 
				where session_username = '".$session_username."' 
				and ROWNUM <= 500";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"msg_id" => $row['MSG_ID'],
				"office_code" => $row['OFFICE_CODE'],
				"log_timestamp_utc" => $row['LOG_TIMESTAMP_UTC'],
				"msg_level" => $row['MSG_LEVEL'],
				"component" => $row['COMPONENT'],
				"instance" => $row['INSTANCE'],
				"host" => $row['HOST'],
				"port" => $row['PORT'],
				"report_timestamp_utc" => $row['REPORT_TIMESTAMP_UTC'],
				"session_username" => $row['SESSION_USERNAME'],
				"session_osuser" => $row['SESSION_OSUSER'],
				"session_process" => $row['SESSION_PROCESS'],
				"session_machine" => $row['SESSION_MACHINE'],
				"msg_type" => $row['MSG_TYPE'],
				"msg_text" => $row['MSG_TEXT']
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
function find_metadata_by_location_id($db, $location_id) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "select  loc.location_code, 
					loc.base_location_code, 
					loc.sub_location_id, 
					loc.location_id, 
					loc.location_type, 
					loc.unit_system, 
					loc.elevation,
					loc.unit_id,
					loc.vertical_datum,
					loc.longitude,
					loc.latitude,
					loc.time_zone_name,
					loc.county_name,
					loc.state_initial,
					loc.public_name,
					loc.long_name,
					loc.description,
					loc.base_loc_active_flag,
					loc.loc_active_flag,
					loc.location_kind_id,
					loc.map_label,
					loc.published_latitude,
					loc.published_longitude,
					loc.bounding_office_id,
					loc.nation_id,
					loc.nearest_city,
					loc.active_flag,
					stream.station, 
					stream.stream_location_code, 
					stream.stream_location_id, 
					stream.bank, 
					stream.station_unit, 
					stream.area_unit, 
					stream.lowest_measurable_stage, 
					stream.navigation_station, 
					stream.drainage_area,
					stream.ungaged_area 
			from cwms_v_loc loc 
			join cwms_v_stream_location stream on 
			loc.location_id=stream.location_id
			where loc.location_id = '" . $location_id . "'
				and loc.unit_system = 'EN'
				and loc.sub_location_id is NOT null 
				and stream.unit_system = 'EN'";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			
			$obj = (object) [
				"location_code" => $row['LOCATION_CODE'],
				"base_location_code" => $row['BASE_LOCATION_CODE'],
				"sub_location_id" => $row['SUB_LOCATION_ID'],
				"location_id" => $row['LOCATION_ID'],
				"location_type" => $row['LOCATION_TYPE'],
				"unit_system" => $row['UNIT_SYSTEM'],
				"elevation" => $row['ELEVATION'],
				"unit_id" => $row['UNIT_ID'],
				"vertical_datum" => $row['VERTICAL_DATUM'],
				"longitude" => $row['LONGITUDE'],
				"latitude" => $row['LATITUDE'],
				"time_zone_name" => $row['TIME_ZONE_NAME'],
				"county_name" => $row['COUNTY_NAME'],
				"state_initial" => $row['STATE_INITIAL'],
				"public_name" => $row['PUBLIC_NAME'],
				"long_name" => $row['LONG_NAME'],
				"description" => $row['DESCRIPTION'],
				"base_loc_active_flag" => $row['BASE_LOC_ACTIVE_FLAG'],
				"loc_active_flag" => $row['LOC_ACTIVE_FLAG'],
				"location_kind_id" => $row['LOCATION_KIND_ID'],
				"map_label" => $row['MAP_LABEL'],
				"published_latitude" => $row['PUBLISHED_LATITUDE'],
				"published_longitude" => $row['PUBLISHED_LONGITUDE'],
				"bounding_office_id" => $row['BOUNDING_OFFICE_ID'],
				"nation_id" => $row['NATION_ID'],
				"nearest_city" => $row['NEAREST_CITY'],
				"active_flag" => $row['ACTIVE_FLAG'],
				"station" => $row['STATION'],
				"stream_location_code" => $row['STREAM_LOCATION_CODE'],
				"stream_location_id" => $row['STREAM_LOCATION_ID'],
				"bank" => $row['BANK'],
				"station_unit" => $row['STATION_UNIT'],
				"lowest_measurable_stage" => $row['LOWEST_MEASURABLE_STAGE'],
				"navigation_station" => $row['NAVIGATION_STATION'],
				"drainage_area" => $row['DRAINAGE_AREA'],
				"ungaged_area" => $row['UNGAGED_AREA']
				
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
function find_datum_conversion_by_basin($db, $basin) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "select  loc.location_code, 
					loc.base_location_code, 
					loc.base_location_code, 
					loc.sub_location_id, 
					loc.sub_location_id, 
					loc.location_id, 
					loc.location_type, 
					loc.unit_system, 
					loc.elevation,
					loc.unit_id,
					loc.vertical_datum,
					loc.longitude,
					loc.latitude,
					loc.time_zone_name,
					loc.county_name,
					loc.state_initial,
					loc.public_name,
					loc.long_name,
					loc.description,
					loc.base_loc_active_flag,
					loc.loc_active_flag,
					loc.location_kind_id,
					loc.map_label,
					loc.published_latitude,
					loc.published_longitude,
					loc.bounding_office_id,
					loc.nation_id,
					loc.nearest_city,
					loc.active_flag,
					stream.station, 
					stream.stream_location_code, 
					stream.stream_location_id, 
					stream.bank, 
					stream.station_unit, 
					stream.area_unit, 
					stream.lowest_measurable_stage, 
					stream.navigation_station, 
					stream.drainage_area,
					stream.ungaged_area, 
					loc_lev.location_level_id,
					loc_lev.attribute_id,
					loc_lev.level_date,
					loc_lev.unit_system,
					loc_lev.attribute_unit,
					loc_lev.level_unit,
					loc_lev.attribute_value,
					loc_lev.constant_level,
					loc_lev.interval_origin,
					loc_lev.calendar_interval,
					loc_lev.time_interval,
					loc_lev.interpolate,
					loc_lev.calendar_offset,
					loc_lev.time_offset,
					loc_lev.seasonal_level,
					loc_lev.tsid,
					loc_lev.level_comment,
					loc_lev.attribute_comment,
					loc_lev.base_parameter_id,
					loc_lev.sub_parameter_id,
					loc_lev.parameter_id,
					loc_lev.duration_id,
					loc_lev.specified_level_id,
					loc_lev.location_code,
					loc_lev.location_level_code,
					loc_lev.expiration_date,
					loc_lev.parameter_type_id,
					loc_lev.attribute_parameter_id,
					loc_lev.attribute_base_parameter_id,
					loc_lev.attribute_sub_parameter_id,
					loc_lev.attribute_parameter_type_id,
					loc_lev.attribute_duration_id,
					loc_lev.default_label,
					loc_lev.source,
					basin.category_id,
					basin.group_id as basin,
					basin.alias_id,
					basin.ref_location_id,
					basin.shared_alias_id,
					basin.shared_ref_location_id,
					cga.group_id
			from cwms_v_loc loc 
                join cwms_v_stream_location stream on 
                loc.location_id=stream.location_id
                join cwms_v_location_level loc_lev on
                loc.location_id=loc_lev.location_id
                join CWMS_V_LOC_GRP_ASSGN basin on
                loc.location_id=basin.location_id
                join CWMS_V_LOC_GRP_ASSGN cga on
                loc.location_id=cga.location_id
			where 
				loc.unit_system = 'EN'
				and loc.sub_location_id is NOT null 
				and stream.unit_system = 'EN'
				and loc_lev.unit_system = 'EN'
				and loc_lev.location_level_id like '%Height.Inst.0.NGVD29'
				and basin.category_id = 'RDL_Basins'
                and cga.category_id = 'RDL_MVS'
				and cga.group_id = 'MVS'
				and basin.group_id = '". $basin . "'";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			
			$obj = (object) [
				"location_code" => $row['LOCATION_CODE'],
				"base_location_code" => $row['BASE_LOCATION_CODE'],
				"sub_location_id" => $row['SUB_LOCATION_ID'],
				"location_id" => $row['LOCATION_ID'],
				"location_type" => $row['LOCATION_TYPE'],
				"unit_system" => $row['UNIT_SYSTEM'],
				"elevation" => $row['ELEVATION'],
				"unit_id" => $row['UNIT_ID'],
				"vertical_datum" => $row['VERTICAL_DATUM'],
				"longitude" => $row['LONGITUDE'],
				"latitude" => $row['LATITUDE'],
				"time_zone_name" => $row['TIME_ZONE_NAME'],
				"county_name" => $row['COUNTY_NAME'],
				"state_initial" => $row['STATE_INITIAL'],
				"public_name" => $row['PUBLIC_NAME'],
				"long_name" => $row['LONG_NAME'],
				"description" => $row['DESCRIPTION'],
				"base_loc_active_flag" => $row['BASE_LOC_ACTIVE_FLAG'],
				"loc_active_flag" => $row['LOC_ACTIVE_FLAG'],
				"location_kind_id" => $row['LOCATION_KIND_ID'],
				"map_label" => $row['MAP_LABEL'],
				"published_latitude" => $row['PUBLISHED_LATITUDE'],
				"published_longitude" => $row['PUBLISHED_LONGITUDE'],
				"bounding_office_id" => $row['BOUNDING_OFFICE_ID'],
				"nation_id" => $row['NATION_ID'],
				"nearest_city" => $row['NEAREST_CITY'],
				"active_flag" => $row['ACTIVE_FLAG'],
				"station" => $row['STATION'],
				"stream_location_code" => $row['STREAM_LOCATION_CODE'],
				"stream_location_id" => $row['STREAM_LOCATION_ID'],
				"bank" => $row['BANK'],
				"station_unit" => $row['STATION_UNIT'],
				"area_unit" => $row['AREA_UNIT'],
				"lowest_measurable_stage" => $row['LOWEST_MEASURABLE_STAGE'],
				"navigation_station" => $row['NAVIGATION_STATION'],
				"drainage_area" => $row['DRAINAGE_AREA'],
				"ungaged_area" => $row['UNGAGED_AREA'],
				"location_level_id" => $row['LOCATION_LEVEL_ID'],
				"attribute_id" => $row['ATTRIBUTE_ID'],
				"level_date" => $row['LEVEL_DATE'],
				"unit_system" => $row['UNIT_SYSTEM'],
				"attribute_unit" => $row['ATTRIBUTE_UNIT'],
				"level_unit" => $row['LEVEL_UNIT'],
				"attribute_value" => $row['ATTRIBUTE_VALUE'],
				"constant_level" => $row['CONSTANT_LEVEL'],
				"interval_origin" => $row['INTERVAL_ORIGIN'],
				"calendar_interval" => $row['CALENDAR_INTERVAL'],
				"time_interval" => $row['TIME_INTERVAL'],
				"interpolate" => $row['INTERPOLATE'],
				"calendar_offset" => $row['CALENDAR_OFFSET'],
				"time_offset" => $row['TIME_OFFSET'],
				"seasonal_level" => $row['SEASONAL_LEVEL'],
				"tsid" => $row['TSID'],
				"level_comment" => $row['LEVEL_COMMENT'],
				"attribute_comment" => $row['ATTRIBUTE_COMMENT'],
				"base_parameter_id" => $row['BASE_PARAMETER_ID'],
				"sub_parameter_id" => $row['SUB_PARAMETER_ID'],
				"parameter_id" => $row['PARAMETER_ID'],
				"duration_id" => $row['DURATION_ID'],
				"specified_level_id" => $row['SPECIFIED_LEVEL_ID'],
				"location_code" => $row['LOCATION_CODE'],
				"location_level_code" => $row['LOCATION_LEVEL_CODE'],
				"expiration_date" => $row['EXPIRATION_DATE'],
				"parameter_type_id" => $row['PARAMETER_TYPE_ID'],
				"attribute_parameter_id" => $row['ATTRIBUTE_PARAMETER_ID'],
				"attribute_base_parameter_id" => $row['ATTRIBUTE_BASE_PARAMETER_ID'],
				"attribute_sub_parameter_id" => $row['ATTRIBUTE_SUB_PARAMETER_ID'],
				"attribute_parameter_type_id" => $row['ATTRIBUTE_PARAMETER_TYPE_ID'],
				"attribute_duration_id" => $row['ATTRIBUTE_DURATION_ID'],
				"default_label" => $row['DEFAULT_LABEL'],
				"source" => $row['SOURCE'],
				"category_id" => $row['CATEGORY_ID'],
				"basin" => $row['BASIN'],
				"alias_id" => $row['ALIAS_ID'],
				"ref_location_id" => $row['REF_LOCATION_ID'],
				"shared_alias_id" => $row['SHARED_ALIAS_ID'],
				"shared_ref_location_id" => $row['SHARED_REF_LOCATION_ID'],
				"group_id" => $row['GROUP_ID'],
				
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