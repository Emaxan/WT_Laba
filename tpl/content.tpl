<div id="topMargin"></div>
			<div class="container-fluid row" id="wrapper">
				<div class="col-lg-3 border border-up glassBG" id="mybg2">
					<div class='border border-down container-fluid'>
						<form action="php/subscribe.php" method="post">
							<div class="form-group">
								<input class="form-control" type="email" name="email" placeholder="email" style="width: 73%;margin-right: 3px;">
								<input class="form-control navButtons" type="submit" value=" Subscribe " style="top: -1px;position: relative;">
							</div>
						</form>
					</div>

					{FILE='tpl/hotNews.tpl';NUMBER='3'}
					
				</div>

				<div class="col-lg-8 col-lg-offset-1 border border-up glassBG" id="mybg1">

					{FILE='tpl/content/{NAMEPARAM}.tpl'}
					
				</div>
			</div>