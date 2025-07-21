
	<form action="/acp/pricing/delete/" method="post">
    	<input type="hidden" name="id" value="#{P_id}" />
        <input type="hidden" name="cmd" value="del" />
        <div style="padding: 8px;">Are you sure you want to delete "#{P_body}".</div><br />
        <div align="right" style="padding: 8px;"><button type="submit">Delete Example Pricing Item</button></div>
	</form>
