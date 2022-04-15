<?php
session_start();

$db = new PDO('mysql:host=localhost;dbname=notehub', 'root', 'rootpassword');
$user = $_POST["user_id"];
$pass = $_POST["password"];
// check user and pass for sql
$return = $db->query("SELECT * FROM users WHERE username=$user AND password=$pass;");
$return = $return->fetchAll();
if (count($return)) {
    $_SESSION['username'] = $user;
    header("Location: http://localhost/CP476/Cp476/dashboard.php");
} else {
?>
    <script>
        <?php
        echo "alert('Wrong username or password')";
        ?>
    </script>
<?php
    //header("Location: http://localhost:8080/login.html");
}

?>

