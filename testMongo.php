<?php
if($_GET['find']==1) {
    findAll();
}else{
    if(isset($_SESSION['mine']) =="main"){
        insert();
        updateCollections();
        deleteSelectedItem();
    }
}
function insert(){
   // connect to mongodb
   $m = new MongoClient();
//?   echo "Connection to database successfully";
   // select a database
   $db = $m->zivami;
//   echo "Database zivami selected";
   $collection = $db->products;
//   echo "Collection selected succsessfully";
   $document = array(
       "_id" => "MongoDB",
       "category" => "database",
       "subcategory" => "Collections",
       "price" => 1000,
       "brand" => "RajSide"
   );
   $collection->insert($document);
//   echo "Document inserted successfully";

}

function findAll(){
// connect to mongodb
    $m = new MongoClient();
//echo "Connection to database successfully";
// select a database
    $db = $m->zivami;
//echo "Database zivami selected";
    $collection = $db->products;
//echo "Collection selected succsessfully";

    $cursor = $collection->find();
// iterate cursor to display title of documents
//echo($cursor);
    $outp = "[";
    foreach ($cursor as $rs) {
//    echo $document["_id"]."<br/>";
        if ($outp != "[") {
            $outp .= ",";
        }
        $outp .= '{"_id":"' . $rs["_id"] . '",';
        $outp .= '"category":"' . $rs["category"] . '",';
        $outp .= '"subcategory":"' . $rs["subcategory"] . '",';
        $outp .= '"price":"' . $rs["price"] . '",';
        $outp .= '"brand":"' . $rs["brand"] . '"}';
    }
    $outp .= "]";
    echo($outp);

}

function updateCollections(){
    // connect to mongodb
    $m = new MongoClient();
    echo "Connection to database successfully";
    // select a database
    $db = $m->zivami;
    echo "Database zivami selected";
    $collection = $db->products;
    echo "Collection selected succsessfully";

    // now update the document
    $collection->update(array("title"=>"MongoDB"), array('$set'=>array("title"=>"MongoDB Tutorial")));
    echo "Document updated successfully";
    // now display the updated document
    $cursor = $collection->find();
    // iterate cursor to display title of documents
    echo "Updated document";
    foreach ($cursor as $document) {
        echo $document["title"] . "\n";
    }
}

function deleteSelectedItem(){
    // connect to mongodb
    $m = new MongoClient();
//    echo "Connection to database successfully";
    // select a database
    $db = $m->zivami;
//    echo "Database zivami selected";
    $collection = $db->products;
//    echo "Collection selected succsessfully";

    // now remove the document
    $collection->remove(array("title"=>"MongoDB Tutorial"),false);
//    echo "Documents deleted successfully";

    // now display the available documents
    $cursor = $collection->find();
    // iterate cursor to display title of documents
    echo "Updated document";
    foreach ($cursor as $document) {
        echo $document["title"] . "\n";
    }
}