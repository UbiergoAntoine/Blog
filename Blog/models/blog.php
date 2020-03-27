<?php
class BlogModel extends Model {

    
    public function getUserInfo($id_user)  
    {
        $conn = $this->getConnection();
        $sql = 'SELECT * FROM personne WHERE Id = ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($id_user));

        if($stmt->rowCount() > 0){
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        else{
            $result = false;
        }
        return $result;
    }

}
   