<?php
$m = new MongoClient();
$db = $m->euroclear;
$mi_col  = $db->MasterInventory;
$Xref_col  = $db->Crossreference;
$missing_comp_col  = $db->MissingComponents; 
$cloned_query_col  = $db->clonedquery; 
$files_col  = $db->files_notUsed; 
$ftp_col  = $db->ftp; 
$load_source_col  = $db->loadSource; 
$static_dynamic_col  = $db->staticDynamic; 
$CRUD_col  = $db->CRUD; 
$CRUD_ops_col  = $db->CRUD_Ops;
$VSAM_col = $db->VSAM;
$QueryWindex_col = $db->QueriesWindex;
$TableWindex_col = $db->tableWindex;
$table_withIndex_count = $TableWindex_col->find(array("Table wth Index"=>"Yes"))->count();
$table_withNoIndex_count = $TableWindex_col->find(array("Table wth Index"=>"No"))->count();
$components_count = $mi_col->count();
$loc_count_agg =  $mi_col->aggregate(array('$group'=>array('_id'=>'null','Total_Loc'=>array('$sum'=>'$LLOC'))));
$loc_count = $loc_count_agg['result'][0]['Total_Loc'] ;
$orphan_count = $mi_col->find(array("Orphan"=>"Yes"))->count();
$orphan_loc_agg =  $mi_col->aggregate(array('$match'=>array("Orphan"=>"Yes")),array('$group'=>array('_id'=>'null','Orphan_Loc'=>array('$sum'=>'$LLOC'))));
$orphan_loc_count = $orphan_loc_agg['result'][0]['Orphan_Loc'] ;
//print_r($orphan_loc_count);
$missing_count = $missing_comp_col->find(array("Result"=>"Missing Component"))->count();
$static_call = $static_dynamic_col->find(array("Type"=>"Static Call"))->count();
$dynamic_call = $static_dynamic_col->find(array("Type"=>"Dynamic Call"))->count();
$filter = array( "Source Available,Load NA" => "Load Not Available" );
$loadNA = $load_source_col->find($filter)->count();
$filter = array( "Load Available, Source NA" => "Soruce Not Available" ); // there is a type here. Need to be fixed in DB
$sourceNA = $load_source_col->find($filter)->count(); 
$files_not_used_count = sizeof($files_col->distinct("called_component_name"));
$ftp = $ftp_col->find()->count();
// read
$filter = array( "Operation" => "Read" );
$read = $CRUD_ops_col->find($filter)->count();

// insert
$filter = array( "Operation" => "Insert" );
$insert = $CRUD_ops_col->find($filter)->count(); 

// delete
$filter = array( "Operation" => "Delete" );
$delete = $CRUD_ops_col->find($filter)->count();

// Update
$filter = array( "Operation" => "Update" );
$update = $CRUD_ops_col->find($filter)->count();
$total_crud = $read+$insert+$delete+$update;
$clonedquery = $cloned_query_col->find()->count();
$vsam = $VSAM_col->find()->count();
$QueryWindex_count = $QueryWindex_col->count();
?>

