<!DOCTYPE html>
<html>
    <head>
        <title>Stored Data</title>
    </head>
    <body>
        <h2>Data from Database</h2>
        <table border="1">
            <?php
            $conn =new mysqli("localhost","root" ,"","register");
            if($conn->connect_error){
                die("Connection failed: ",$conn->connect_error);
            }
            $sql="SELECT name,bloodgroup,location,contact,email,age,gender,diseases FROM register";
            $result=$conn->query($sql);
            if($result->num_rows>0)
            {
                while($row=$result->fetch_assoc())
                {
                    echo "<tr><td>".$row["name"]."</td><td>".$row["bloodgroup"]."</td><td>" . $row["location"] . "</td><td>".$row["contact"]."</td><td".$row["email"]."</td></td>".$row["age"]."</td><td>".$row["gender"]."</td><td>".$row["diseases"]."</td></tr>";

                }
            }
            else{
                echo "<tr><td> colspan='3'>No data found.</td></tr>";
            }
        </table>
    </body>
</html>