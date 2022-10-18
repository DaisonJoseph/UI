<?php
$m = new MongoClient();
$db = $m->aflac;
$mi_col  = $db->masterinventory;
$nc_mi_col  = $db->nc_masterinventory;
$Xref_col  = $db->crossreference;
$missing_comp_col  = $db->missing;
$db2TablesSingleOperation = $db->db2TableWithSingleOperation;
$imsTablesSingleOperation = $db->imsTableWithSingleOperation;
$singletonCol = $db->singleton;
$filesCreatedNotUsed = $db->filesCreatedButNotUsed;
$ftpCol = $db->ftpInterface;
$filesInvCol = $db->fileInventory;
$rmdsCol = $db->rmdsJcl;
$printerCol = $db->printer;
$mqCol = $db->mq;
$emailCol = $db->emailInterface;

$imsOrphan = $db->imsOrphan;
$db2Orphan = $db->db2Orphan;
$load = $db->load;
$loadDistinct = $load->distinct("component_name");
$loadCount = count($loadDistinct);
$unload = $db->unload;
$unloadDistinct = $unload->distinct("component_name");
$unloadCount = count($unloadDistinct);
// echo $unloadCount."--";
$tdqCol = $db->tdq;
$tsqCol = $db->tsq;
$tdqDistict = $tdqCol->distinct("tdq_name");
$tdqDistictCount = count($tdqDistict);
$tdqScopeCount = 0;
// foreach($tdqDistict as $tdqDist)
// {
// // print_r($tdqDist);
// if($tdqDist['scope'] == "IN SCOPE")
// {
// echo $tdqDist['tdq_name'];
// $tdqScopeCount++;
// }
// }
$tsqDistict = $tsqCol->distinct("tsq_name");
$tsqDistictCount = count($tsqDistict);
$tsqScopeCount = 0;
// foreach($tsqDistict as $tsqDist)
// {
// if($tsqDist['scope'] == "IN SCOPE")
// {
// $tsqScopeCount++;
// }
// }


$java_count = $nc_mi_col->find(array("component_type" => "JAVA"))->count();
$datastage_count = $nc_mi_col->find(array("component_type" => "DATA STAGE"))->count();
$mq_count = $mqCol->count();
$ftp_count = $ftpCol->count();
$filesInvDis = $filesInvCol->distinct("file_name");
$filesInvColCount = count($filesInvDis);
$rmds_count = $rmdsCol->count();
$printerCount = $printerCol->count();
$email_count = $emailCol->count();
$components_count = $mi_col->count();
$inscopecomponents_count = $mi_col->find(array("app_owner_name" => "Hutto, Amy"))->count();

$loc_count_agg =  $mi_col->aggregate(array('$match' => array("app_owner_name" => "Hutto, Amy")), array('$group' => array('_id' => 'null', 'Total_Loc' => array('$sum' => '$tloc'))));
$loc_count = $loc_count_agg['result'][0]['Total_Loc'];


$loc_count_entire_agg =  $mi_col->aggregate(array('$group' => array('_id' => 'null', 'Total_Loc' => array('$sum' => '$tloc'))));
$loc_count_dump = $loc_count_entire_agg['result'][0]['Total_Loc'];

$activeTrans_count = $mi_col->find(array("component_type" => "TRANSACTION", "dead" => "No"))->count();
#$InactiveTrans_count = $Transaction_col->find(array("Status"=>"Inactive"))->count();
$InactiveTrans_count = $mi_col->find(array("component_type" => "TRANSACTION", "dead" => "Yes"))->count();

$active_jcl = $mi_col->find(array("component_type" => "JCL", "dead" => "No"))->count();
$inactive_jcl = $mi_col->find(array("component_type" => "JCL", "dead" => "Yes"))->count();

$orphan_count = $mi_col->find(array("orphan" => "Yes"))->count();
$orphan_component_percentage = round(($orphan_count / $components_count) * 100, 2);

$drop_impact_count = $mi_col->find(array("drop_impact" => "Yes"))->count();
$drop_impact_component_percentage = round(($drop_impact_count / $components_count) * 100, 2);

$dead_count = $mi_col->find(array("dead" => "Yes"))->count();
$dead_component_percentage = round(($dead_count / $components_count) * 100, 2);

$scope_loc_agg =  $mi_col->aggregate(array('$match' => array("app_owner_name" => "Hutto, Amy")), array('$group' => array('_id' => 'null', 'Scope_Loc' => array('$sum' => '$tloc'))));
$scope_loc_count = $scope_loc_agg['result'][0]['Scope_Loc'];

$orphan_loc_agg =  $mi_col->aggregate(array('$match' => array("orphan" => "Yes", "app_owner_name" => "Hutto, Amy")), array('$group' => array('_id' => 'null', 'Orphan_Loc' => array('$sum' => '$tloc'))));
$orphan_loc_count = $orphan_loc_agg['result'][0]['Orphan_Loc'];

$dead_loc_agg =  $mi_col->aggregate(array('$match' => array("dead" => "Yes", "app_owner_name" => "Hutto, Amy")), array('$group' => array('_id' => 'null', 'Dead_Loc' => array('$sum' => '$tloc'))));
$dead_loc_count = $dead_loc_agg['result'][0]['Dead_Loc'];

