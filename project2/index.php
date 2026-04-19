<!DOCTYPE html>
<html>
<head>
<title>Student Registration Form</title>
</head>
<body>

<h2>STUDENT REGISTRATION FORM</h2>

<form method="POST" action="insert.php">

<table cellpadding="8">

<tr>
  <td width="200">FIRST NAME *</td>
  <td><input type="text" name="firstname" required></td>
</tr>

<tr>
  <td>LAST NAME *</td>
  <td><input type="text" name="lastname" required></td>
</tr>

<tr>
  <td>EMAIL *</td>
  <td><input type="email" name="email" required></td>
</tr>

<tr>
  <td>MOBILE *</td>
  <td><input type="tel" name="mobile" required></td>
</tr>

<tr>
  <td>GENDER *</td>
  <td>
    <input type="radio" name="gender" value="Male" required> Male
    <input type="radio" name="gender" value="Female"> Female
  </td>
</tr>

<tr>
  <td>ADDRESS</td>
  <td><textarea name="address"></textarea></td>
</tr>

<tr>
  <td>CITY</td>
  <td><input type="text" name="city"></td>
</tr>

<tr>
  <td>PIN CODE</td>
  <td><input type="text" name="pincode"></td>
</tr>

<tr>
  <td>STATE</td>
  <td><input type="text" name="state"></td>
</tr>

<tr>
  <td>COUNTRY</td>
  <td>
    <input type="checkbox" name="country" value="India"> India
  </td>
</tr>

<tr>
  <td>HOBBIES</td>
  <td>
    <input type="checkbox"> Drawing
    <input type="checkbox"> Singing
    <input type="checkbox"> Dancing
    <input type="checkbox"> Sketching
  </td>
</tr>

<tr>
  <td colspan="2"><b>Qualification Details</b></td>
</tr>

<tr>
<td colspan="2">

<table border="1" width="100%" cellpadding="5">

<tr>
  <th>SL</th>
  <th>Exam</th>
  <th>Board</th>
  <th>Percentage</th>
  <th>Year</th>
</tr>

<tr>
  <td>1</td>
  <td>Class X</td>
  <td><input type="text" maxlength="10"></td>
  <td><input type="number" step="0.01"></td>
  <td><input type="text" maxlength="4"></td>
</tr>

<tr>
  <td>2</td>
  <td>Class XII</td>
  <td><input type="text" maxlength="10"></td>
  <td><input type="number" step="0.01"></td>
  <td><input type="text" maxlength="4"></td>
</tr>

</table>

</td>
</tr>

<tr>
  <td>COURSE *</td>
  <td>
    <input type="radio" name="course" value="BCA"> BCA
    <input type="radio" name="course" value="B.Com"> B.Com
    <input type="radio" name="course" value="B.Sc"> B.Sc
    <input type="radio" name="course" value="B.A"> B.A
  </td>
</tr>

<tr>
  <td></td>
  <td>
    <button type="submit">Submit</button>
    <button type="reset">Reset</button>
  </td>
</tr>

</table>

</form>

</body>
</html>
