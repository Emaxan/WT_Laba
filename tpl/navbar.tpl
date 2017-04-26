<nav class="navbar navbar-inverse border border-up" role="navigation" id="header">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topnav" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="index.php">Nude-Evolution</a>
					</div>

					<div class="collapse navbar-collapse" id="topnav">
						<ul class="nav navbar-nav">
							<li {IF '{VAR;VALUE='pageName'}'=='Model'} class="active" {ENDIF}><a href="models.php"><small>Models</small></a></li>
							<li {IF '{VAR;VALUE='pageName'}'=='Photographer'} class="active" {ENDIF}><a href="photographers.php"><small>Photographers</small></a></li>
							<li {IF '{VAR;VALUE='pageName'}'=='news'} class="active" {ENDIF}><a href="news.php"><small>News</small></a></li>
							<li {IF '{VAR;VALUE='pageName'}'=='histories'} class="active" {ENDIF}><a href="histories.php"><small>Histories</small></a></li>
							<li {IF '{VAR;VALUE='pageName'}'=='search'} class="active" {ENDIF}><a href="search.php"><small>Search</small></a></li>
						</ul>

						<ul class="nav navbar-nav navbar-right" id="loginForm">
							<form class="navbar-form navbar-left" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<input name="login" type="text" class="form-control input-sm signin" placeholder="Nickname">
									<input name="password" type="password" class="form-control input-sm signin" placeholder="Password">
									<input type="submit" class="form-control signin btn btn-default navButtons" value="Sign Up"/>
								</div>
							</form>
						</ul>
					</div>
				</div>
			</nav>