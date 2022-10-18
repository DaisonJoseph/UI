<?php
$m = new MongoClient();
$db = $m->euroclear;
$collection = $db->MasterInventory;

//total no.of components
$result = $collection->find(array("Orphan"=>"Yes"))->count();
echo "Orphan Components Count"." ".$result."<br><br>";

//total no. of component types
$types = $collection->distinct("Component_Type");
$component_type_arr = array();
foreach($types as $type){
	$value = $collection->find(array("Component_Type"=>$type,"Orphan"=>"Yes"))->count();
	$component_type_arr[$type] = $value;
}
foreach($component_type_arr as $key=>$value){
	echo "Component Type is ".$key;
	echo "and its count is ".$value."<br>";
}
echo "<br>"; 

//total lloc
$lloc_array = array();
foreach($types as  $type)
   {
		$comp_total_loc = $collection->aggregate(array('$match'=>array("Component_Type"=>$type,"Orphan"=>"Yes")),array('$group'=>array('_id'=>'null','TotalLLoc'=>array('$sum'=>'$LLOC'))));
		foreach($comp_total_loc as $c)
		{
			foreach($c as $c1)
			{
				$lloc_array[$type] = $c1['TotalLLoc'];
			}
		}
   }
 foreach($lloc_array as $key=>$value){
	echo "Component Type is ".$key;
	echo "and its LLOC count is ".$value."<br>";
 }
 
echo "<br>";

//total uloc
$uloc_array = array();
foreach($types as  $type)
   {
		$comp_total_loc = $collection->aggregate(array('$match'=>array("Component_Type"=>$type,"Orphan"=>"Yes")),array('$group'=>array('_id'=>'null','TotalLLoc'=>array('$sum'=>'$ULOC'))));
		foreach($comp_total_loc as $c)
		{
			foreach($c as $c1)
			{
				$uloc_array[$type] = $c1['TotalLLoc'];
			}
		}
   }
 foreach($uloc_array as $key=>$value){
	echo "Component Type is ".$key;
	echo "and its ULOC count is ".$value."<br>";
 }
 
echo "<br>";

//total cloc
$cloc_array = array();
foreach($types as  $type)
   {
		$comp_total_loc = $collection->aggregate(array('$match'=>array("Component_Type"=>$type,"Orphan"=>"Yes")),array('$group'=>array('_id'=>'null','TotalLLoc'=>array('$sum'=>'$CLOC'))));
		foreach($comp_total_loc as $c)
		{
			foreach($c as $c1)
			{
				$cloc_array[$type] = $c1['TotalLLoc'];
			}
		}
   }
 foreach($cloc_array as $key=>$value){
	echo "Component Type is ".$key;
	echo "and its CLOC count is ".$value."<br>";
 }
 
echo "<br>";

?>