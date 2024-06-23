<?php
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_precip_data_inc_cum($db, $cwms_ts_id) {
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
					where cwms_ts_id = '".$cwms_ts_id."'
					and unit_id = 'in'
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
					where cwms_ts_id = '".$cwms_ts_id."'
					and unit_id = 'in'
					and date_time = to_date((select (date_time - interval '6' hour) from cte_last_max) ,'mm-dd-yyyy hh24:mi:ss')
					order by date_time desc
					fetch first 1 rows only
				),
				cte_12_hr as (
					select ts_code, 
						date_time, 
						cwms_ts_id, 
						cwms_util.split_text(cwms_ts_id, 1, '.') as location_id, 
						cwms_util.split_text(cwms_ts_id, 2, '.') as parameter_id, 
						value as value_12_hr, 
						unit_id, 
						quality_code
					from CWMS_20.AV_TSV_DQU_30D
					where cwms_ts_id = '".$cwms_ts_id."'
					and unit_id = 'in'
					and date_time = to_date((select (date_time - interval '12' hour) from cte_last_max) ,'mm-dd-yyyy hh24:mi:ss')
					order by date_time desc
					fetch first 1 rows only
				),
				cte_18_hr as (
					select ts_code, 
						date_time, 
						cwms_ts_id, 
						cwms_util.split_text(cwms_ts_id, 1, '.') as location_id, 
						cwms_util.split_text(cwms_ts_id, 2, '.') as parameter_id, 
						value as value_18_hr, 
						unit_id, 
						quality_code
					from CWMS_20.AV_TSV_DQU_30D
					where cwms_ts_id = '".$cwms_ts_id."'
					and unit_id = 'in'
					and date_time = to_date((select (date_time - interval '18' hour) from cte_last_max) ,'mm-dd-yyyy hh24:mi:ss')
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
					where cwms_ts_id = '".$cwms_ts_id."'
					and unit_id = 'in'
					and date_time = to_date((select (date_time - interval '24' hour) from cte_last_max) ,'mm-dd-yyyy hh24:mi:ss')
					order by date_time desc
					fetch first 1 rows only
				),
				cte_30_hr as (
					select ts_code, 
						date_time, 
						cwms_ts_id, 
						cwms_util.split_text(cwms_ts_id, 1, '.') as location_id, 
						cwms_util.split_text(cwms_ts_id, 2, '.') as parameter_id, 
						value as value_30_hr, 
						unit_id, 
						quality_code
					from CWMS_20.AV_TSV_DQU_30D
					where cwms_ts_id = '".$cwms_ts_id."'
					and unit_id = 'in'
					and date_time = to_date((select (date_time - interval '30' hour) from cte_last_max) ,'mm-dd-yyyy hh24:mi:ss')
					order by date_time desc
					fetch first 1 rows only
				),
				cte_36_hr as (
					select ts_code, 
						date_time, 
						cwms_ts_id, 
						cwms_util.split_text(cwms_ts_id, 1, '.') as location_id, 
						cwms_util.split_text(cwms_ts_id, 2, '.') as parameter_id, 
						value as value_36_hr, 
						unit_id, 
						quality_code
					from CWMS_20.AV_TSV_DQU_30D
					where cwms_ts_id = '".$cwms_ts_id."'
					and unit_id = 'in'
					and date_time = to_date((select (date_time - interval '36' hour) from cte_last_max) ,'mm-dd-yyyy hh24:mi:ss')
					order by date_time desc
					fetch first 1 rows only
				),
				cte_42_hr as (
					select ts_code, 
						date_time, 
						cwms_ts_id, 
						cwms_util.split_text(cwms_ts_id, 1, '.') as location_id, 
						cwms_util.split_text(cwms_ts_id, 2, '.') as parameter_id, 
						value as value_42_hr, 
						unit_id, 
						quality_code
					from CWMS_20.AV_TSV_DQU_30D
					where cwms_ts_id = '".$cwms_ts_id."'
					and unit_id = 'in'
					and date_time = to_date((select (date_time - interval '42' hour) from cte_last_max) ,'mm-dd-yyyy hh24:mi:ss')
					order by date_time desc
					fetch first 1 rows only
				),
				cte_48_hr as (
					select ts_code, 
						date_time, 
						cwms_ts_id, 
						cwms_util.split_text(cwms_ts_id, 1, '.') as location_id, 
						cwms_util.split_text(cwms_ts_id, 2, '.') as parameter_id, 
						value as value_48_hr, 
						unit_id, 
						quality_code
					from CWMS_20.AV_TSV_DQU_30D
					where cwms_ts_id = '".$cwms_ts_id."'
					and unit_id = 'in'
					and date_time = to_date((select (date_time - interval '48' hour) from cte_last_max) ,'mm-dd-yyyy hh24:mi:ss')
					order by date_time desc
					fetch first 1 rows only
				),
				cte_54_hr as (
					select ts_code, 
						date_time, 
						cwms_ts_id, 
						cwms_util.split_text(cwms_ts_id, 1, '.') as location_id, 
						cwms_util.split_text(cwms_ts_id, 2, '.') as parameter_id, 
						value as value_54_hr, 
						unit_id, 
						quality_code
					from CWMS_20.AV_TSV_DQU_30D
					where cwms_ts_id = '".$cwms_ts_id."'
					and unit_id = 'in'
					and date_time = to_date((select (date_time - interval '54' hour) from cte_last_max) ,'mm-dd-yyyy hh24:mi:ss')
					order by date_time desc
					fetch first 1 rows only
				),
				cte_60_hr as (
					select ts_code, 
						date_time, 
						cwms_ts_id, 
						cwms_util.split_text(cwms_ts_id, 1, '.') as location_id, 
						cwms_util.split_text(cwms_ts_id, 2, '.') as parameter_id, 
						value as value_60_hr, 
						unit_id, 
						quality_code
					from CWMS_20.AV_TSV_DQU_30D
					where cwms_ts_id = '".$cwms_ts_id."'
					and unit_id = 'in'
					and date_time = to_date((select (date_time - interval '60' hour) from cte_last_max) ,'mm-dd-yyyy hh24:mi:ss')
					order by date_time desc
					fetch first 1 rows only
				),
				cte_66_hr as (
					select ts_code, 
						date_time, 
						cwms_ts_id, 
						cwms_util.split_text(cwms_ts_id, 1, '.') as location_id, 
						cwms_util.split_text(cwms_ts_id, 2, '.') as parameter_id, 
						value as value_66_hr, 
						unit_id, 
						quality_code
					from CWMS_20.AV_TSV_DQU_30D
					where cwms_ts_id = '".$cwms_ts_id."'
					and unit_id = 'in'
					and date_time = to_date((select (date_time - interval '66' hour) from cte_last_max) ,'mm-dd-yyyy hh24:mi:ss')
					order by date_time desc
					fetch first 1 rows only
				),
				cte_72_hr as (
					select ts_code, 
						date_time, 
						cwms_ts_id, 
						cwms_util.split_text(cwms_ts_id, 1, '.') as location_id, 
						cwms_util.split_text(cwms_ts_id, 2, '.') as parameter_id, 
						value as value_72_hr, 
						unit_id, 
						quality_code
					from CWMS_20.AV_TSV_DQU_30D
					where cwms_ts_id = '".$cwms_ts_id."'
					and unit_id = 'in'
					and date_time = to_date((select (date_time - interval '72' hour) from cte_last_max) ,'mm-dd-yyyy hh24:mi:ss')
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
					cte_6_hr.value_6_hr as value_6,
					cte_6_hr.date_time as date_time_6,  
					cte_12_hr.value_12_hr as value_12,
					cte_12_hr.date_time as date_time_12,
					cte_18_hr.value_18_hr as value_18,
					cte_18_hr.date_time as date_time_18,  
					cte_24_hr.value_24_hr as value_24,
					cte_24_hr.date_time as date_time_24, 
					cte_30_hr.value_30_hr as value_30,
					cte_30_hr.date_time as date_time_30,
					cte_36_hr.value_36_hr as value_36,
					cte_36_hr.date_time as date_time_36,
					cte_42_hr.value_42_hr as value_42,
					cte_42_hr.date_time as date_time_42,
					cte_48_hr.value_48_hr as value_48,
					cte_48_hr.date_time as date_time_48, 
					cte_54_hr.value_54_hr as value_54,
					cte_54_hr.date_time as date_time_54,
					cte_60_hr.value_60_hr as value_60,
					cte_60_hr.date_time as date_time_60,
					cte_66_hr.value_66_hr as value_66,
					cte_66_hr.date_time as date_time_66,
					cte_72_hr.value_72_hr as value_72,
					cte_72_hr.date_time as date_time_72
				from cte_last_max last_max
					left join cte_6_hr cte_6_hr
					on last_max.cwms_ts_id = cte_6_hr.cwms_ts_id
						left join cte_12_hr cte_12_hr
						on last_max.cwms_ts_id = cte_12_hr.cwms_ts_id
							left join cte_18_hr cte_18_hr
							on last_max.cwms_ts_id = cte_18_hr.cwms_ts_id
								left join cte_24_hr cte_24_hr
								on last_max.cwms_ts_id = cte_24_hr.cwms_ts_id
									left join cte_30_hr cte_30_hr
									on last_max.cwms_ts_id = cte_30_hr.cwms_ts_id
										left join cte_36_hr cte_36_hr
										on last_max.cwms_ts_id = cte_36_hr.cwms_ts_id
											left join cte_42_hr cte_42_hr
											on last_max.cwms_ts_id = cte_42_hr.cwms_ts_id
												left join cte_48_hr cte_48_hr
												on last_max.cwms_ts_id = cte_48_hr.cwms_ts_id
													left join cte_54_hr cte_54_hr
													on last_max.cwms_ts_id = cte_54_hr.cwms_ts_id
														left join cte_60_hr cte_60_hr
														on last_max.cwms_ts_id = cte_60_hr.cwms_ts_id
															left join cte_66_hr cte_66_hr
															on last_max.cwms_ts_id = cte_66_hr.cwms_ts_id
																left join cte_72_hr cte_72_hr
																on last_max.cwms_ts_id = cte_72_hr.cwms_ts_id";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
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
				"value_6" => $row['VALUE_6'],
				"date_time_6" => $row['DATE_TIME_6'],
				"value_12" => $row['VALUE_12'],
				"date_time_12" => $row['DATE_TIME_12'],
				"value_18" => $row['VALUE_18'],
				"date_time_18" => $row['DATE_TIME_18'],
				"value_24" => $row['VALUE_24'],
				"date_time_24" => $row['DATE_TIME_24'],
				"value_30" => $row['VALUE_30'],
				"date_time_30" => $row['DATE_TIME_30'],
				"value_36" => $row['VALUE_36'],
				"date_time_36" => $row['DATE_TIME_36'],
				"value_42" => $row['VALUE_42'],
				"date_time_42" => $row['DATE_TIME_42'],
				"value_48" => $row['VALUE_48'],
				"date_time_48" => $row['DATE_TIME_48'],
				"value_54" => $row['VALUE_54'],
				"date_time_54" => $row['DATE_TIME_54'],
				"value_60" => $row['VALUE_60'],
				"date_time_60" => $row['DATE_TIME_60'],
				"value_66" => $row['VALUE_66'],
				"date_time_66" => $row['DATE_TIME_66'],
				"value_72" => $row['VALUE_72'],
				"date_time_72" => $row['DATE_TIME_72']
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