$dropImpact_loc_agg =  $mi_col->aggregate(array('$match' => array("drop_impact" => "Yes", "app_owner_name" => "Hutto, Amy")), array('$group' => array('_id' => 'null', 'Drop_Impact' => array('$sum' => '$tloc'))));
$dropImpact_loc_count = $dropImpact_loc_agg['result'][0]['Drop_Impact'];

$loc_count_jcl =  $mi_col->aggregate(array('$match' => array("component_type" => "JCL")), array('$group' => array('_id' => 'null', 'Total_Loc' => array('$sum' => '$tloc'))));
$loc_count_jcl = $loc_count_jcl['result'][0]['Total_Loc'];
$total_percentage = number_format(((($orphan_loc_count + $dead_loc_count + $dropImpact_loc_count) / ($loc_count)) * 100), 2);

echo $orphan_loc_count . "->Orphan\n";
echo $dead_loc_count . "->Dead\n";
echo $dropImpact_loc_count . "->Drop\n";
echo $orphan_loc_count + $dead_loc_count + $dropImpact_loc_count . "->Total\n";
echo $total_percentage . "->Percent\n";
// $total_percentage = 0;

$missing_count = $missing_comp_col->count();


$db2TablesSingleOperationDistict = $db2TablesSingleOperation->distinct("table_name");
$db2TablesSingleOperationCount = count($db2TablesSingleOperationDistict);
$imsTablesSingleOperationCount = $imsTablesSingleOperation->count();
$filesCreatedNotUsedCount = $filesCreatedNotUsed->count();


$totalJclCount = $mi_col->find(array("component_type" => "JCL"))->count();
$totalScopeJclCount = $mi_col->find(array("component_type" => "JCL", "app_owner_name" => "Hutto, Amy"))->count();

$totalTransCount = $mi_col->find(array("component_type" => "TRANSACTION"))->count();
$totalScopeTransCount = $mi_col->find(array("component_type" => "TRANSACTION", "app_owner_name" => "Hutto, Amy"))->count();



$totalCicsTransactionCount = $mi_col->find(array("component_type" => "CICS_TRANSACTION"))->count();
$totalImsTransactionCount = $mi_col->find(array("component_type" => "IMS_TRANSACTION"))->count();
$totalScopeCicsTransactionCount = $mi_col->find(array("component_type" => "CICS_TRANSACTION", "scope" => "IN SCOPE"))->count();
$totalScopeImsTransactionCount = $mi_col->find(array("component_type" => "IMS_TRANSACTION", "scope" => "IN SCOPE"))->count();

$db2OrphanCount = $db2Orphan->count();
$imsOrphanCount = $imsOrphan->count();


$imsCrud = $db->imsCrud;
$imsunique = $imsCrud->distinct("segment_name");
$imsSegmentcount = count($imsunique);

$db2Crud = $db->crud;
$crudOperations = $db2Crud->count();


$db2unique = $db2Crud->distinct("table_name");
$readCount = $db2Crud->find(array("operation" => "READ"))->count();
$insertCount = $db2Crud->find(array("operation" => "INSERT"))->count();
$updateCount = $db2Crud->find(array("operation" => "UPDATE"))->count();
$deleteCount = $db2Crud->find(array("operation" => "DELETE"))->count();

$fileCrud = $db->file_crud;
$readFileCount = $fileCrud->find(array("read" => "Yes"))->count();
$insertFileCount = $fileCrud->find(array("write" => "Yes"))->count();
$updateFileCount = $fileCrud->find(array("rewrite" => "Yes"))->count();
$deleteFileCount = $fileCrud->find(array("delete" => "Yes"))->count();

$readImsCount = $imsCrud->find(array("operation" => "READ"))->count();
$insertImsCount = $imsCrud->find(array("operation" => "INSERT"))->count();
$updateImsCount = $imsCrud->find(array("operation" => "UPDATE"))->count();
$deleteImsCount = $imsCrud->find(array("operation" => "DELETE"))->count();

$db2TablesSingleOperation = $singletonCol->count();
$db2TablesSingleOperationDistict = $singletonCol->distinct("table_name");
$db2TablesSingleOperationCount = count($db2TablesSingleOperationDistict);
$singleReadArray = $singletonCol->find(array("operation" => "READ"));
$singleInsertArray = $singletonCol->find(array("operation" => "INSERT"));
$singleUpdateArray = $singletonCol->find(array("operation" => "UPDATE"));
$singleDeleteArray = $singletonCol->find(array("operation" => "DELETE"));
$singleReadCount = distinctOnMultipleFields($singleReadArray, "table_name");
$singleInsertCount = distinctOnMultipleFields($singleInsertArray, "table_name");
$singleUpdateCount = distinctOnMultipleFields($singleUpdateArray, "table_name");
$singleDeleteCount = distinctOnMultipleFields($singleDeleteArray, "table_name");
// echo $singleInsertCount;

// echo count($db2unique);
$db2TablesCount = count($db2unique);


$filesCount = $Xref_col->find(array("called_component_type" => "FILE"))->count();
function distinctOnMultipleFields($arrays, $field)
{
     foreach ($arrays as $array) {
          $tableName[] = $array[$field];
     }
     $tableName = array_unique($tableName);
     return count($tableName);
}

// $emailCol = $db->email_report;
$emailCount = $db->email_report->count();
$ftpCount = $db->ftp_report->count();
$mqCount = $db->mq_report->count();
// echo $emailCount;

$fileCrudCount = $db->file_crud->count();
