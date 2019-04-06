<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<!-- Required meta tags -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="description de la page">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<title>Formulaire de contact</title>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!-- External CSS -->
<link rel="stylesheet" href="css/style.css">

<!-- Custom CSS -->
<style>

</style>

</head>
<body>

<!-- CONTENT START -->

<section class="container-fluid">
<div class="row">
<div class="container">
<div  class="row">
<div class="col-12 text-center">
<h1 class="py-5">Contact</h1>
</div>
</div>

<div class="row">
<!--Message de confirmation d'envoi du mail-->
<?php 
if(isset($_SESSION['success']))
{
  echo '<div class="col-md-6 text-center font-weight-bold mx-auto p-2 rounded alert-success">'.$_SESSION['success'].'</div>';
  session_destroy();
} 
?>
</div>

<div class="row">
<div class="col-12">
<!--Dans la balise form on met la méthode, ici post et l'action ici envoi_mail.php.
envoi_mail est la page qui va executer le code pour vérifier les champs et si tout ok, envoyer le mail.-->
<form method="post" action="envoi_mail.php" class="container py-5">
<div class="form-row">

<!--Pour chaque champ on va vérifier si il n'y a pas de messages d'erreur si oui on change la couleur du champ et on indique l'erreur
Sinon si le champ a été rempli mais qu'il y a eu une erreur sur d'autre, on récupère la valeur pour l'afficher et éviter à l'utilisateur 
de devoir le renseigner à nouveau. Sinon le formulaire n'a pas encore été soumis donc on affiche les champs normalement.-->
<?php 
//Nom
if(isset($_SESSION['nomErr']))
{
  echo '<div class="form-group col-6">
  <label for="nom">Nom</label>
  <input type="text" class="form-control is-invalid" name="nom" placeholder="Entrez votre nom">
  <div class="invalid-feedback">
  '.$_SESSION['nomErr'].'</div></div>';
} else {
  if (isset($_SESSION['nom']))
  {
    echo '<div class="form-group col-6">
    <label for="nom">Nom</label>
    <input type="text" class="form-control is-valid" name="nom" value ="'.$_SESSION['nom'].'">
    </div>';
  }else{
    echo '<div class="form-group col-6">
    <label for="nom">Nom</label>
    <input type="text" class="form-control" name="nom" placeholder="Entrez votre nom">
    </div>';}}

//prenom
if(isset($_SESSION['prenomErr']))
{
  echo '<div class="form-group col-6">
  <label for="prenom">Prénom</label>
  <input type="text" class="form-control is-invalid" name="prenom" placeholder="Entrez votre prénom">
  <div class="invalid-feedback">
  '.$_SESSION['prenomErr'].'</div></div>';
} else {
  if (isset($_SESSION['prenom']))
  {
    echo '<div class="form-group col-6">
    <label for="prenom">Prénom</label>
    <input type="text" class="form-control is-valid" name="prenom" value ="'.$_SESSION['prenom'].'">
    </div>';
  }else{
    echo '<div class="form-group col-6">
    <label for="prenom">Prénom</label>
    <input type="text" class="form-control" name="prenom" placeholder="Entrez votre prénom">
    </div>';}}
    
//mail

if(isset($_SESSION['mailErr']))
{
echo '<div class="form-group col-12">
<label for="mail">Mail</label>
<input type="email" class="form-control is-invalid" name="mail" placeholder="Entrez votre Mail">
<div class="invalid-feedback">
'.$_SESSION['mailErr'].'</div></div>';
} else {
if (isset($_SESSION['mail']))
{
echo '<div class="form-group col-12">
<label for="mail">Mail</label>
<input type="email" class="form-control is-valid" name="mail" value ="'.$_SESSION['mail'].'">
</div>';
}else{
echo '<div class="form-group col-12">
<label for="mail">Mail</label>
<input type="email" class="form-control" name="mail" placeholder="Entrez votre Mail">
</div>';}}

//message
if(isset($_SESSION['messageErr']))
{
  echo '<div class="form-group col-12">
  <label for="message">Message</label>
  <textarea class="form-control is-invalid"  name="message" placeholder="Entrez votre message" rows="10"></textarea>
  <div class="invalid-feedback">
  '.$_SESSION['messageErr'].'</div></div>';
} else {
  if (isset($_SESSION['message']))
  {
    echo '<div class="form-group col-12">
    <label for="message">Message</label>
    <textarea class="form-control is-valid"  name="message" rows="10">'.$_SESSION['message'].'</textarea>
    </div>';
  }else{
    echo '<div class="form-group col-12">
    <label for="message">Message</label>
    <textarea class="form-control"  name="message" placeholder="Entrez votre message" rows="10"></textarea>
    </div>';}}
    
   //On supprime la session en cours
    session_destroy();
      
    ?>
                            
<button type="submit" class="btn btn-secondary btn-lg btn-block" name="envoi">Envoyer</button> 

</form> 

</div>
</div>   
</div> 
</div>

</section>
<!-- CONTENT END -->

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- Custom JS -->
<script src="js/main.js"></script>
</body>
</html>