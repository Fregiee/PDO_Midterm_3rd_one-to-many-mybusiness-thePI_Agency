    <?php
    require_once 'dbConfig.php';
    require_once 'models.php';

    if(isset($_POST['inserinvestigatorBtn'])){
        $query = insertinvestigator($pdo, $_POST['firstname'], $_POST['lastname']);
        if($query){
            header("Location: ../index.php");
        }else{
            echo "Insertion failed";
        }
    }

    if(isset($_POST['editinvestigatorbtn'])){
        $investigator_id = $_GET['investigator_id'];
        $query = updateinvestigator ($pdo, $_POST['firstname'], $_POST['lastname'], investigator_id: $investigator_id);
        if($query){
            header("Location: ../index.php");
        }else{
            echo "Insertion failed";
        }
    }
    if(isset($_POST['deleteinvestigatorBtn'])){
        $query = deleteinvestigator($pdo, $_GET['investigator_id']);
        if($query){
            header("Location: ../index.php");
        }else{
            echo "Insertion failed";
        }
    }
    if(isset($_POST['insertnewcaseBtn'])){
        $query = insertcase($pdo, $_POST['case_name'],$_GET['investigator_id']);
        if($query){
            header("Location: ../index.php");
        }else{
            echo "Insertion failed";
        }
    }
    if (isset($_POST['editcasebtn'])) {
    // Ensure the variables match the form input names
    $case_name = $_POST['casename'];  // This should match the form input name "casename"
    $case_id = $_GET['case_id'];  // Since we are getting the case_id from the URL

    // Call the update function with correct parameters
    $query = updatecase($pdo, $case_name, $case_id);

    if ($query) {
        // Corrected header location with proper concatenation
        header("Location: ../viewcases.php?investigator_id=" . $_GET['investigator_id']);
        exit; // Always use exit after header redirection to stop further execution
    } else {
        echo "Update failed";
    }
    }

    if (isset($_POST["deletecaseBtn"])) {
        $query = deletecase($pdo, $_GET["case_id"]);
        if($query){
            header("Location: ../viewcases.php?investigator_id=".$_GET['investigator_id']);
        }
        else{
            echo "Deletion field";
        }
    }

?>