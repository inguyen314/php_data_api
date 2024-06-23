<?php
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function find_rating_coe_table($db, $location_id) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "select location_id, template_id, version, effective_date, rating_id, create_date, round(cwms_util.convert_units(ind_value_1, 'm', 'ft'),2) as stage , round(cwms_util.convert_units(dep_value, 'cms', 'cfs'),0) as flow
		from CWMS_20.AV_RATING_VALUES
		join CWMS_V_RATING on
		CWMS_20.AV_RATING_VALUES.rating_code=CWMS_V_RATING.rating_code
		where CWMS_20.AV_RATING_VALUES.rating_code = (select rating_code from CWMS_V_RATING
			where location_id = '" . $location_id . "'
				and version = 'Production'
				and template_id like '%COE'
				and template_id like 'Stage%' 
				and template_id like '%Flow%'
				and template_id not like '%Flow-%'
				and template_id not like '%,%'   
			order by effective_date desc
			FETCH FIRST 1 ROWS ONLY
				)
			and location_id not like '%0%'
			and aliased_item is null
		order by ind_value_1 desc";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$obj = (object) [
				"location_id" => $row['LOCATION_ID'],
				"template_id" => $row['TEMPLATE_ID'],
				"version" => $row['VERSION'],
				"effective_date" => $row['EFFECTIVE_DATE'],
				"rating_id" => $row['RATING_ID'],
				"create_date" => $row['CREATE_DATE'],
				"stage" => $row['STAGE'],
				"flow" => $row['FLOW']			
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
function find_rating_usgs_table($db, $location_id) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "select location_id, template_id, version, effective_date, rating_id, create_date, round(cwms_util.convert_units(ind_value_1, 'm', 'ft'),2) as stage , round(cwms_util.convert_units(dep_value, 'cms', 'cfs'),0) as flow
		from CWMS_20.AV_RATING_VALUES
		join CWMS_V_RATING on
		CWMS_20.AV_RATING_VALUES.rating_code=CWMS_V_RATING.rating_code
		where CWMS_20.AV_RATING_VALUES.rating_code = (select rating_code from CWMS_V_RATING
			where location_id = '" . $location_id . "'
				and version = 'Production'
				and template_id like '%USGS'
				and template_id like 'Stage%' 
				and template_id like '%Flow%'
				and template_id not like '%Flow-%'
				and template_id not like '%,%'   
			order by effective_date desc
			FETCH FIRST 1 ROWS ONLY
				)
			and location_id not like '%0%'
			and aliased_item is null
		order by ind_value_1 desc";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			
			$obj = (object) [
				"location_id" => $row['LOCATION_ID'],
				"template_id" => $row['TEMPLATE_ID'],
				"version" => $row['VERSION'],
				"effective_date" => $row['EFFECTIVE_DATE'],
				"rating_id" => $row['RATING_ID'],
				"create_date" => $row['CREATE_DATE'],
				"stage" => $row['STAGE'],
				"flow" => $row['FLOW']			
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
function find_rating_nws_table($db, $location_id) {
	$stmnt_query = null;
	$data = [];
	
	try {		
		$sql = "select location_id, template_id, version, effective_date, rating_id, create_date, round(cwms_util.convert_units(ind_value_1, 'm', 'ft'),2) as stage , round(cwms_util.convert_units(dep_value, 'cms', 'cfs'),0) as flow
		from CWMS_20.AV_RATING_VALUES
		join CWMS_V_RATING on
		CWMS_20.AV_RATING_VALUES.rating_code=CWMS_V_RATING.rating_code
		where CWMS_20.AV_RATING_VALUES.rating_code = (select rating_code from CWMS_V_RATING
			where location_id = '" . $location_id . "'
				and version = 'Production'
				and template_id like '%NWS'
				and template_id like 'Stage%' 
				and template_id like '%Flow%'
				and template_id not like '%Flow-%'
				and template_id not like '%,%'   
			order by effective_date desc
			FETCH FIRST 1 ROWS ONLY
				)
			and location_id not like '%0%'
			and aliased_item is null
		order by ind_value_1 desc";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			
			$obj = (object) [
				"location_id" => $row['LOCATION_ID'],
				"template_id" => $row['TEMPLATE_ID'],
				"version" => $row['VERSION'],
				"effective_date" => $row['EFFECTIVE_DATE'],
				"rating_id" => $row['RATING_ID'],
				"create_date" => $row['CREATE_DATE'],
				"stage" => $row['STAGE'],
				"flow" => $row['FLOW']			
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
