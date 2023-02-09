<?php
require __DIR__ . '/../src/bootstrap.php';
?>
<?php
    $id = $_POST['id'];
try{
    $sql = 'DELETE FROM favorite 
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
?>