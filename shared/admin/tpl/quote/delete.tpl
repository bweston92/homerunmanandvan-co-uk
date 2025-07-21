
	<form action="/acp/quote/delete/" method="post">
    	<input type="hidden" name="id" value="#{Q_id}" />
        <input type="hidden" name="cmd" value="del" />
        <div style="padding: 8px;">Are you sure you want to delete #{Q_label}.</div><br />
        <div align="right" style="padding: 8px;"><button type="submit">Delete Quote Item</button></div>
	</form>
