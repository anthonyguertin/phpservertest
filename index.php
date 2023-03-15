<h1 style="td">Coding Conventions for Embedded PHP</h1>
<table border="1" cellpadding="5" cellspacing="0">
    <tr style="font-size: 18px; background-color: grey; color: #f1f1f1; font-weight: bold">
        <th>Name</th>
        <th>Address</th>
    </tr>
     <?php
        $config = include('config.php');

        $servername = $config['host'];
        $username = $config['username'];
        $password = $config['password'];
        $dbname =  $config['database'];

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
        echo "Connected successfully";
    ?> 


    <?php
        $sql = "SELECT * FROM person;";
        $person_array_query = $conn->query($sql);
        $person_array = null;
        if ($person_array_query->num_rows > 0){
            $person_array = $person_array_query->fetch_all(MYSQLI_ASSOC);
        }
        $mock_person_array = array(
            array(
                'name' => 'Anthony Guertin',
                'address' => '2130 Carolyn Way'
            ),
            array(
                'name' => 'Anthony Eiting',
                'address' => '100 S. 255 E.'
                )
            );
        for ($x=0;$x<sizeof($person_array);$x++) {
        ?>
        <tr style="   font-family: courier; border-bottom: 1pt; border-color:green; margin: px" >
            
            <td style=""><?php echo $person_array[$x]['name']?></td>
            <td><?php echo $person_array[$x]['address']?></td>
        </tr>
 
        <?php


        ?>
    <?php }
             
             if (isset($_POST["submit-btn"])) {
                $name=$_POST['name'];
                $address=$_POST['address'];

                $person_exist = false;
                for ($i = 0;$i<sizeof($person_array);$i++){
                    if ($person_array[$i]['name']===$name) $person_exist=true;
                }

                if (!$person_exist) {
                    $sql = "INSERT INTO `phpServerTest`.`person`(`name`, `address`) VALUES ('".$name."','".$address."');";
                    $conn->query($sql);
                }
                // refresh page;
                echo("<meta http-equiv='refresh' content='1'>");
            } ?>
    </table>
    <form method="POST" action="http://localhost">
        <label>Add Person</br></label>
        <label>name</label></br>
        <input name="name" id="name" type="text"/></br>
        <label>address</label></br>
        <input name="address" id ="address" type="text"></input>
        <input name="submit-btn" type="submit" />
    </form>

