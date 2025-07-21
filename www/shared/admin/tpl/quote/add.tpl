
	<form action="/acp/quote/add/" method="post">
        <table width="100%" border="0">
          <tr>
            <td width="20%" align="right" valign="top">Email label:</td>
            <td width="80%"><input type="text" name="data[email_label]" id="input_email_label" style="width: 100%;" /></td>
          </tr>
          <tr>
            <td align="right" valign="top">Page label:</td>
            <td><textarea name="data[label]" id="input_label" style="width: 100%" rows="4"></textarea></td>
          </tr>
          <tr>
            <td align="right" valign="top">Description:</td>
            <td><textarea name="data[body]" id="input_body" style="width: 100%" rows="8"></textarea></td>
          </tr>
          <tr>
            <td colspan="2" align="right"><button type="submit">Add Quote Item</button></td>
          </tr>
        </table>
	</form>
