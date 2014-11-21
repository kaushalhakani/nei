<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>



<body>
<table width="600px">
<form name="input" action="html_form_action.asp" method="get">
<legend>Add a Journal:</legend>
<tr><td>Serial Number</td> <td><input type="text" size="30" /></td></tr>
<tr><td>Name IEEE format (Author names, “Paper name”, Publisher, year) (Max. 100 
characters)</td> <td> <input type="text" size="30" /></td></tr>
<tr><td>Level: (as explained above)(Max. 15 characters)  </td> <td><input type="text" size="30" /></td></tr>
<tr><td>Type : (as explained above) (Max. 20 characters) </td> <td><input type="text" size="30" /></td></tr>
<tr><td>Field:  (as explained above) (Max. 20 characters)</td> <td><input type="text" size="30" /></td></tr>

</fieldset>
<tr><td>Hierarchy of Design </td></tr>
<tr><td><input type="radio" name="sex" value="System level" /> System level</td>
<td><input type="radio" name="sex" value="Gate Level" /> Gate Level</td></tr>
<tr><td><input type="radio" name="sex" value="Circuit Level" /> Circuit Level</td>
<td><input type="radio" name="sex" value="Transistor Level" /> Transistor Level</td></tr>
<tr><td><input type="radio" name="sex" value="N/A" /> N/A</td></tr>
<tr></tr><tr></tr>
<tr><td>Annotation: <br />If more than one separated by comma (,). Please also mention your confidence level in regard to your  comments (in scale of 5) (Max. 1000 characters) </td> <td><input type="text" size="30" /></td></tr>
<tr><td>Availability: Link from where the  paper can be downloaded. (Max. 60 
characters) </td> <td><input type="text" size="30" /></td></tr>
<tr><td>Keywords: Required to search journal paper. (Max. 150 characters) </td> <td><input type="text" size="30" /></td></tr>
<tr><td> Year: Required to search journal paper so that one can look at the latest advances in particular area. (Month, Year) </td> <td><input type="text" size="30" /></td></tr>

<tr><td><input type="submit" value="Submit" /></td></tr>
</form> 
</table>
<p>If you click the "Submit" button, the form-data will be sent to a page called "html_form_action.asp".</p>

</body>
</html>








