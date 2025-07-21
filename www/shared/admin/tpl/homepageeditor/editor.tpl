
	<style>
		.homeSectionEditor table {
			width: 100%;
		}
		.homeSectionEditor table tr td {
			padding: 6px;
		}
		.homeSectionEditor table tr td textarea {
			width: 95%;
			height: 130px;
		}
		
	</style>
	<form action="/acp/homepage/" method="post" class="homeSectionEditor">
    	<table>
        	<tr>
            	<td width="20%" align="right">Section 1:</td>
              <td width="80%"><textarea name="data[homepage-p1]">#{homepage-p1}</textarea></td>
            </tr>
            <tr>
            	<td width="20%" align="right">Section 2:</td>
              <td width="80%"><textarea name="data[homepage-p2]">#{homepage-p2}</textarea></td>
            </tr>
            <tr>
            	<td width="20%" align="right">Section 3:</td>
              <td width="80%"><textarea name="data[homepage-p3]">#{homepage-p3}</textarea></td>
            </tr>
            <tr>
            	<td colspan="2" align="center"><button type="submit">Update!</button></td>
            </tr>
        </table>
    </form>
