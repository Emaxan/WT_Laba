{IF '{VAR;VALUE='auth'}' != 'auth'}<form id="regForm" action="./index.php" method="post" enctype="multipart/form-data">
						<div class="border border-down" id="regTextBG">
							<h3 id="regText">Registration</h3>
							<input type="hidden" name="Registration">
						</div>
						{ERRORS}
						<div class="border border-down container-fluid">
							<div class="row">
								<img class="col-lg-2" src="img/icons/svg/icon-white/social-12.svg" height="32" width="62">
								<div class="myLabel control-label col-lg-3">Avatar</div>
								<label class="file_upload col-lg-7">
									<span class="button">Выбрать</span>
									<mark>Файл не выбран</mark>
									<input name="ava" type="file">
								</label>
							</div>
						</div>
						<div class="border border-down container-fluid">
							<div class="row">
								<img class="col-lg-2" src="img/icons/svg/icon-white/people.svg" height="32" width="62">
								<div class="myLabel control-label col-lg-3">First name</div>
								<input id="firstname" name="firstname" class="form-control input-sm col-lg-7" type="text" placeholder="first name" value="{VAR;VALUE='firstname'}" required>
							</div>
							<div class="row">
								<img class="col-lg-2" src="img/icons/svg/icon-white/people.svg" height="32" width="62">
								<div class="col-lg-3 myLabel control-label">Last name</div>
								<input id="lastname" name="lastname" class="form-control input-sm col-lg-7"  type="text" placeholder="last name" value="{VAR;VALUE='lastname'}"required>
							</div>							
							<div class="row">
								<img class="col-lg-2" src="img/icons/svg/icon-white/social-7.svg" height="32" width="62">
								<div class="col-lg-3 myLabel control-label">Nickname</div>
								<input id="nickname" name="nickname" class="form-control input-sm col-lg-7"  type="text" placeholder="nickname" value="{VAR;VALUE='nickname'}"required>
							</div>
						</div>
						<div class="border border-down container-fluid">
							<div class="row">
								<img class="col-lg-2" src="img/icons/svg/icon-white/internet.svg" height="32" width="62">
								<div class="col-lg-3 myLabel control-label">E-mail</div>
								<input id="email" name="email" class="form-control input-sm col-lg-7" type="email" placeholder="e-mail" value="{VAR;VALUE='email'}" required>
							</div>
							<div class="row">
								<img class="col-lg-2" src="img/icons/svg/icon-white/social-3.svg" height="32" width="62">
								<div class="col-lg-3 myLabel control-label">Password</div>
								<input id="password" name="password" class="form-control input-sm col-lg-7" type="password" placeholder="password" required>
							</div>							
							<div class="row">
								<img class="col-lg-2" src="img/icons/svg/icon-white/social-3.svg" height="32" width="62">
								<div class="col-lg-3 myLabel control-label">Repeat password</div>
								<input id="confirm_password" name="confirm_password" class="form-control input-sm col-lg-7" type="password" placeholder="repeat password" required>
							</div>
						</div>
						<div class="border border-down container-fluid">
							<div class="row">
								<img class="col-lg-2" src="img/icons/svg/icon-white/social-5.svg" height="32" width="62">
								<div class="col-lg-3 myLabel control-label">Birthday</div>
								<div class="col-lg-7 form-group" id="bDayForm">
									<input id="bDay" name="bDay" class="form-control" type="number" min="1" max="31" placeholder="DD" maxlength="2" value="{VAR;VALUE='bDay'}">
									<input id="bMonth" name="bMonth" class="form-control" type="number" min="1" max="12" placeholder="MM" maxlength="2" value="{VAR;VALUE='bMonth'}">
									<input id="bYear" name="bYear" class="form-control" type="number" min="1970" max="{CURRENTYEAR}" placeholder="YYYY" maxlength="4" value="{VAR;VALUE='bYear'}">
								</div>
							</div>
							<div class="row">
								<img class="col-lg-2" src="img/icons/svg/icon-white/social-12.svg" height="32" width="62">
								<div class="col-lg-3 myLabel control-label">You are</div>
								<div class="col-lg-7" id="bDayForm">
									<div class="ui-controlgroup-controls">
										<div>
											<label class="checked" for="photo" id="photol">Photographer</label>
											<input class="myhide" type="radio" id="photo" name="YouAre" value="2" onchange="radioChange('photol', 'modell', 'nobl')" checked required>
										</div>
										<div>
											<label for="model" id="modell">Model</label>
											<input class="myhide" type="radio" id="model" name="YouAre" value="1" onchange="radioChange('modell', 'nobl', 'photol')" required>
										</div>
										<div>
											<label for="nob" id="nobl">Nobody</label>
											<input class="myhide" type="radio" id="nob" name="YouAre" value="3" onchange="radioChange('nobl', 'modell', 'photol')" required>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<img class="col-lg-2" src="img/icons/svg/icon-white/social-7.svg" height="32" width="62">
								<div class="col-lg-3 myLabel control-label">City</div>
								<input id="city" name="city" class="form-control input-sm col-lg-7" type="text" placeholder="city" value="{VAR;VALUE='city'}" required>
							</div>
						</div>
						<div class="border border-down container-fluid">
							<div class="row">
								<img class="col-lg-2" src="img/icons/svg/icon-white/social-7.svg" height="32" width="62">
								<div class="col-lg-3 myLabel control-label">Rules</div>
								<h5 class="col-lg-4" id="rule">NO RULES! ONLY FUN!</h5>
								<label for="agree" id="agreel" class="checkBoxLabel">
									Submit
									<input id="agree" name="agree" class="myhide checkBoxInput" name="submit" type="checkbox" onchange="changeCheckBox('agree')">
								</label>
								
							</div>
						</div>
						<div class="border border-down" id="regTextBG">
							<input name='reg' class="form-control" type="submit"></input>
						</div>
					</form>
{ELSE}
{FILE='tpl/interview.tpl';RANDOMID}
{ENDIF}