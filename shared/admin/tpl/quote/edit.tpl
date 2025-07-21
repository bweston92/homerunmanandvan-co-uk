
	<form action="/acp/quote/edit/" method="post">
    	<input type="hidden" name="id" value="#{Q_id}" />
        <table width="100%" border="0">
          <tr>
            <td width="20%" align="right" valign="top">Email label:</td>
            <td width="80%"><input name="data[email_label]" type="text" id="input_email_label" style="width: 100%;" value="#{Q_email_label}" /></td>
          </tr>
          <tr>
            <td align="right" valign="top">Page label:</td>
            <td><textarea name="data[label]" id="input_label" style="width: 100%" rows="4">#{Q_label}</textarea></td>
          </tr>
          <tr>
            <td align="right" valign="top">Description:</td>
            <td><textarea name="data[body]" id="input_body" style="width: 100%" rows="8">#{Q_body}</textarea></td>
          </tr>
          <tr>
            <td colspan="2" align="right"><button type="submit">Update Quote Item</button></td>
          </tr>
        </table>
	</form>

