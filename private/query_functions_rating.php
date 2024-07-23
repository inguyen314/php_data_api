<?php
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function find_rating_coe_table($db, $location_id)
{
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

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {
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
function find_rating_usgs_table($db, $location_id)
{
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

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {

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
function find_rating_nws_table($db, $location_id)
{
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

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {

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
function find_location_level_by_basin($db, $basin, $specified_level_id)
{
	$stmnt_query = null;
	$data = [];

	try {
		$sql = "select  basin, sub_basin, location_id, elevation, vertical_datum, group_id, category_id
					,specified_level_id, constant_level, level_date, location_level_id
					,attribute_id, unit_system, attribute_unit, level_unit ,attribute_value, interval_origin, calendar_interval, time_interval
					,interpolate, calendar_offset, time_offset, seasonal_level, tsid, level_comment, attribute_comment
					,base_location_id, sub_location_id, base_parameter_id, sub_parameter_id, parameter_id, duration_id, location_code
					,location_level_code, expiration_date, parameter_type_id ,attribute_parameter_id, attribute_base_parameter_id
					,attribute_sub_parameter_id, attribute_duration_id
				from (select basins.group_id as basin, basins.sub_location_id as sub_basin
					,cga.category_id, cga.group_id
					,loc.location_id, loc.elevation, loc.vertical_datum
					,ctl.specified_level_id, ctl.constant_level, ctl.level_date, ctl.location_level_id
					,ctl.attribute_id, ctl.unit_system
					,ctl.attribute_unit, ctl.level_unit, ctl.attribute_value, ctl.interval_origin, ctl.calendar_interval, ctl.time_interval
					,ctl.interpolate, ctl.calendar_offset ,ctl.time_offset, ctl.seasonal_level, ctl.tsid, ctl.level_comment
					,ctl.attribute_comment, ctl.base_location_id, ctl.sub_location_id, ctl.base_parameter_id, ctl.sub_parameter_id
					,ctl.parameter_id ,ctl.duration_id, ctl.location_code, ctl.location_level_code, ctl.expiration_date ,ctl.parameter_type_id
					,ctl.attribute_parameter_id, ctl.attribute_base_parameter_id, ctl.attribute_sub_parameter_id, ctl.attribute_duration_id
					FROM cwms_v_loc loc
					inner join CWMS_V_LOC_GRP_ASSGN cga on
							   cga.location_id=loc.location_id
					inner join  cwms_20.av_location_level ctl on loc.location_id=ctl.location_id   
					inner join cwms_20.AV_LOC_GRP_ASSGN basins on ctl.location_id=basins.location_id
					where
							loc.db_office_id = 'MVS'
							and ctl.Unit_system = 'EN'
							and loc.Unit_system = 'EN'
							and cga.category_id = 'RDL_MVS'
							and basins.category_id='RDL_Basins'
							and specified_level_id = '" . $specified_level_id . "'
							and basins.group_id = '" . $basin . "'
							)   
				ORDER BY basin,
				location_id asc,
				calendar_offset asc";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {

			$obj = (object) [
				"basin" => $row['BASIN'],
				"sub_basin" => $row['SUB_BASIN'],
				"location_id" => $row['LOCATION_ID'],
				"elevation" => $row['ELEVATION'],
				"vertical_datum" => $row['VERTICAL_DATUM'],
				"group_id" => $row['GROUP_ID'],
				"category_id" => $row['CATEGORY_ID'],
				"specified_level_id" => $row['SPECIFIED_LEVEL_ID'],
				"constant_level" => $row['CONSTANT_LEVEL'],
				"level_date" => $row['LEVEL_DATE'],
				"location_level_id" => $row['LOCATION_LEVEL_ID'],
				"attribute_id" => $row['ATTRIBUTE_ID'],
				"unit_system" => $row['UNIT_SYSTEM'],
				"attribute_unit" => $row['ATTRIBUTE_UNIT'],
				"level_unit" => $row['LEVEL_UNIT'],
				"attribute_value" => $row['ATTRIBUTE_VALUE'],
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
				"base_location_id" => $row['BASE_LOCATION_ID'],
				"sub_location_id" => $row['SUB_LOCATION_ID'],
				"base_parameter_id" => $row['BASE_PARAMETER_ID'],
				"sub_parameter_id" => $row['SUB_PARAMETER_ID'],
				"parameter_id" => $row['PARAMETER_ID'],
				"duration_id" => $row['DURATION_ID'],
				"location_code" => $row['LOCATION_CODE'],
				"location_level_code" => $row['LOCATION_LEVEL_CODE'],
				"expiration_date" => $row['EXPIRATION_DATE'],
				"parameter_type_id" => $row['PARAMETER_TYPE_ID'],
				"attribute_parameter_id" => $row['ATTRIBUTE_PARAMETER_ID'],
				"attribute_base_parameter_id" => $row['ATTRIBUTE_BASE_PARAMETER_ID'],
				"attribute_sub_parameter_id" => $row['ATTRIBUTE_SUB_PARAMETER_ID'],
				"attribute_duration_id" => $row['ATTRIBUTE_DURATION_ID']
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
function find_storage($db, $location_id)
{
	$stmnt_query = null;
	$data = [];

	try {
		$sql = "select location_id
				,rating_id
				,template_id
				,version
				,effective_date
				,create_date
				,round(cwms_util.convert_units(ind_value_1, 'm', 'ft'),2) as stage
				,round(cwms_util.convert_units(dep_value, 'm3', 'ac-ft'),0) as Storage
				,round(cwms_util.convert_units(dep_value/1.9834591996927, 'm3', 'ac-ft'),0) as StorageDSF
				from CWMS_20.AV_RATING_VALUES
				join CWMS_V_RATING on
				CWMS_20.AV_RATING_VALUES.rating_code=CWMS_V_RATING.rating_code
				where CWMS_20.AV_RATING_VALUES.rating_code = (select rating_code from CWMS_V_RATING
					where location_id = '" . $location_id . "' 
						and active_flag = 'T'
						and template_id like '%Stor%' 
						and template_id like '%Stage%'
						and template_id NOT like '%SEDIMENT%'
					order by effective_date desc
					FETCH FIRST 1 ROWS ONLY
						)
					and location_id not like '%0%'
					and aliased_item is null
				order by ind_value_1 asc";

		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {

			$obj = (object) [
				//"rating_code" => $row['RATING_CODE'],
				//"parent_rating_code" => $row['PARENT_RATING_CODE'],
				//"office_id" => $row['OFFICE_ID'],
				"rating_id" => $row['RATING_ID'],
				"location_id" => $row['LOCATION_ID'],
				"template_id" => $row['TEMPLATE_ID'],
				"version" => $row['VERSION'],
				//"native_units" => $row['NATIVE_UNITS'],
				"effective_date" => $row['EFFECTIVE_DATE'],
				"create_date" => $row['CREATE_DATE'],
				//"active_flag" => $row['ACTIVE_FLAG'],
				//"formula" => $row['FORMULA'],
				//"description" => $row['DESCRIPTION'],
				//"aliased_item" => $row['ALIASED_ITEM'],
				//"loc_alias_category" => $row['LOC_ALIAS_CATEGORY'],
				//"loc_alias_group" => $row['LOC_ALIAS_GROUP'],
				//"database_units" => $row['DATABASE_UNITS'],
				//"rating_spec_code" => $row['RATING_SPEC_CODE'],
				//"template_code" => $row['TEMPLATE_CODE'],
				"stage" => $row['STAGE'],
				"storage" => $row['STORAGE'],
				"storagedsf" => $row['STORAGEDSF']
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