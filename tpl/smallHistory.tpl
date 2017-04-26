<div class="border border-down" style="margin-top: 10px; text-align: center;">
						<a href="show{{DATABASE;TABLE='users';FIELD='User_profession';ID='{MYID}';MENID='{DATABASE;TABLE='histories';FIELD='Character_id';ID='{MYID}'}'}}.php?id={DATABASE;TABLE='histories';FIELD='Character_id';ID='{MYID}'}"><h4>{DATABASE;TABLE='users';FIELD='User_name';ID='{MYID}';MENID='{DATABASE;TABLE='histories';FIELD='Character_id';ID='{MYID}'}'} {DATABASE;TABLE='users';FIELD='User_second_name';ID='{MYID}';MENID='{DATABASE;TABLE='histories';FIELD='Character_id';ID='{MYID}'}'}</h4></a>
						<p style="text-align: center;">
							 {DATABASE;TABLE='histories';FIELD='Short_form';ID='{MYID}'}
							 <br><div style='float: right; margin-right: 10px; font-size: 0.7em;'>Автор: <a href="show{{DATABASE;TABLE='users';FIELD='User_profession';ID='{MYID}';MENID='{DATABASE;TABLE='histories';FIELD='Author_id';ID='{MYID}'}'}}.php?id={DATABASE;TABLE='histories';FIELD='Author_id';ID='{MYID}'}">{DATABASE;TABLE='users';FIELD='User_name';ID='{MYID}';MENID='{DATABASE;TABLE='histories';FIELD='Author_id';ID='{MYID}'}'} {DATABASE;TABLE='users';FIELD='User_second_name';ID='{MYID}';MENID='{DATABASE;TABLE='histories';FIELD='Author_id';ID='{MYID}'}'}</a></div>
						</p>
						<a href="fullHistory.php?id={DATABASE;TABLE='histories';FIELD='ID';ID='{MYID}'}">Подробнее</a>
					</div>
