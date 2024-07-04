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
