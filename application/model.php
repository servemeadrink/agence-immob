<?php
class Model 
{
   public function lire_agences($offset = 0, $limite = 200)
   {
   		include('pdo.inc.php');

		// On envoie la requète
		$query = $connexion->prepare('SELECT * FROM agences 
										ORDER BY AGE_NOM DESC LIMIT :offset, :limite');
		// On initialise les paramètres
		$query->bindParam(':offset', $offset, PDO::PARAM_INT);
		$query->bindParam(':limite', $limite, PDO::PARAM_INT);
		// On exécute la requête
		$query->execute();
		// On récupére tous les résultats
		$agences = $query->fetchAll();
		// On retourne toutes les agences sélectionnés
		return $agences;
   }
   public function lire_agence($id)
   {
   		include('pdo.inc.php');

		// On envoie la requète
		$query = $connexion->prepare('SELECT * FROM agences 
										WHERE AGE_ID = :id LIMIT 1');
		// On initialise les paramètres
		$query->bindParam(':id', $id, PDO::PARAM_INT);
		// On exécute la requête
		$query->execute();
		// On récupére tous les résultats
		$agence = $query->fetch();
		//
		return $agence;
   }
   public function lire_annonce($id)
   {
   		include('pdo.inc.php');

		// On envoie la requète
		$query = $connexion->prepare('SELECT * FROM mandats 
										WHERE MAN_ID = :id LIMIT 1');
		// On initialise les paramètres
		$query->bindParam(':id', $id, PDO::PARAM_INT);
		// On exécute la requête
		$query->execute();
		// On récupére tous les résultats
		$annonce = $query->fetch();
		//
		return $annonce;
   }
   public function getImmoMandatImg($id)
   {
   		include('pdo.inc.php');

		// On envoie la requète
		$query = $connexion->prepare('SELECT * FROM photos 
										WHERE MAN_ID = :id LIMIT 1');
		// On initialise les paramètres
		$query->bindParam(':id', $id, PDO::PARAM_INT);
		// On exécute la requête
		$query->execute();
		// On récupére tous les résultats
		$photo = $query->fetch();
		//
		return $photo['PHO_SRC'];
   }
   public function getMandatPhotos($id)
   {
   		include('pdo.inc.php');

		// On envoie la requète
		$query = $connexion->prepare('SELECT * FROM photos 
										WHERE MAN_ID = :id ORDER BY PHO_ORDRE ASC');
		// On initialise les paramètres
		$query->bindParam(':id', $id, PDO::PARAM_INT);
		// On exécute la requête
		$query->execute();
		// On récupére tous les résultats
		$photos = $query->fetchAll();
		//
		return $photos;
   }
   public function lire_annonces($agenceId = false)
   {
   		include('pdo.inc.php');
   		$where = "";
   		if($agenceId != false){
   			$where = " WHERE AGE_ID = :id ";
   		}
		// On envoie la requète
		$query = $connexion->prepare('SELECT * FROM mandats '.$where.'
										ORDER BY MAN_ID DESC');
		// On initialise les paramètres
		$query->bindParam(':id', $agenceId, PDO::PARAM_INT);
		// On exécute la requête
		$query->execute();
		// On récupére tous les résultats
		$annonces = $query->fetchAll();
		// On retourne toutes les agences sélectionnés
		return $annonces;
   }

}
