<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{Page.genHead()}
<style>
	.errormsg {
		background: #e66767;
		border: 1px solid #bd4141;
		color: #bd4141;
		padding: 3px;
		text-align: center;
	}
	
	body {
		background: #dedede;
	}
	
	.loginForm {
		width: 280px;
		margin: 35px auto;
		border: 1px solid #9e9e9e;
		background: #fafafa;
	}
	
	table {
		width: 100%;
	}
	
	table tr th,
	table tr td {
		padding: 4px 3px;
	}
</style>
</head>

<body>
<form action="/acp/login/" method="post" class="loginForm" name="loginForm">
	#{error}
	<table border="0" cellpadding="0" cellspacing="0">
    	<tr>
        	<th width="50%" align="right">Username:</th>
            <td width="50%"><input type="text" name="data[username]" id="input_username" /></td>
        </tr>
        <tr>
        	<th align="right">Password:</th>
            <td><input type="password" name="data[password]" id="input_password" /></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><button type="submit">Login!</button></td>
        </tr>
    </table>
</form>
</body>
</html>
