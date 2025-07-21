
	<form action="/acp/pricing/edit/" method="post">
    	<input type="hidden" name="id" value="#{P_id}" />
        <table width="100%" border="0">
          <tr>
            <td align="right" valign="top">Content:</td>
            <td><textarea name="data[body]" id="input_body" style="width: 100%" rows="8">#{P_body}</textarea></td>
          </tr>
          <tr>
            <td colspan="2" align="right"><button type="submit">Update Example Pricing Item</button></td>
          </tr>
        </table>
	</form>

