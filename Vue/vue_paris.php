﻿<html>
	<script>
		$(function()
		{
			var jCote = 0;
			var jMise = 0;
			var jGain = 0;
			var pEvent = 0;
			var pOption = '';

			$(".paris-case").click(function()
			{
				jCote = $(this).data('cote');
				pOption = $(this).data('option');
				pEvent = $(this).data('id');

				$(".paris-case").removeClass('active');
				$(this).toggleClass('active');

				$("#paris-option").val(pOption);
				$("#paris-cote").val(jCote);
				$("#paris-event").val(pEvent);

				if(jMise != 0)
				{
					jGain = jMise * jCote;

					$("#gain").text(jGain);			
				}
			});

			$(".paris-delete-icon").click(function()
			{
				let id = $(this).attr("data-id");

				if(confirm("Voulez-vous vraiment supprimer cet évenement ? Vous allez supprimer tous les paris des joueurs associés !"))
				{
					$.ajax({
						url: '../Controleur/ctrl_paris_delete.php',
						method: 'POST',
						data: { eventToDelete: id },
						success: function(response)
						{
							if(response == "done")
								$(".paris-row[data-id='" + id + "']").remove()
						},
						error: function()
						{

						}
					})
				}
			})

			$(".paris-validate-icon").click(function()
			{
				let id = $(this).attr("data-id")
				$(".bet_id").val(id)
				let team1 = $("th.paris-team1[data-id='" + id + "']").html()
				team1 = team1.substring(0, team1.indexOf("<br>"))
				let team2 = $("th.paris-team2[data-id='" + id + "']").html()
				team2 = team2.substring(0, team2.indexOf("<br>"))
				$("#list_winner_team1").html(team1)
				$("#list_winner_team2").html(team2)
				$("#modal_validateBet").modal()
			})

			$("#someid").change(function()
			{
				jMise = $(this).val();
				jGain = jMise * jCote;

				$("#paris-mise").val(jMise);

				$("#gain").text(jGain.toFixed(2));
			});

			$("#button_bet").on("click", function(e)
			{
				event.preventDefault();
				if($("#paris-option").val() != "" && $("#paris-mise").val() != "")
				{
					$("#form_submitBet").submit()
				}
			})

		});
	</script>

	<script type="text/javascript">
		var toto = new Array();
		function myFunction(elmnt,clr, id, idOption, cote){
			//alert('ID Match : '+id+'\nID de l\'équipe :'+idOption+'\nGain : '+document.getElementById('someid').value*cote);
			var elem = document.getElementById('gain');
			elem.innerHTML = document.getElementById('someid').value*cote;
			elmnt.style.color = clr;
		}
		
		function test(){
			var elem = document.getElementById('gain');
			elem.innerHTML = document.getElementById('someid').value * $("#paris-cote").val();
		}
		

		if ('addEventListener' in window) {
			window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
			document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
		}
	</script>

	<script type="text/javascript">
		function createBet()
		{
			let dateDebut = $("#input_eventStartDate").val()
			let heureDebut = $("#input_eventStartTime").val()
			let dateFin = $("#input_eventEndDate").val()
			let heureFin = $("#input_eventEndTime").val()
			let team1 = $("#input_team1").val()
			let team2 = $("#input_team2").val()
			let odds1 = $("#input_odds1").val()
			let oddsnull = $("#input_oddsnull").val()
			let odds2 = $("#input_odds2").val()

			let isValid = true

			const regexdate = /(?:(?:31(\/)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})/
			const regexhour = /(?:[01]\d|2[0123]):(?:[012345]\d):(?:[012345]\d)/

			if(dateDebut == null || dateDebut == "" || !dateDebut.match(regexdate))
			{
				$("#input_eventStartDate").css("border-color", "red");
				isValid = false
			}
			else
				$("#input_eventStartDate").css("border-color", "");
			if(heureDebut == null || heureDebut == "" || !heureDebut.match(regexhour))
			{
				$("#input_eventStartTime").css("border-color", "red");
				isValid = false
			}
			else
				$("#input_eventStartTime").css("border-color", "");

			if(dateFin == null || dateFin == "" || !dateFin.match(regexdate))
			{
				$("#input_eventEndDate").css("border-color", "red");
				isValid = false
			}
			else
				$("#input_eventEndDate").css("border-color", "");
			if(heureFin == null || heureFin == "" || !heureFin.match(regexhour))
			{
				$("#input_eventEndTime").css("border-color", "red");
				isValid = false
			}
			else
				$("#input_eventEndTime").css("border-color", "");
			
			if(team1 == null || team1 == "" || $("#list_teams").children("[value='" + team1 + "']").length == 0)
			{
				$("#input_team1").css("border-color", "red");
				isValid = false
			}
			else
				$("#input_team1").css("border-color", "");
			
			if(team2 == null || team2 == "" || $("#list_teams").children("[value='" + team2 + "']").length == 0)
			{
				$("#input_team2").css("border-color", "red");
				isValid = false
			}
			else
				$("#input_team2").css("border-color", "");
			
			if(odds1 == null || odds1 == "" || typeof oods1 === "number")
			{
				$("#input_odds1").css("border-color", "red");
				isValid = false
			}
			else
				$("#input_odds1").css("border-color", "");
			
			if(oddsnull == null || oddsnull == "" || typeof oddsnull === "number")
			{
				$("#input_oddsnull").css("border-color", "red");
				isValid = false
			}
			else
				$("#input_oddsnull").css("border-color", "");
			
			if(odds2 == null || odds2 == "" || typeof odds2 === "number")
			{
				$("#input_odds2").css("border-color", "red");
				isValid = false
			}
			else
				$("#input_odds2").css("border-color", "");

			if(isValid)
			{
				$("#form_createBet").submit();
			}

		}
	</script>

	<body class="is-loading">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<section id="main">
					
						<?php
							if($joueur->isAdmin())
							{
								?>
								
								<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal_createBet">Créer un pari</button>

								<div class="modal" tabindex="-1" id="modal_createBet">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title">Créer un pari</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<?php
													$teamList = "<datalist id='list_teams'>";
													foreach(Team::getall() as $team)
													{
														$teamList .= "<option value='" .$team["nom"]. "'>";
													}
													$teamList .= "</datalist>";
													echo $teamList;
												?>
												<form id="form_createBet" method="post" action="../Controleur/ctrl_paris.php">
													<div class="form-group">
														<div class="form-row">
															<div class="col">
																<label for="input_eventStartDate">Date de début</label>
																<input type="text" class="form-control" id="input_eventStartDate" name="input_eventStartDate" value=<?=date('d/m/y'); ?>>
															</div>
															<div class="col">
																<label for="input_eventStartTime">Heure de début</label>
																<input type="text" class="form-control" id="input_eventStartTime" name="input_eventStartTime" value=<?=date('H:i:s'); ?>>
															</div>
														</div>
														<div class="form-row">
															<div class="col">
																<label for="input_eventEndDate">Date de fin</label>
																<input type="text" class="form-control" id="input_eventEndDate" name="input_eventEndDate" value=<?=date('d/m/y'); ?>>
															</div>
															<div class="col">
																<label for="input_eventEndTime">Heure de fin</label>
																<input type="text" class="form-control" id="input_eventEndTime" name="input_eventEndTime" value=<?=date('H:i:s'); ?>>
															</div>
														</div>
													</div>
													<div class="form-group">
														<label for="list_team1">Equipe n°1</label>
														<input class="form-control" id="input_team1" name="input_team1" list="list_teams">
													</div>
													<div class="form-group">
														<label for="list_team2">Equipe n°2</label>
														<input class="form-control" id="input_team2" name="input_team2" list="list_teams">
													</div>
													<div class="form-group">
														<label for="input_odds1">Côte de l'équipe 1</label>
														<input type="number" class="form-control" id="input_odds1" name="input_odds1" min="0" step="0.05">
														<label for="input_oddsnull">Côte nulle</label>
														<input type="number" class="form-control" id="input_oddsnull" name="input_oddsnull" min="0" step="0.05">
														<label for="input_odds2">Côte de l'équipe 2</label>
														<input type="number" class="form-control" id="input_odds2" name="input_odds2" min="0" step="0.05">
													</div>
												</form>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
												<button type="button" class="btn btn-primary" onClick="createBet()">Créer</button>
											</div>
										</div>
									</div>
								</div>
								<?php
							}
						?>

						
						<div class="modal" tabindex="-1" id="modal_validateBet">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Valider un pari</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form id="form_validateBet" method="post" action="../Controleur/ctrl_paris.php">
											<input type="hidden" class="bet_id" name="bet_id" />
											<label for="list_winner">Vainqueur</label>
											<select id="list_winner" name="list_winner">
												<option value="1" id="list_winner_team1"></option>
												<option value="null">Match null</option>
												<option value="2" id="list_winner_team2"></option>
											</select>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
										<button type="button" class="btn btn-primary" onClick="document.getElementById('form_validateBet').submit()">Valider</button>
									</div>
								</div>
							</div>
						</div>

						<p>
							<center>
								<h1>Événements à venir :</h1>
								<br></br>
								<table class="table table-striped table-dark col-sm-12 col-xl-6" cellpadding="15" width="100%">
									<thead>
										<tr height="70">
											<th>1</th><th>N</th><th>2</th><th>Date</th>
											<?php if($joueur->isAdmin()) echo '<th>Valider</th>'; ?>
											<?php if($joueur->isAdmin()) echo '<th>Supprimer</th>'; ?>
										</tr>
									</thead>
									<tbody>
								<?php
									foreach(Event::getAllNext() as $event)
									{
										$string = '<tr class="paris-row" data-id="' . $event["id"] . '">';
											$string .= '<th class="paris-case paris-team1" data-id="' . $event["id"] . '" data-cote="' . $event["cotePremiere"] . '" data-option="' . $event["premiereOption"] . '">' . $event["premiereOption"] . '<br><br>' . number_format($event["cotePremiere"], 2, ',', ' ') . '</th>';
											$string .= '<th class="paris-case" data-id="' . $event["id"] . '" data-cote="' . $event["coteDeuxieme"] . '" data-option="' . $event["deuxiemeOption"] . '">' . $event["deuxiemeOption"] . '<br><br>' . number_format($event["coteDeuxieme"], 2, ',', ' ') . '</th>';
											$string .= '<th class="paris-case paris-team2" data-id="' . $event["id"] . '" data-cote="' . $event["coteTroisieme"] . '" data-option="' . $event["troisiemeOption"] . '">' . $event["troisiemeOption"] . '<br><br>' . number_format($event["coteTroisieme"], 2, ',', ' ') . '</th>';
											$string .= '<th>' . $event["heureDebut"] . '</th>';
											if($joueur->isAdmin()) $string .= '<th><img src="../assets/img/validate.webp" class="paris-validate-icon" data-id="' . $event["id"] . '"/></th>';
											if($joueur->isAdmin()) $string .= '<th><img src="../assets/img/delete.png" class="paris-delete-icon" data-id="' . $event["id"] . '"/></th>';
										$string .= '</tr>';

										echo $string;
									}
								?>
									</tbody>
								</table>
							</center>
						</p>
						</br>
						<p>
							<center><h3>Votre mise :</h3> </center>
							<div class="form-group">
								<center style="display: block ruby;">
									<input class="form-control col-sm-12 col-xl-1" type="number" id="someid" onchange="test()" min="1" max="<?=$joueur->getMoney()?>"/> €
								</center>
							</div>
						</br>
							<center><h3>Gain en cas de succès : <span id="gain"><b>0</b></span> €</h3></center>
						</p>
									
							<form id="form_submitBet" class="form-signin" method="post" action="../Controleur/ctrl_paris.php">
								<input type="hidden" id="paris-option" name="paris-option">
								<input type="hidden" id="paris-mise" name="paris-mise">
								<input type="hidden" id="paris-cote" name="paris-cote">
								<input type="hidden" id="paris-event" name="paris-event">
								<center>
									<button class="btn btn-lg btn-success btn-block text-uppercase col-sm-12 col-xl-3" id="button_bet">Parier</button>
								</center>
							</form>
						
					</section>

				<!-- Footer -->
					<footer id="footer">
						
						<!--
						<ul class="copyright">
							<li>&copy; Jane Doe</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
						</ul>
					-->
					</footer>

			</div>

		<!-- Scripts -->
			<!--[if lte IE 8]><script src="assets/js/respond.min.js"></script><![endif]-->
			

	</body>
</html>