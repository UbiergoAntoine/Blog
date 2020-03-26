
<?php
require('controllers/controller.php');

$request = $_SERVER['REQUEST_URI'];
$controllers = new Controller();
$reslt = $controllers->model->Login();
$pathProject = "/AFIP/Blog/Blog";

if(isset($_GET['url'])){
    $url = explode("/",$_GET['url']);
}

// if(isset($reslt)){
//     if($user["response"] == "OK"){

if(isset($reslt) && $reslt != false && $reslt["response"] == "OK") {
    if (isset($_GET['action'])) {
        switch($_GET['action']){
            case "listPosts":
                listPosts();
            break;
            case "login":
                include './views/indexView.php';
            break;
            case "visitor":
                include './view/indexVisitorView.php';
            break;
            case "post":
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    post();
                }
                else {
                    echo 'Erreur : aucun identifiant de billet envoyé';
                }
            break;
            case "addArticle":
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                        addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                    }
                    else {
                        echo 'Erreur : tous les champs ne sont pas remplis !';
                    }
                }
                else {
                    echo 'Erreur : aucun identifiant de billet envoyé';
                }
            break;
        }
    }
    else {
        switch ($request) {
            case $pathProject.'/' :
                include './views/indexView.php';
                break;
            case $pathProject.'' :
                include './views/indexView.php';
                break;
            case $pathProject.'/logout' :
                include './views/loginView.php';
                break;
            case $pathProject.'/accueil' :
                include './views/indexView.php';
                break;
            case $pathProject.'/planCoupe' :
                require __DIR__ . '/pages/planCoupe.php';
                break;
            default:
                http_response_code(404);
                require __DIR__ . '/pages/404.php';
                break;
        }
    }
} else {
    if (isset($_GET['action'])) {
        if($_GET['action'] == "visitor"){
            include 'views/indexVisitorView.php';
            unset($_GET['action']);
        }
        if($_GET['action'] == "login"){
            include './views/loginView.php';
            unset($_GET['action']);
        }
    } else {
        include 'views/loginView.php';
        unset($_GET['action']);
    }
}

?>

<?php
// session_start();
// if(isset($_POST["login"]) && isset($_POST["password"])) {
//     $result = "";
//     $conn = "";
//     try{
//         $conn = new PDO("mysql:host=localhost;dbname=master_eil", "root", "");
//         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
//     }catch(PDOException $exception){
//         error_log("Connection error: " . $exception->getMessage());
//     }

//     $sql = "SELECT * FROM Personne WHERE Email = ? AND MotDePasse = ?";

//     $stmt = $conn->prepare($sql);
    
//     $stmt -> bindParam(1, $_POST["login"], PDO::PARAM_STR);
//     $stmt -> bindParam(2, md5($_POST["password"]), PDO::PARAM_STR);

//     $stmt -> execute();

//     if($stmt->rowCount() > 0){
//         $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     }
//     else{
        
//         $result = false;
        
//     }
//     if($result != false){
//         $_SESSION["auth"] = $result;
//     } else {
//         $_SESSION["auth"] = null;
//     }

//     if($_SESSION["auth"] != null){
//         header('Location: formulaire.php');
//     }
// }

?>