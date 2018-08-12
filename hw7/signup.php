<?php 

session_start();
include("top.html");

$validation_error = isset($_SESSION['validation_error']) ? $_SESSION['validation_error'] : "";

if(!empty($validation_error)){
    echo $validation_error;
}

?>
<form method="POST" action="signup-submit.php">
    <fieldset>
        <legend>New User Signup</legend>
        <table>
            <tr>
                <td>Name: </td>
                <td><input type="text" name="name" size="16" maxlength="16" /></td>
            </tr>
            <tr>
                <td>Password: </td>
                <td><input type="password" name="password" size="16" maxlength="16"/></td>
            </tr>
            <tr>
                <td>Gender: </td>
                <td>
                    <label><input type="radio" name="gender" value="M"/>Male</label>
                    <label><input type="radio" name="gender" value="F" checked/>Female</label>
                </td>
            </tr>
            <tr>
                <td>Age: </td>
                <td><input type="text" name="age" size="6" maxlength="2"/></td>
            </tr>
            <tr>
                <td>Personality type: </td>
                <td><input type="text" name="personality_type" size="6" maxlength="4"/> (<a target="_blank" href="http://www.humanmetrics.com/cgi-win/JTypes2.asp">Don't know your type?</a>)</td>
            </tr>
            <tr>
                <td>Favorite OS: </td>
                <td>
                    <select name="favorite_os">
                        <option selected>Windows</option>
                        <option>Mac OS X</option>
                        <option>Linux</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Seeking age: </td>
                <td>
                    <input type="text" name="max" maxlength="2" size="6" placeholder="max"/>to
                    <input type="text" name="min" maxlength="2" size="6" placeholder="min"/>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Sign Up"/></td>
            </tr>
        </table>
    </fieldset>
</form>
<?php include("bottom.html"); ?>