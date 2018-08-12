<?php
session_start();
include("top.html");
$name = isset($_COOKIE['name']) ? $_COOKIE['name'] : "";
$pass = isset($_COOKIE['password']) ? $_COOKIE['password'] : "";
$error = isset($_SESSION['error']) ? $_SESSION['error'] : "";

session_destroy();
$check = 0;
if (!empty($name)) {
    $check = 1;
}

if(!empty($error)){
    echo $error;
}

?>



<form method="POST" action="login-submit.php">
    <fieldset>
        <legend>Returning User:</legend>
        <table>
            <tr>
                <td>Name: </td>
                <td><input type="text" name="name" size="16" maxlength="16"/></td>
            </tr>
            <tr>
                <td>Password: </td>
                <td><input type="password" name="password" size="16" maxlength="16"/></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="View My Matches"/></td>
            </tr>
        </table>
    </fieldset>
</form>
<?php include("bottom.html"); ?>
