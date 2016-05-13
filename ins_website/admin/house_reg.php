<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php 
include_once("includes/form_functions.php");
	// START FORM PROCESSING
			

		$policy_no=$_GET['policyno'];
		
		if (isset($_POST['submit'])) { // Form has been submitted.
			$errors = array();
			//$policy_no=$_GET['policyno'];

		// perform validations on the form data
		$required_fields = array('house_no', 'house_value', 'month', 'day', 'year', 'address', 'description');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));



		$house_no = trim(mysql_prep($_POST['house_no']));

		$house_value = trim(mysql_prep($_POST['house_value']));
		$month = trim(mysql_prep($_POST['month']));
		$day = trim(mysql_prep($_POST['day']));
		$year = trim(mysql_prep($_POST['year']));
		$address = trim(mysql_prep($_POST['address']));
		$description = trim(mysql_prep($_POST['description']));
		
		$bdate=$year."-".$month."-".$day;
		//echo $policy_no. $date ;

		if ( empty($errors) ) {
			
			
			$query = "INSERT INTO house (
							house_no, house_value ,build_date ,  address,  policy_no, description
						) VALUES (
							'{$house_no}', {$house_value},'bdate' ,  '{$address}', '{$policy_no}',  '{$description}'
						)";
			$result = mysql_query($query, $connection);
			
			if ($result) {
				$message = "The policy  was successfully created.";
				if(isset($_GET['agentid']))
					redirect_to("new_policy.php?policyno={$policy_no}");
				else 
					redirect_to("new_policy_cust.php?policyno={$policy_no}");
				
			} else {
				$message = "The policy could not be created.";
				$message .= "<br />" . mysql_error();
			}
		
		} else {
			if (count($errors) == 1) {
				$message = "There was 1 error in the form.";
			} else {
				$message = "There were " . count($errors) . " errors in the form.";
			}
		
		}
		}else { // Form has not been submitted.
		
		$name = "";
		$type = "";
		$birthday_month ="";
		$birthday_day = "";
		$birthday_year = "";
		$term_price = "";
		$deductable = "";
		$coverage = "";
		$cust_id = "";
	}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="your description goes here" />
<meta name="keywords" content="your,keywords,goes,here" />
<link rel="stylesheet" type="text/css" href="variant.css" media="screen,projection" title="Variant Portal" />
<title>Select Agent</title>
</head>

<body>
<?php require_once("topbar.php"); ?>
<div id="main">
<p align="left">&nbsp;</p>
<h3 align="left" style="position:relative;
left:+106px">Please Enter The Policy Details:</h3>
<p align="left" style="position:relative;
<?php if(isset($_GET['agentid'])) { ?>
left:+106px">This policy will be added for the agent name  ame   with agent ID <strong style="color:green"><?php echo $_GET['agentid'];  ?> </strong></p>
<?php }
else { ?>
left:+106px">This policy will be added for the agent customer  ame   with customer ID <strong style="color:green"><?php echo $_GET['custid'];  ?> </strong></p>
<?php } ?>

<p align="left">
  <?php if(isset($message))echo $message; ?>
  &nbsp;</p>
