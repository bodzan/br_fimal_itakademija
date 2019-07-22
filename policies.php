<?php


    define('HOST', 'mysql');
    define('USERNAME', 'root');
    define('PASSWORD', 'root');
    define('DBNAME', 'paralax');


    $conn = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
    <div class="wrapper">
        <nav class="clearfix">
            <ul>
                <li><a href="index.php">Unesi polisu</a></li>
                <li><a href="policies.php">Policies</a></li>
            </ul>
        </nav>
        <br>
        <table>
            <thead>
                <tr>
                    <th>Datum unosa polise</th>
                    <th>Ime i prezime nosioca polise</th>
                    <th>Datum rođenja</th>
                    <th>Broj pasoša</th>
                    <th>Telefon</th>
                    <th>Email</th>
                    <th>Datum putovanja od</th>
                    <th>Datum putovanja do</th>
                    <th>Broj dana</th>
                    <th>Induvidualno / Grupno osiguranje</th>
                    <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM policies";

                    $row = $conn->query($sql);

                    foreach ($row as $value) {
                        $grp = '';
                        $sql_r = "SELECT * FROM policy_group WHERE policy_id = " . $value['id'];
                        $row_r = $conn->query($sql_r);
                        $rowes = mysqli_num_rows($row_r);
                        if ($rowes > 0) {
                            $grp = 1;
                        }


                        $g = ($grp) ? "grupno osiguranje" : "individualno osiguranje";
                        echo "<tr>\n";
                        echo "<td>" . date(' Y-m-d h:m:i', $value['date']) . "</td>\n";
                        echo "<td>$value[holder_name]</td>\n";
                        echo "<td>" . date(' Y-m-d', $value['dob']) . "</td>\n";
                        echo "<td>$value[passport_no]</td>\n";
                        echo "<td>$value[telephone]</td>\n";
                        echo "<td>$value[email]</td>\n";
                        echo "<td>" . date(' Y-m-d h:m:i', $value['start_date']) . "</td>\n";
                        echo "<td>" . date(' Y-m-d h:m:i', $value['end_date']) . "</td>\n";
                        echo "<td>" . ($value['end_date'] - $value['start_date']) / (24 * 3600) . "</td>\n";
                        echo "<td>" . $g . "</td>\n";
                        echo "</tr>\n";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <?php

    ?>
    </body>
</html>

