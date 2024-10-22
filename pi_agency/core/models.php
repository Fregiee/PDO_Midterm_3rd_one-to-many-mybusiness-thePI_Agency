    <?php
    function insertinvestigator($pdo, $first_name, $last_name){
        $sql = "INSERT INTO investigators(first_name,last_name) VALUES(?,?)";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$first_name, $last_name]);
        if($executeQuery){
            return true;
        }
    }

    function getallinvestigator($pdo){
        $sql = "SELECT * FROM investigators";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute();
        if($executeQuery){
            return $stmt->fetchAll();
        }
    }

    function getinvestigatorbyid($pdo, $investigator_id){
        $sql = "SELECT * FROM investigators WHERE investigator_id = ?";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$investigator_id]);
        if($executeQuery){
            return $stmt->fetch();
        }
    }

    function updateinvestigator($pdo, $first_name, $last_name, $investigator_id){
        $sql = "UPDATE investigators
                        SET first_name = ?,
                            last_name = ?
                        WHERE investigator_id = ?
                ";

        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$first_name, $last_name, $investigator_id]);
        if($executeQuery){
            return true;
        }
    }

    function deleteinvestigator($pdo, $investigator_id){
        $deleteinvestigatorcase = "DELETE FROM cases WHERE investigator_id = ?";
        $deletesmt = $pdo->prepare($deleteinvestigatorcase);
        $executedeletequery = $deletesmt->execute([$investigator_id]);
        if($executedeletequery){
            $sql = "DELETE FROM investigators WHERE investigator_id = ?";
            $stmt = $pdo->prepare($sql);
            $executeQuery = $stmt->execute([$investigator_id]);
            if($executeQuery){
                return true;
            }
        }
    }

    function getcasesbyinvestigator($pdo, $investigator_id){
        $sql =" SELECT
                    cases.case_id AS case_id,
                    cases.case_name AS case_name,
                    cases.date_added AS date_added,
                    CONCAT(investigators.first_name,'',investigators.last_name)AS case_investigator
                FROM cases
                JOIN investigators ON cases.investigator_id = investigators.investigator_id
                WHERE cases.investigator_id = ?
                GROUP BY cases.case_name;
                ";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$investigator_id]);
        if($executeQuery){
            return $stmt->fetchAll();
        }
    }
    function insertcase($pdo, $case_name, $investigator_id){
        $sql = "INSERT INTO cases(case_name,investigator_id) VALUES (?,?)";
        $stmt = $pdo->prepare($sql);
        $executecasequery = $stmt->execute([$case_name,$investigator_id]);
        if($executecasequery){
            return true;
        }
    }

    function getcasebyid($pdo, $case_id){
        $sql =  "SELECT
                    cases.case_id AS case_id,
                    cases.case_name AS case_name,
                    cases.date_added AS date_added,
                    CONCAT(investigators.first_name,'',investigators.last_name)AS case_investigator
                FROM cases
                JOIN investigators ON cases.investigator_id = investigators.investigator_id
                WHERE cases.case_id = ?
                GROUP BY cases.case_name;
                ";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$case_id]);
        if($executeQuery){
            return $stmt->fetch();
        }
    }

    function updatecase($pdo, $case_name, $case_id){
        $sql = "UPDATE cases
                        SET case_name = ?
                        WHERE case_id = ?
                ";

        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$case_name, $case_id]);
        if($executeQuery){
            return true;
        }
    }
    function deletecase($pdo,$case_id){
        $sql = "DELETE FROM cases WHERE case_id = ?";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$case_id]);
        if($executeQuery){
            return true;
        }
    }
?>