<form id="form2" name="form2" method="post" action= "<?php echo "house_reg.php?policyno=".$policy_no; ?>">
<p>&nbsp;</p>

  <table width="731" border="0" cellspacing="10">
    <tr>
      <th width="86" scope="row">&nbsp;</th>
      <th width="154" scope="row"><div align="left">House No</div></th>
      <td width="236"><label for="textfield2"></label>
        <input type="text" name="house_no" id="textfield2" /></td>
      <td width="182">&nbsp;</td>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <th scope="row"><div align="left">Build Date</div></th>
      <td class="label"><span class="field_container">
        <select class="" id="month" name="month" onchange='return run_with(this, [&quot;editor&quot;], function() {editor_date_month_change(this, &quot;birthday_day&quot;, &quot;birthday_year&quot;);});'>
          <option value="-1">Month:</option>
          <option value="1">Jan</option>
          <option value="2">Feb</option>
          <option value="3">Mar</option>
          <option value="4">Apr</option>
          <option value="5">May</option>
          <option value="6">Jun</option>
          <option value="7">Jul</option>
          <option value="8">Aug</option>
          <option value="9">Sep</option>
          <option value="10">Oct</option>
          <option value="11">Nov</option>
          <option value="12">Dec</option>
        </select>
        <select name="day" id="day" onchange="" autocomplete="off">
          <option value="-1">Day:</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="31">31</option>
        </select>
        <select name="year" id="year" onchange='return run_with(this, [&quot;editor&quot;], function() {editor_date_month_change(&quot;birthday_month&quot;,&quot;birthday_day&quot;,this);});' autocomplete="off">
          <option value="-1">Year:</option>
          <option value="2010">2010</option>
          <option value="2009">2009</option>
          <option value="2008">2008</option>
          <option value="2007">2007</option>
          <option value="2006">2006</option>
          <option value="2005">2005</option>
          <option value="2004">2004</option>
          <option value="2003">2003</option>
          <option value="2002">2002</option>
          <option value="2001">2001</option>
          <option value="2000">2000</option>
          <option value="1999">1999</option>
          <option value="1998">1998</option>
          <option value="1997">1997</option>
          <option value="1996">1996</option>
          <option value="1995">1995</option>
          <option value="1994">1994</option>
          <option value="1993">1993</option>
          <option value="1992">1992</option>
          <option value="1991">1991</option>
          <option value="1990">1990</option>
          <option value="1989">1989</option>
          <option value="1988">1988</option>
          <option value="1987">1987</option>
          <option value="1986">1986</option>
          <option value="1985">1985</option>
          <option value="1984">1984</option>
          <option value="1983">1983</option>
          <option value="1982">1982</option>
          <option value="1981">1981</option>
          <option value="1980">1980</option>
          <option value="1979">1979</option>
          <option value="1978">1978</option>
          <option value="1977">1977</option>
          <option value="1976">1976</option>
          <option value="1975">1975</option>
          <option value="1974">1974</option>
          <option value="1973">1973</option>
          <option value="1972">1972</option>
          <option value="1971">1971</option>
          <option value="1970">1970</option>
          <option value="1969">1969</option>
          <option value="1968">1968</option>
          <option value="1967">1967</option>
          <option value="1966">1966</option>
          <option value="1965">1965</option>
          <option value="1964">1964</option>
          <option value="1963">1963</option>
          <option value="1962">1962</option>
          <option value="1961">1961</option>
          <option value="1960">1960</option>
          <option value="1959">1959</option>
          <option value="1958">1958</option>
          <option value="1957">1957</option>
          <option value="1956">1956</option>
          <option value="1955">1955</option>
          <option value="1954">1954</option>
          <option value="1953">1953</option>
          <option value="1952">1952</option>
          <option value="1951">1951</option>
          <option value="1950">1950</option>
          <option value="1949">1949</option>
          <option value="1948">1948</option>
          <option value="1947">1947</option>
          <option value="1946">1946</option>
          <option value="1945">1945</option>
          <option value="1944">1944</option>
          <option value="1943">1943</option>
          <option value="1942">1942</option>
          <option value="1941">1941</option>
          <option value="1940">1940</option>
          <option value="1939">1939</option>
          <option value="1938">1938</option>
          <option value="1937">1937</option>
          <option value="1936">1936</option>
          <option value="1935">1935</option>
          <option value="1934">1934</option>
          <option value="1933">1933</option>
          <option value="1932">1932</option>
          <option value="1931">1931</option>
          <option value="1930">1930</option>
          <option value="1929">1929</option>
          <option value="1928">1928</option>
          <option value="1927">1927</option>
          <option value="1926">1926</option>
          <option value="1925">1925</option>
          <option value="1924">1924</option>
          <option value="1923">1923</option>
          <option value="1922">1922</option>
          <option value="1921">1921</option>
          <option value="1920">1920</option>
          <option value="1919">1919</option>
          <option value="1918">1918</option>
          <option value="1917">1917</option>
          <option value="1916">1916</option>
          <option value="1915">1915</option>
          <option value="1914">1914</option>
          <option value="1913">1913</option>
          <option value="1912">1912</option>
          <option value="1911">1911</option>
          <option value="1910">1910</option>
          <option value="1909">1909</option>
          <option value="1908">1908</option>
          <option value="1907">1907</option>
          <option value="1906">1906</option>
          <option value="1905">1905</option>
        </select>
        </span></td>
      <td><div class="field_container"></div></td>
      <td width="3">&nbsp;</td>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <th scope="row"><div align="left">House Value</div></th>
      <td><input type="text" name="house_value" id="textfield2" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <th scope="row"><div align="left">Address</div></th>
      <td><input type="text" name="address" id="textfield3" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th height="21" scope="row">&nbsp;</th>
      <th scope="row"><div align="left">Description</div></th>
      <td><label for="textarea"></label>
        <textarea name="description" id="textarea" cols="45" rows="5"></textarea></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <th scope="row">&nbsp;</th>
      <td><input type="submit" name="submit" id="submit" value="submit" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  </div>
  <?php require_once("sidebar.php"); ?>
</form>
<p>&nbsp;</p>
<div id="sidebar">
  <div> </div>
</div>
</body>
</html>