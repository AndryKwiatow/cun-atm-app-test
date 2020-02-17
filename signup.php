<?php session_start()?>
<?php include('dbcon.php'); ?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="form-wrapper">
        <form action="#" method="post">
            <h3>Registrese aquí</h3>
            <div class="form-item">
                <input type="text" name="id" required="required" placeholder="Username" autofocus required></input>
            </div>
            <div class="form-item">
                <input type="text" name="fName" required="required" placeholder="First Name" required></input>
            </div>
            <div class="form-item">
                <input type="text" name="lName" required="required" placeholder="Last Name" required></input>
            </div>
            <div class="form-item">
                <input type="password" name="pwd" required="required" placeholder="Password" required></input>
            </div>
            <div class="form-item">
                <select name="status_option">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>

            <div class="button-panel">
                <input type="submit" class="button" title="Registrarse" name="login" value="Registrarse"></input>
            </div>
        </form>
 
 
 
 
<?php
    $con = mysqli_connect("37.59.55.185","20YF07FNF8","VPeiydCL7l", "20YF07FNF8");
    //$con = mysqli_connect("remotemysql.com","20YF07FNF8","VPeiydCL7l", "20YF07FNF8");
	// Check connection
	if (mysqli_connect_errno()){
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	else{
		echo "Connected <br/>";
		if (isset($_POST['login']))
		{
			//echo 'UserId: ' . $_POST['id'] . 'Pass: ' . $_POST['pwd'] . '<br/>'. 'First Name: ' . $_POST['fName'] . 'Last Name: ' . $_POST['lName'];
			$id = mysqli_real_escape_string($con, $_POST['id']);
            $fName = mysqli_real_escape_string($con, $_POST['fName']);
            $lName = mysqli_real_escape_string($con, $_POST['lName']);
            $pwd = mysqli_real_escape_string($con, $_POST['pwd']);
            $state = $_POST['status_option'];
            $dateNow = date("Y-m-d");	
            $query = mysqli_query($con, "SELECT id FROM User WHERE id='$id'");

			if(!$query){
				echo mysqli_error($con);
			}else{		
                $row = mysqli_fetch_array($query);
                $num_row = mysqli_num_rows($query);
				if($num_row == 0){
                    //Register
                    $insert = mysqli_query($con,"INSERT INTO User (id, name, lastName, pwd, status, createdDate) VALUES ('" . $id. "','" . $fName . "', '" . $lName . "', '" . $pwd . "', '" . $state . "', '" . $dateNow . "')");
                    echo $insert;

                    if(!$insert){
                        echo "Error en inserción " . mysqli_error($con);  
                    }else{
                        //Redirects new user
                        echo '<script>alert(\'Usuario'. $fName .' '. $lName . ' fue creado exitosamente\'); window.location=\'http://cun-atm-app.eu5.net\'</script>';    
                    }
                    exit;
                }			
                else{
                    //Redirects existing user
                    echo '<script>alert(\'User: '. $id . ' ya existe en base de datos\'); window.location=\'http://cun-atm-app.eu5.net/\'</script>';
                    exit;
                }
            }
		}

	}
	mysqli_close($con);
    ?>
</body>

</html>