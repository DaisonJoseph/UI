<?php
$getData = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
// print_r($getData);
$tableName = $getData['table_name'];
						header("Content-type: text/plain");
						header("Content-Disposition: attachment; filename=TableInterface_".$tableName.".csv");
						$m = new MongoClient();
						$db = $m->cap360;
						$db2  = $db->crud;
						$crudDatas = array();
						// $tableName = "TSWH_WKLY_CALC_HR";
						// // $tableName = "PRD_PRODUCTS";
						$crudResults = $db2->find(array('table_name' => $tableName));
						// echo $tableName."\n";
						foreach($crudResults as $crudResult)
						{
							$componentName = $crudResult['component_name'];
							$componentType = $crudResult['component_type'];
							$operation = $crudResult['operation'];
							// $totalOperations[] = $operation;
							$totalComponents[] = $operation."|".$componentName."|".$componentType;
						}
							
							$componentCounts = array_count_values($totalComponents);
							foreach ($componentCounts as $uniqueComponent => $componentCount)
							{
								$consolidated = $uniqueComponent."|".$componentCount;
								$crudDatas[] = $consolidated;
							}
							$crudDatas=array_unique($crudDatas);
						
						$out = "Table Name,Operation,Component Name,Component Type,No of Queries" ;
						echo $out . "\r\n";
							
						foreach ($crudDatas as $crudData) {
							$exploded = explode("|",$crudData);
							
							$out = $tableName . "," . $exploded[0] . "," . $exploded[1] . "," . $exploded[2] . "," . $exploded[3];
							echo $out . "\r\n";
						}
						
?>