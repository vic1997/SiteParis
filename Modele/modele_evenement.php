<?php

	class Event {
		//attribut priv� qui recevra une instance de la connexion
		private $cx;
		
		public $id = -1;
		public $premiereOption = "";
		public $deuxiemeOption = "";
		public $troisiemeOption = "";
		public $cotePremiere = 0.0;
		public $coteDeuxieme = 0.0;
		public $coteTroisieme = 0.0;
		public $heureDebut = "";
		public $heureFin = "";
		public $optionGagnant = "";

		public function __construct($id = -1) {
			require_once("../Modele/modele_connexion_base.php");
			$this->cx = Connexion::getInstance();

			if($id != -1 && is_numeric($id))
			{
				$req = $this->cx->prepare("SELECT * FROM event WHERE id = :id");
				$req->execute(array(":id" => $id));
				$result = $req->fetch();
				if(count($result) > 0)
				{
					$this->id = $result["id"];
					$this->premiereOption = $result["premiereOption"];
					$this->deuxiemeOption = $result["deuxiemeOption"];
					$this->troisiemeOption = $result["troisiemeOption"];
					$this->cotePremiere = $result["cotePremiere"];
					$this->coteDeuxieme = $result["coteDeuxieme"];
					$this->coteTroisieme = $result["coteTroisieme"];
					$this->heureDebut = $result["heureDebut"];
					$this->heureFin = $result["heureFin"];
					$this->optionGagnant = $result["optionGagnant"];
				}
			}
		}
		
		public function save() {
			$query = "INSERT INTO `event` 
				(`premiereOption`, `deuxiemeOption`, `troisiemeOption`, `cotePremiere`, `coteDeuxieme`, `coteTroisieme`, `heureDebut`, `heureFin`, `optionGagnant`) 
				VALUES 
				(:premiereOption,:deuxiemeOption,:troisiemeOption,:cotePremiere,:coteDeuxieme,:coteTroisieme,:heureDebut,:heureFin,'')";

			$req = $this->cx->prepare($query);
			$req->execute(array(
				":premiereOption" => $this->premiereOption,
				":deuxiemeOption" => $this->deuxiemeOption,
				":troisiemeOption" => $this->troisiemeOption,
				":cotePremiere" => $this->cotePremiere,
				":coteDeuxieme" => $this->coteDeuxieme,
				":coteTroisieme" => $this->coteTroisieme,
				":heureDebut" => $this->heureDebut,
				":heureFin" => $this->heureFin
			));
			return $req->rowCount() > 0;
		}

		public function delete() {
			$query = "DELETE FROM paris WHERE idEvent = :id";
			$req = $this->cx->prepare($query);
			$req->execute(array(":id" => $this->id));

			$query = "DELETE FROM event WHERE id = :id";
			$req = $this->cx->prepare($query);
			$req->execute(array(":id" => $this->id));
			return $req->rowCount() > 0;
		}
		
		//Retourne un tableau contenant tous les paris jouables
		public static function getAllNext() {
			require_once("../Modele/modele_connexion_base.php");
			$cx = Connexion::getInstance();
			$req = "SELECT *
					FROM event 
					WHERE heureDebut > NOW()
					ORDER BY heureDebut DESC";
			$curseur = $cx->query($req);
			return $curseur->fetchAll();
		}
	}
?>
