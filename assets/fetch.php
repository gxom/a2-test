<?php 

    include ('database-connection.php');

    $query = "SELECT * FROM users";
    $stmt = $connect->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $total_rows = $stmt->rowCount();

    $output = '
        <table class="table table-sm table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Acción</th>
                </tr>
            </thead>
    ';


    if ($total_rows > 0) 
    {
        $num_row = 0;
        foreach ($result as $row) 
        {    
            $num_row = $num_row + 1;
            $output .= '
                <tr>
                    <th>'.$num_row.'</th>
                    <td>'.$row["first_name"].'</td>
                    <td>'.$row["last_name"].'</td>
                    <td>'.date("d/m/Y",strtotime($row["born_date"])).'</td>
                    <td>
                        <button type="button" name="edit" class="btn btn-primary btn-sm ml-1 edit" id="'.$row["id"].'">
                            Editar
                        </button>
                        <button type="button" name="delete" class="btn btn-danger btn-sm ml-2 delete" id="'.$row["id"].'">
                            Eliminar
                        </button>
                    </td>
                </tr>
            ';
        }
    }
    else
    {
        $output .= '
        <tr>
            <td colspan="5" class="text-center">Datos no encontrados.</td>
        </tr>
        ';
    }


    $output .= '</table>';
    echo $output;
?>