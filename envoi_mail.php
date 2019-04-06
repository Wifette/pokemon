<?php

  session_start();
 
// On déclare les variables pour les données entrées et les messages d'erreur à 0
$nomErr = $prenomErr = $mailErr = $messageErr = "";
$nom = $prenom = $mail = $message = "";
$_SESSION['nom'] = $_POST['nom'];
$_SESSION['prenom'] = $_POST['prenom'];
$_SESSION['mail'] = $_POST['mail'];
$_SESSION['message'] = $_POST['message'];
//On vérifie que le champ est rempli sinon on assigne un message à la variable de session erreur 
//Pour afficher le message d'erreur sur le formulaire
  if (empty($_POST['nom'])) {
    $nomErr = "Merci de renseigner votre nom !";
    $_SESSION['error'] =1;
    $_SESSION['nomErr'] = $nomErr;
   
  } else {
    $nom = test_input($_POST['nom']);
  //Le champ est rempli, on vérifie que le champ nom est rempli avec des caractères autorisés sinon on assigne un message à la variable de session erreur 
  //Pour afficher le message sur le formulaire
    if (!preg_match("#^\p{L}(\p{L}+[- ']?)*\p{L}$#ui",$nom)) {
      $nomErr = "Merci de remplir uniquement par des lettres minuscules et/ou majuscules !"; 
      $_SESSION['error'] =1;
      $_SESSION['nomErr'] = $nomErr;
    }
  }
//On vérifie que le champ est rempli sinon on assigne un message à la variable de session erreur 
//Pour afficher le message d'erreur sur le formulaire
  if (empty($_POST['prenom'])) {
    $prenomErr = "Merci de renseigner votre prenom !";
    $_SESSION['error'] =1;
    $_SESSION['prenomErr'] = $prenomErr;
  } else {
    $prenom = test_input($_POST['prenom']);
   //Le champ est rempli, on vérifie que le champ est rempli avec des caractères autorisés sinon on assigne un message à la variable de session erreur 
  //Pour afficher le message sur le formulaire
    if (!preg_match("#^\p{L}(\p{L}+[- ']?)*\p{L}$#ui",$prenom)) {
        $prenomErr = "Merci de remplir uniquement par des lettres minuscules et/ou majuscules !"; 
        $_SESSION['error'] =1;
        $_SESSION['prenomErr'] = $prenomErr;
      }
  }
//On vérifie que le champ est rempli sinon on assigne un message à la variable de session erreur 
//Pour afficher le message d'erreur sur le formulaire
  if (empty($_POST['mail'])) {
    $mailErr = "Merci de renseigner votre mail !";
    $_SESSION['error'] =1;
    $_SESSION['mailErr'] = $mailErr;
  } else {
    $mail = test_input($_POST['mail']);
   //Le champ est rempli, on vérifie qu'il s'agit bien d'une adresse mail valide sinon on assigne un message à la variable de session erreur 
  //Pour afficher le message sur le formulaire
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $mailErr = "Format de mail invalide !"; 
      $_SESSION['error'] =1;
      $_SESSION['mailErr'] = $mailErr;
    }
  }

//On vérifie que le champ est rempli sinon on assigne un message à la variable de session erreur 
//Pour afficher le message d'erreur sur le formulaire
  if (empty($_POST['message'])) {
   $messageErr = "Veuillez entrer un message !";
    $_SESSION['error'] =1;
    $_SESSION['messageErr'] = $messageErr;
 } else {

    $message = test_input($_POST['message']);
}
//Fonction qui vérifie les données entrées pour éviter l'injection de code malveillants et le remplace si besoin
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
//Si une erreur est rencontrée on retourne sur le formulaire et on affiche les messages d'erreur
  if(!empty($_SESSION['error'])){ 
  
  header('Location: formulaire.php');
  }else{
    //Sinon aucune erreur on envoie le mail et on affiche un message de confirmation sur le formulaire
  $_SESSION['success'] = "Votre message a bien été envoyé";
  $_SESSION['nom'] = NULL;
$_SESSION['prenom'] = NULL;
$_SESSION['mail'] = NULL;
$_SESSION['message'] = NULL;

 
 
 // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
 $headers[] = 'MIME-Version: 1.0';
 $headers[] = 'Content-type: text/html; charset=iso-8859-1';

 // En-têtes additionnels, plusieurs destinataires
 //$headers[] = 'To: Mary <mary@example.com>, Kelly <kelly@example.com>';
 
  $from = 'votresite';
  $headers[]= 'from :' .$from;
  $to = 'votremail'; // Insérer votre adresse email ICI
  $subject = $from .' - Message via Contact';
  $message_content = '
  <table>
  <tr>
  <td>Bonjour,</td>
  </tr>
  <tr>
  <td>Un message vient de vous être envoyé par '. $nom . " " . $prenom.' via le formulaire de contact du site '. $from .'.</td>
  </tr>
  <tr>
  <td><b>Contenu du message :</b></td>
  </tr>
  <tr>
  <td>'. $message .'</td>
  </tr>
  <tr>
  <td><b>Adresse mail :</b></td>
  </tr>
  <tr>
  <td>'. $mail .'</td>
  </tr>
  </table>
  ';
mail($to, $subject, $message_content, implode("\r\n", $headers));
  header('Location: formulaire.php');
  }
?>
