<div class="border border-down hotNews">
						<h3>{DATABASE;TABLE='news';FIELD='News_Title';ID='{MYID}'}</h3>
						<p>{DATABASE;TABLE='news';FIELD='News_ShortForm';ID='{MYID}'}</p>
						<div style='float: right; margin-right: 10px; font-size: 0.7em;'>Автор: <a href="show{{DATABASE;TABLE='users';FIELD='User_profession';ID='{MYID}';MENID='{DATABASE;TABLE='news';FIELD='User_id';ID='{MYID}'}'}}.php?id={DATABASE;TABLE='news';FIELD='User_id';ID='{MYID}'}">{DATABASE;TABLE='users';FIELD='User_name';ID='{MYID}';MENID='{DATABASE;TABLE='news';FIELD='User_id';ID='{MYID}'}'} {DATABASE;TABLE='users';FIELD='User_second_name';ID='{MYID}';MENID='{DATABASE;TABLE='news';FIELD='User_id';ID='{MYID}'}'}</a></div>
						<a href="fullNews.php?id={DATABASE;TABLE='news';FIELD='News_id';ID='{MYID}'}"><small>Подробнее</small></a>
					</div>