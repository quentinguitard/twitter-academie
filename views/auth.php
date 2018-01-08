<?php
$database = new Database();
$db = $database->getConnection();
$usermanager = new UserManager($db); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Tweet Academy</title>
</head>
<body>
    <h1>HOME</h1>
    <h2>Bienvenu sur tweet academy</h2>


    <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">S'inscrire </div>
                </div>     

                <div style="padding-top:30px" class="panel-body" >

                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

<?php 
if(!empty($_POST['envoyer']) && !empty($_POST['displayName']) && !empty($_POST['fullName']) && !empty($_POST['mail']) && !empty($_POST['password'])){

    if($usermanager->verification($_POST['mail'],$_POST['displayName']) == false){
        
        echo "<p>Wrong Password OR Username</p>";
        
    }
    else {
        $user = new User($_POST['fullName'],$_POST['displayName'],$_POST['mail'],$_POST['password']);
        $usermanager->create($user);
        $_GET['controller'] = 'home';
        echo "<script> window.location.assign('index.php?controller=".$_GET['controller']."'); </script>";

    }
}
?>
                    <form method="post" action="" id="loginform" class="form-horizontal" role="form">


                        <div style="margin-bottom: 25px" class="form-group">
                            <input type="text" class="form-control" id="fullName" name='fullName' placeholder="Nom Prénom">
                        </div>

                        <div style="margin-bottom: 25px" class="form-group">
                            <input type="text" class="form-control" id="displayName" name="displayName" placeholder="Pseudo">
                        </div>

                        <div style="margin-bottom: 25px" class="form-group">
                            <input class="form-control"  value="" placeholder="adresse email" type="mail" class="form-control" id="mail" name="mail">                                        
                        </div>

                        <div style="margin-bottom: 25px" class="form-group">
                            <input id="password" type="password" class="form-control" name="password" placeholder="mot de passe">
                        </div>



                        <div class="input-group">
                            <div class="checkbox">
                                <label>
                                    <input id="login-remember" type="checkbox" name="remember" value="1"> Rester connecté
                                </label>
                            </div>
                        </div>


                        <div style="margin-top:10px" class="form-group">
                            <!-- Button -->

                            <div class="col-sm-12 controls">
                                <input type="submit" name="envoyer" value="S'inscrire" id="btn-login" class="btn btn-success">

                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-12 control">
                                <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                    Vous avez déjà un compte? 
                                    <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                        Se connecter !
                                    </a>
                                </div>
                            </div>
                        </div>    
                    </form>     

                </div>                     
            </div>  
        </div>
    </div> 


        <form action="" method="post">
            <div class="form-group">
                <label for="mail">Email address:</label>
                <input type="mail" class="form-control" id="mail" name="mail">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name='password'>
            </div>
            <input type="submit" class="btn btn-default" value='Login' name="login">
        </form>
<?php
if(!empty($_POST['login']))
    {
        if($usermanager->exist($_POST['mail'], $_POST['password'])[1] == true){
            $_GET['controller'] = 'home';
            $_SESSION['idUser'] = $usermanager->exist($_POST['mail'], $_POST['password'])[0];
            echo "<script> window.location.assign('index.php?controller=".$_GET['controller']."'); </script>";
            echo "C'est bon tes co !";
        }
        
    }
    ?>

	</body>
	</html>