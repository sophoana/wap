<?php include("top.html"); ?>
<form method="GET" action="matches-submit.php">
    <fieldset>
        <legend>Returning User:</legend>
        <table>
            <tr>
                <td>Name: </td>
                <td><input type="text" name="name" size="16" maxlength="16"/></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="View My Matches"/></td>
            </tr>
        </table>
    </fieldset>
</form>
<?php include("bottom.html"); ?>
