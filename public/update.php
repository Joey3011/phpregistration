<?php
require __DIR__ . '/../src/bootstrap.php';
?>
<?php
    $id = $_POST['id'];
    $movie = $_POST['movie'];
    $actor = $_POST['actor'];
    $actress = $_POST['actress'];
    $hobby = $_POST['hobby'];
if($id != "" && $movie != "" && $actor != "" && $actress != "" && $hobby != "" ){
try{
    $sql = 'UPDATE favorite SET 
    movie = "'.$movie.'",
    actor = "'.$actor.'",
    actress = "'.$actress.'",
    hobby = "'.$hobby.'"
    WHERE id = :id';
    $statement = db()->prepare($sql);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $result =  $statement->execute();
        if($result){
            echo json_encode(array("statusCode"=>200));
        }
    }catch(PDOException $e)  {
            echo $e;
    } 
}else{
    echo json_encode(array("statusCode"=>201));
}
?>