<?php //action.php 

    include ('database-connection.php');

    if (isset($_POST["action"]))
    {
        if ($_POST["action"] == "insert")
        {
            $nombre = $_POST["first_name"];
            $apellido = $_POST["last_name"];
            $fecha_n = $_POST["born_date"];
            $query = "INSERT INTO users (first_name, last_name, born_date) VALUES ('$nombre','$apellido','$fecha_n')";
            $stmt = $connect->prepare($query);
            $stmt->execute();
            echo '<p>Usuario Agregado...</p>';
        }

        if  ($_POST["action"] == 'fetch_single')
        {
            $query = "SELECT * FROM users WHERE id = '".$_POST["id"]."'";
            $stmt = $connect->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll();
            foreach ($result as $row)
            {
                $output['first_name'] = $row['first_name'];
                $output['last_name'] = $row['last_name'];
                $output['born_date'] = $row['born_date'];
            }
            echo json_encode($output);
        }

        if ($_POST["action"] == 'update')
        {
            $query = "UPDATE users SET first_name = '".$_POST["first_name"]."', last_name = '".$_POST["last_name"]."', born_date = '".$_POST["born_date"]."' WHERE id = '".$_POST["hidden_id"]."'";
            $stmt = $connect->prepare($query);
            $stmt->execute();
            echo '<p>Usuario Modificado...</p>';
        }

        if ($_POST["action"] == 'delete')
        {
            $query = "DELETE FROM users WHERE id = '".$_POST["id"]."' ";
            $stmt = $connect->prepare($query);
            $stmt->execute();
            echo '<p>Usuario Eliminado...</p>'; 
        }
    }

?>