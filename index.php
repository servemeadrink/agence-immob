<?php
// Afficher les erreurs
// Et sa valeur doit être à 0 en mode Production
ini_set('display_errors', 1);
// Rapporter les E_NOTICE peut vous aider à améliorer vos scripts
// (variables non initialisées, variables mal orthographiées..)
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

// Lancement du module
require 'application/app.php';
