<?php

if ($_GET['do'] == "deloffercat") {
    if ($_POST['done']) {
        mysql_query("delete from offer_types where id={$_POST['offer']}", $c);
        print "Offer category has been removed.";
    } else if ($_POST['subm'] != 1) {
        //get the next variable
        print "<form action=?do=deloffercat method=post><select name=offer>";
        $getoffers = mysql_query("select * from offer_types where active=1", $c);
        while ($off = mysql_fetch_array($getoffers)) {
            print "<option value='{$off['id']}'>{$off['type']}</option>";
        }
        print "</select><input type=hidden name=next value=1><input type=hidden name=subm 
value=1><input type=submit class=button value='Remove Offer Category'></form>";
    } else if ($_POST['next'] == 1) {
        $getoffer = mysql_query("select * from offer_types where id={$_POST['offer']}", $c);
        $off      = mysql_fetch_array($getoffer);
        print "<table width=90%>
<tr><th colspan=2>Deleting Offer Category: {$off['type']}</th></tr>
<tr><td align=center>
Are you sure you wish to delete the following offer category?<br><b>{$off['type']}</b>
</td>
<td>
<form action=?do=deloffercat method=post>
<input type=hidden name=done value=1>
<input type=hidden name=subm value=1>
<input type=hidden name=next value=1>
<input type=hidden name=offer value={$off['id']}>
<input type=submit class=button value=\"Delete Offer Category\"></form>
</td>
</tr></table>
";
    }
} else {
	admin_wrong_file();
}

?>