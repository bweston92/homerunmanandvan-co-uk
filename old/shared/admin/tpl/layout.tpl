<!DOCTYPE html5>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{Page.genHead()}
</head>

<body>
    <header>
    	<h1>Homerun Admin</h1>
        <a class="logoutlink" href="/acp/logout/">Logout</a>
    </header>
    <aside>
    	<nav>
        	<span>Home page</span>
            <ul>
            	<li><a href="/acp/homepage/" class="icon icon-settings">Edit Content</a></li>
            </ul>
        </nav>
        <nav>
        	<span>Pricing page</span>
            <ul>
            	<li><a href="/acp/pricing/view/" class="icon icon-mag">View All Entries</a></li>
            	<li><a href="/acp/pricing/add/" class="icon icon-add">Add New Entry</a></li>
            </ul>
        </nav>
        <nav>
        	<span>Quote page</span>
            <ul>
            	<li><a href="/acp/quote/view/" class="icon icon-mag">View All Entries</a></li>
            	<li><a href="/acp/quote/add/" class="icon icon-add">Add New Entry</a></li>
            </ul>
        </nav>
        <nav>
        	<span>Settings</span>
            <ul>
				<li><a href="/acp/settings/email/" class="icon icon-email">Contact Emails</a></li>
                <li><a href="/acp/paswd/" class="icon icon-settings">Change Password</a></li>
            </ul>
        </nav>
    </aside>
    <section>
{PageContent}
	</section>
<footer>
        <div>Admin area for <a href="http://www.homerunmanandvan.co.uk/" target="_blank">Homerunmanandvan.co.uk</a> &middot; Created by <a href="http://www.webod.co.uk/" target="_blank">WebOD.co.uk</a></div>
    </footer>
</body>
</html>