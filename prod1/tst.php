<?php
											$m = new MongoClient();
											$db = $m->damm_it_db;
											$coveragerpt = $db->coveragerpt;
											$results = $coveragerpt->find();
											echo "$count<br>";
											foreach($results as $document)
											{
												print_r($document);
											
											}
											?>