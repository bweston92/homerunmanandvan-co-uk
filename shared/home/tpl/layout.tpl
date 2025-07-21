<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
{Page.genHead()}

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-CT51KEMBPB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-CT51KEMBPB');
</script>

</head>

<body>
    <header class="navbar-header">
      <div class="navbar navbar-expand-lg navbar-dark bg-cyan box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
            <img src="/images/logoimage2.png" alt="Homerun Man &amp; Van's Logo'">
          </a>

          <div class="navbar-collapse">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/prices.php">Example Pricing</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/getaquote.php">Get A Quote</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{Define.FBURL}" target="_blank">
                    <img src="{Page.getStyleUrl}images/facebook.png" width="95" height="16" border="0">
                  </a>
                </li>
              </ul>
            </div>
        </div>
      </div>
    </header>

    <main role="main">
        {PageContent}
    </main>

    <footer>
      <div class="container">
        <p>&copy; Copyright by Homerunmanandvan.co.uk 2011</p>
      </div>
    </footer>
</body>
</html>
