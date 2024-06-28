<?php
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function find_specified_level_id($db) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "select distinct specified_level_id from cwms_20.av_location_level order by specified_level_id";
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"specified_level_id" => $row['SPECIFIED_LEVEL_ID']			
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
function get_specified_level_id_level($db, $location_id, $specified_level_id) {
	$stmnt_query = null;
	$data = null;
	
	try {		
		$sql = "select location_level_id
					,level_unit
					,constant_level
					,location_id
					,parameter_id
					,specified_level_id
				from CWMS_20.AV_LOCATION_LEVEL
				where specified_level_id = '".$specified_level_id."'
				and level_unit = 'ft'
				and location_id = '".$location_id."'";
			
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
				
			$data = (object) [
				"location_level_id" => $row['LOCATION_LEVEL_ID'],
				"level_unit" => $row['LEVEL_UNIT'],
				"constant_level" => $row['CONSTANT_LEVEL'],
				"location_id" => $row['LOCATION_ID'],
				"parameter_id" => $row['PARAMETER_ID'],
				"specified_level_id" => $row['SPECIFIED_LEVEL_ID']
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
function find_all_basins($db) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "SELECT DISTINCT group_id as basin 
				from CWMS_20.AV_LOC_GRP_ASSGN 
				where category_id = 'RDL_Basins'
				order by group_id";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			
			$obj = (object) [
				"basin" => $row['BASIN']				
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
function find_mvs_basins($db) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "SELECT DISTINCT group_id as basin 
				from CWMS_20.AV_LOC_GRP_ASSGN 
				where category_id = 'RDL_Basins'
				and group_id NOT IN ('Ohio','Castor')
				order by group_id";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"basin" => $row['BASIN']				
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
function find_river_reservoir_basins($db) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "SELECT DISTINCT group_id as basin 
				from CWMS_20.AV_LOC_GRP_ASSGN 
				where category_id = 'RDL_Basins'
				and group_id NOT IN ('Castor','Salt','St Francis')
				order by group_id";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"basin" => $row['BASIN']				
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
function find_river_reservoir_lakes($db) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "select location_id as lake
				from cwms_v_loc_grp_assgn
				where category_id = 'RDL_Project_Types' and group_id = 'Lake'
				order by location_id asc";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"lake" => $row['LAKE']				
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
function find_river_reservoir_lake_locations($db) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "select 
				case
					when location_id = 'Shelbyville Lk' then 'Lk Shelbyville-Kaskaskia'
					when location_id = 'Wappapello Lk' then 'Wappapello Lk-St Francis'
					when location_id = 'Rend Lk' then 'Rend Lk-Big Muddy'
					when location_id = 'Mark Twain Lk' then 'Mark Twain Lk-Salt'
					when location_id = 'Carlyle Lk' then 'Carlyle Lk-Kaskaskia'
					else 'na'
				end as lake
				from cwms_v_loc_grp_assgn
				where category_id = 'RDL_Project_Types' and group_id = 'Lake'
				order by attribute asc";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"lake" => $row['LAKE']				
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
function find_all_verion_ids($db) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "SELECT DISTINCT version_id
				from CWMS_20.AV_CWMS_TS_ID
				order by version_id asc";
			
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"version_id" => $row['VERSION_ID']				
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
function find_all_parameter_ids($db) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "SELECT DISTINCT parameter_id
				from CWMS_20.AV_CWMS_TS_ID
				order by parameter_id asc";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"parameter_id" => $row['PARAMETER_ID']				
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
function find_rating_stage_coe($db) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "select distinct office_id, template_id, location_id, version, native_units, SUBSTR(template_id, 12,4) as agency 
				from CWMS_20.AV_RATING_LOCAL
				where template_id like '%COE' 
					and template_id like 'Stage%' 
					and template_id like '%Flow%'
					and template_id not like '%Flow-%'
					and template_id not like '%,%'
					and location_id not like '%0%'
					and aliased_item is null
					and version = 'Production'
				order by location_id asc";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"office_id" => $row['OFFICE_ID'],
				"template_id" => $row['TEMPLATE_ID'],
				"location_id" => $row['LOCATION_ID'],
				"version" => $row['VERSION'],
				"native_units" => $row['NATIVE_UNITS'],
				"agency" => $row['AGENCY']			
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
function find_location_id_rating_stage_coe($db, $location_id) {
	$stmnt_query = null;
	$data = null;
	
	try {		
		$sql = "select distinct office_id, template_id, location_id, version, native_units, SUBSTR(template_id, 12,4) as agency 
				from CWMS_20.AV_RATING_LOCAL
				where template_id like '%COE' 
					and template_id like 'Stage%' 
					and template_id like '%Flow%'
					and template_id not like '%Flow-%'
					and template_id not like '%,%'
					and location_id not like '%0%'
					and aliased_item is null
					and version = 'Production'
					and location_id = '".$location_id."'
				order by location_id asc";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {

			$data = (object) [
				"office_id" => $row['OFFICE_ID'],
				"template_id" => $row['TEMPLATE_ID'],
				"location_id" => $row['LOCATION_ID'],
				"version" => $row['VERSION'],
				"native_units" => $row['NATIVE_UNITS'],
				"agency" => $row['AGENCY']			
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
function find_location_id_rating_stage_usgs($db,$location_id) {
	$stmnt_query = null;
	$data = null;
	
	try {		
		$sql = "select distinct office_id, template_id, location_id, version, native_units, SUBSTR(template_id, 12,4) as agency 
				from CWMS_20.AV_RATING_LOCAL
				where template_id like '%USGS' 
					and template_id like 'Stage%' 
					and template_id like '%Flow%'
					and template_id not like '%Flow-%'
					and template_id not like '%,%'
					and location_id not like '%0%'
					and aliased_item is null
					and version = 'Production'
					and location_id = '".$location_id."'
				order by location_id asc";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			
			$data = (object) [
				"office_id" => $row['OFFICE_ID'],
				"template_id" => $row['TEMPLATE_ID'],
				"location_id" => $row['LOCATION_ID'],
				"version" => $row['VERSION'],
				"native_units" => $row['NATIVE_UNITS'],
				"agency" => $row['AGENCY']			
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
function find_rating_stage_usgs($db) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "select distinct office_id, template_id, location_id, version, native_units, SUBSTR(template_id, 12,4) as agency 
				from CWMS_20.AV_RATING_LOCAL
				where template_id like '%USGS' 
					and template_id like 'Stage%' 
					and template_id like '%Flow%'
					and template_id not like '%Flow-%'
					and template_id not like '%,%'
					and location_id not like '%0%'
					and aliased_item is null
					and version = 'Production'
				order by location_id asc";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"office_id" => $row['OFFICE_ID'],
				"template_id" => $row['TEMPLATE_ID'],
				"location_id" => $row['LOCATION_ID'],
				"version" => $row['VERSION'],
				"native_units" => $row['NATIVE_UNITS'],
				"agency" => $row['AGENCY']			
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
function find_rating_stage_nws($db) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "select distinct office_id, template_id, location_id, version, native_units, SUBSTR(template_id, 12,4) as agency 
				from CWMS_20.AV_RATING_LOCAL
				where template_id like '%NWS' 
					and template_id like 'Stage%' 
					and template_id like '%Flow%'
					and template_id not like '%Flow-%'
					and template_id not like '%,%'
					and location_id not like '%0%'
					and aliased_item is null
					and version = 'Production'
				order by location_id asc";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"office_id" => $row['OFFICE_ID'],
				"template_id" => $row['TEMPLATE_ID'],
				"location_id" => $row['LOCATION_ID'],
				"version" => $row['VERSION'],
				"native_units" => $row['NATIVE_UNITS'],
				"agency" => $row['AGENCY']			
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
function find_location_id_rating_stage_nws($db,$location_id) {
	$stmnt_query = null;
	$data = null;
	
	try {		
		$sql = "select distinct office_id, template_id, location_id, version, native_units, SUBSTR(template_id, 12,4) as agency 
				from CWMS_20.AV_RATING_LOCAL
				where template_id like '%NWS' 
					and template_id like 'Stage%' 
					and template_id like '%Flow%'
					and template_id not like '%Flow-%'
					and template_id not like '%,%'
					and location_id not like '%0%'
					and aliased_item is null
					and version = 'Production'
					and location_id = '".$location_id."'
				order by location_id asc";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {

			$data = (object) [
				"office_id" => $row['OFFICE_ID'],
				"template_id" => $row['TEMPLATE_ID'],
				"location_id" => $row['LOCATION_ID'],
				"version" => $row['VERSION'],
				"native_units" => $row['NATIVE_UNITS'],
				"agency" => $row['AGENCY']			
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
function find_all_location_ids($db) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "SELECT location_id
				FROM (select cga.category_id, cga.group_id, loc.location_id
					FROM cwms_v_loc loc
					inner join CWMS_V_LOC_GRP_ASSGN cga on
					   cga.location_id=loc.location_id
					where
						loc.db_office_id = 'MVS'
						and Unit_system = 'EN'
						and cga.category_id = 'RDL_MVS'
					)
					ORDER BY location_id asc";
	
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
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
function find_location_id_datman_extents($db, $location_id) {
	$stmnt_query = null;
	$data = null;
	
	try {		
		$sql = "select location_id
					,parameter_id
					,extract(YEAR from earliest_time) as min_date_year
					,extract(MONTH from earliest_time) as min_date_month
					,extract(DAY from earliest_time) as min_date_day
					,extract(YEAR from latest_time) as max_date_year 
					,extract(MONTH from latest_time) as max_date_month
					,extract(DAY from latest_time) as max_date_day
					,ts_id
				from CWMS_20.AV_TS_EXTENTS_LOCAL
				where ts_id like '%datman-rev'
				and location_id = '".$location_id."'
				order by location_id asc";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {

			$data = (object) [
				"location_id" => $row['LOCATION_ID'],
				"parameter_id" => $row['PARAMETER_ID'],
				"min_date_year" => $row['MIN_DATE_YEAR'],
				"min_date_month" => $row['MIN_DATE_MONTH'],
				"min_date_day" => $row['MIN_DATE_DAY'],
				"max_date_year" => $row['MAX_DATE_YEAR'],
				"max_date_month" => $row['MAX_DATE_MONTH'],
				"max_date_day" => $row['MAX_DATE_DAY'],
				"ts_id" => $row['TS_ID']			
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
function find_tsid_extents($db, $cwms_ts_id) {
	$stmnt_query = null;
	$data = null;
	
	try {		
		$sql = "select location_id
					,parameter_id
					,earliest_time
					,latest_time
					,ts_id
				from CWMS_20.AV_TS_EXTENTS_LOCAL
				where ts_id = '".$cwms_ts_id."'
				order by location_id asc";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {

			$data = (object) [
				"location_id" => $row['LOCATION_ID'],
				"parameter_id" => $row['PARAMETER_ID'],
				"earliest_time" => $row['EARLIEST_TIME'],
				"latest_time" => $row['LATEST_TIME'],
				"ts_id" => $row['TS_ID']		
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
function find_location_id_lake_inflow_extents($db, $location_id) {
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
		and location_id = '".$location_id."'
		and parameter_id IN ('Flow-In')
		order by location_id asc";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {

			$data = (object) [
				"location_id" => $row['LOCATION_ID'],
				"parameter_id" => $row['PARAMETER_ID'],
				"min_date_year" => $row['MIN_DATE_YEAR'],
				"max_date_year" => $row['MAX_DATE_YEAR'],
				"ts_id" => $row['TS_ID']			
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
function find_location_id_lake_outflow_extents($db, $location_id) {
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
		and location_id = '".$location_id."'
		and parameter_id IN ('Flow-Out')
		order by location_id asc";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {

			$data = (object) [
				"location_id" => $row['LOCATION_ID'],
				"parameter_id" => $row['PARAMETER_ID'],
				"min_date_year" => $row['MIN_DATE_YEAR'],
				"max_date_year" => $row['MAX_DATE_YEAR'],
				"ts_id" => $row['TS_ID']			
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
function find_datman_rev_basin($db, $basin) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "select local.location_id,
				local.ts_code,
				local.parameter_id,
				grp.group_id as basin,
			extract(YEAR from earliest_time) as min_date_year,
			extract(YEAR from latest_time) as max_date_year
			from CWMS_V_TS_EXTENTS_LOCAL local
			join CWMS_V_LOC_GRP_ASSGN grp on 
				local.location_id = grp.location_id
				inner join CWMS_V_LOC_GRP_ASSGN grp2 on
				local.location_id = grp2.location_id
			where local.ts_id like '%Inst.~1Day.0.datman-rev' 
				and grp.category_id = 'RDL_Basins' 
				and grp2.category_id = 'RDL_MVS'
				and grp.group_id = '".$basin."'
				and grp2.group_id = 'MVS'
			order by basin,location_id";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"location_id" => $row['LOCATION_ID'],
				"ts_code" => $row['TS_CODE'],
				"parameter_id" => $row['PARAMETER_ID'],
				"basin" => $row['BASIN'],
				"min_date_year" => $row['MIN_DATE_YEAR'],
				"max_date_year" => $row['MAX_DATE_YEAR']
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
function find_mvs_download_dss_location($db) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "select location_id, location_code
		from (select cga.category_id, cga.group_id, loc.location_id, loc.location_code
			from cwms_v_loc loc
			inner join cwms_v_loc_grp_assgn cga on
					   cga.location_id=loc.location_id
			where
					loc.db_office_id = 'MVS'
					and unit_system = 'EN'
					and cga.category_id = 'RDL_MVS'
					and cga.group_id = 'MVS'
		
		)
		where location_id not in ('La Grange LD','Lk Shelbyville','Mark Twain Lk','Mel Price LD','Nav LD','Nav Pool','Rend Lk','ReReg','Shelbyville Lk','Wappapello Lk','Carlyle Lk')
		order by location_id asc";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			
			$obj = (object) [
				"location_id" => $row['LOCATION_ID'],
				"location_code" => $row['LOCATION_CODE']
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
function find_yearly_min_rdl($db, $cwms_ts_id, $year) {
	$stmnt_query = null;
	$data = null;
	
	try {		
		$sql = "select date_time, value as min_value, quality_code from table(rdl.timeseries.getReportDataByType ('TS_AGG_MIN', '".$cwms_ts_id."', 
		to_date('01-01-'|| '".$year."' || ' 00:01' ,'mm-dd-yyyy hh24:mi'),
		to_date('12-31-' || '".$year."' || ' 23.59' ,'mm-dd-yyyy hh24:mi'),
		null,--time_interval for example: TS_SNAP = 60 or 1 hour 
		null,--time_offset for example: 0,-8640 or 1400 or 0,-14400 for example: SNAPTOD 08:00
		null,--group_function goes with data_type = TIME_SERIES for example: MIN, MAX, AVG
		null,--group_interval goes with data_type = TIME_SERIES for example: DAY, MONTH, YEAR 
		'ft',--unit 
		'MVS',--office_id 
		'US/Central')--timezone
		)";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			
			$data = (object) [
				"date_time" => $row['DATE_TIME'],
				"min_value" => $row['MIN_VALUE'],
				"quality_code" => $row['QUALITY_CODE']
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
function find_yearly_min($db, $cwms_ts_id, $year) {
	$stmnt_query = null;
	$data = null;
	
	try {		
		$sql = "SELECT MIN(value) AS min_value
				FROM cwms_v_tsv_dqu
				WHERE cwms_ts_id = '".$cwms_ts_id."'
				and unit_id = 'ft'
				and EXTRACT(YEAR FROM date_time) = ".$year."";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			
			$data = (object) [
				"min_value" => $row['MIN_VALUE']
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
function find_yearly_max_rdl($db, $cwms_ts_id, $year) {
	$stmnt_query = null;
	$data = null;
	
	try {		
		$sql = "select date_time, value as max_value, quality_code from table(rdl.timeseries.getReportDataByType ('TS_AGG_MAX', '".$cwms_ts_id."', 
				to_date('01-01-'|| '".$year."' || ' 00:01' ,'mm-dd-yyyy hh24:mi'),
				to_date('12-31-' || '".$year."' || ' 23.59' ,'mm-dd-yyyy hh24:mi'),
				null,--time_interval for example: TS_SNAP = 60 or 1 hour 
				null,--time_offset for example: 0,-8640 or 1400 or 0,-14400 for example: SNAPTOD 08:00
				null,--group_function goes with data_type = TIME_SERIES for example: MIN, MAX, AVG
				null,--group_interval goes with data_type = TIME_SERIES for example: DAY, MONTH, YEAR 
				'ft',--unit 
				'MVS',--office_id 
				'US/Central')--timezone
				)";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$data = (object) [
				"date_time" => $row['DATE_TIME'],
				"max_value" => $row['MAX_VALUE'],
				"quality_code" => $row['QUALITY_CODE']
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
function find_yearly_max($db, $cwms_ts_id, $year) {
	$stmnt_query = null;
	$data = null;
	
	try 
	{		
		$sql = "SELECT MAX(value) AS max_value
				FROM cwms_v_tsv_dqu
				WHERE cwms_ts_id = '".$cwms_ts_id."'
				and unit_id = 'ft'
				--and EXTRACT(YEAR FROM (cwms_util.change_timezone(date_time, 'UTC', 'CST6CDT'))) = ".$year."
				and EXTRACT(YEAR FROM date_time) = ".$year."
				";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			
			$data = (object) [
				"max_value" => $row['MAX_VALUE']
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
