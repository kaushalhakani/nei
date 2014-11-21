<?php require_once('../inc/top.php'); ?>

<table>
<form name="input" action="../Downloads/html_form_action.asp" method="get">
<legend><h1>Database of papers:</h1></legend>
<tr><td><br />Title            :</td> <td><input type="text" size="150" />(max 100 characters)</td></tr>
<tr><td><br /><br /><br />Author name </td> <td><br /> <input type="text" size="30" /></td></tr>
<tr><td><br /><br /><br />Title of Journal:  </td> <td><input type="text" size="30" /></td></tr>
<tr><td><br /><br /><br />Volume No.: </td> <td><input type="Integer" size="20" /></td></tr>
<tr><td><br /><br /><br />Date: </td> <td><input type="text" size="30" /></td></tr>
<tr><td><br /><br /><br />Short Annotation   :	  </td> <td><input type="text" size="100" /></td></tr>
<tr><td><br /><br /><br />Level   :	  </td> <td><input type="text" size="100" /></td></tr>

<tr><td><br /><br /><br />Level   :	  </td> <td>
<tr><td><br /><input type="radio" name="sex" value="System level" /> Low</td></tr>
<tr><td><br /><input type="radio" name="sex" value="Gate Level" /> General</td></tr>
<tr><td><br /><input type="radio" name="sex" value="Circuit Level" /> High</td></tr>
<tr><td><br /><input type="radio" name="sex" value="Transistor Level" /> Advance</td></tr>
<tr><td><br /><input type="radio" name="sex" value="N/A" /> Other</td></tr>
<input type="text" size="30" /></td></tr>
<tr><td> Please specify : </td></tr>

<tr><td><br /><br /><br />Type   :	  </td> <td><input type="text" size="80" /></td></tr>

</fieldset>
<tr><td><br /><br /><br />Hierarchy of Design </td></tr>
<tr><td><br /><input type="radio" name="sex" value="System level" /> System level</td></tr>
<tr><td><br /><input type="radio" name="sex" value="Gate Level" /> Gate Level</td></tr>
<tr><td><br /><input type="radio" name="sex" value="Circuit Level" /> Circuit Level</td></tr>
<tr><td><br /><input type="radio" name="sex" value="Transistor Level" /> Transistor Level</td></tr>
<tr><td><br /><input type="radio" name="sex" value="N/A" /> N/A</td></tr>

<tr><td><br /><br /><br />Area   :</td> <td><input type="text" size="30" /></td></tr>
<tr><td><br /><br /><br />Availability: Link from where the  paper can be downloaded. (Max. 60 
characters) 
</td> <td><br /><input type="text" size="30" /></td></tr>
<tr><td><br /><br /><br />Keywords: </td> <td><input type="text" size="100" /><br />Required to search journal paper. (Max. 150 characters)</td></tr>


<tr><td><br /><br /><input type="submit" value="Submit" /></td></tr>

</form> 
</table>
<p>If you click the "Submit" button, the form-data will be sent to a page called "html_form_action.asp".</p>

<?php require_once('../inc/bottom.php'); ?>









