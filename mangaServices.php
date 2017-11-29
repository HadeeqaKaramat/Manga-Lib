<?php
class MangaServices{

private $dbh;

function __construct($dbh){
  $this->dbh = $dbh;
}

function getAllMangas(){

  $sSQL = "SELECT photo, nom, id FROM manga;";
  $stmt = $this->dbh->prepare($sSQL);
  $stmt->execute();
  $myrow =  $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $myrow;

}

function getMangaById($id){

  $sSQL = "SELECT * FROM manga where id = :id;";
  $stmt = $this->dbh->prepare($sSQL);
  $stmt->execute(array(":id"=>$id));
  $myrow =  $stmt->fetch(PDO::FETCH_ASSOC);
  return $myrow;
}

function getMangaByName($name){

  $sSQL = "SELECT * FROM manga where nom like :name;";
  $stmt = $this->dbh->prepare($sSQL);
  $stmt->execute(array(":name"=>'%'.$name.'%'));
  $myrow =  $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $myrow;
}
function getMangaByTest($name){

  $sSQL = "SELECT * FROM manga where nom like :name;";
  $stmt = $this->dbh->prepare($sSQL);
  $stmt->execute(array(":name"=>$name));
  $myrow =  $stmt->rowCount();
  return $myrow;
}

function getMangaByYear($year){

  $sSQL = "SELECT * FROM manga where anne = :year;";
  $stmt = $this->dbh->prepare($sSQL);
  $stmt->execute(array(":year"=>$year));
  $myrow =  $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $myrow;
}
function getMangaByStudio($studio){

  $sSQL = "SELECT * FROM manga where studio = :studio;";
  $stmt = $this->dbh->prepare($sSQL);
  $stmt->execute(array(":studio"=>$studio));
  $myrow =  $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $myrow;
}
function getMangaByAuteur($auteur){

  $sSQL = "SELECT * FROM manga where autheur = :auteur";
  $stmt = $this->dbh->prepare($sSQL);
  $stmt->execute(array(":auteur"=>$auteur));
  $myrow =  $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $myrow;
}
// TODO
function insertNewManga($nom, $auteur, $theme, $annee, $studio, $resume, $photo){
  $sSQL = "insert into manga (nom, autheur, theme, anne, studio, resume, photo) values(:nom, :auteur, :theme, :annee, :studio, :resume, :photo)";
  $stmt = $this->dbh->prepare($sSQL);
  $stmt->bindParam(':nom', $nom,PDO::PARAM_STR,50);
  $stmt->bindParam(':auteur', $auteur,PDO::PARAM_STR,100);
  $stmt->bindParam(':theme', $theme,PDO::PARAM_STR,100);
  $stmt->bindParam(':annee', $annee,PDO::PARAM_INT,11);
  $stmt->bindParam(':studio', $studio,PDO::PARAM_STR,100);
  $stmt->bindParam(':resume', $resume,PDO::PARAM_STR);
  $stmt->bindParam(':photo', $photo,PDO::PARAM_LOB);
  $stmt->execute();
}

function deleteManga($id){
  $sSQL = "DELETE FROM manga WHERE id=:id";
  $stmt = $this->dbh->prepare($sSQL);
  $stmt->execute(array(':id'=>$id));
}
function updateManga($nom, $auteur, $theme, $annee, $studio, $resume, $photo,$id){
  $sSQL = "UPDATE manga SET nom=:nom, autheur=:auteur, theme=:theme, anne=:anne, studio=:studio, resume=:resume, photo=:photo WHERE id=:id";
  $stmt = $this->dbh->prepare($sSQL);
  $stmt->bindParam(':nom', $nom,PDO::PARAM_STR,50);
  $stmt->bindParam(':auteur', $auteur,PDO::PARAM_STR,100);
  $stmt->bindParam(':theme', $theme,PDO::PARAM_STR,100);
  $stmt->bindParam(':anne', $annee,PDO::PARAM_INT);
  $stmt->bindParam(':studio', $studio,PDO::PARAM_STR,100);
  $stmt->bindParam(':resume', $resume,PDO::PARAM_STR);
  $stmt->bindParam(':photo', $photo,PDO::PARAM_LOB);
  $stmt->bindParam(':id', $id,PDO::PARAM_INT);
  $stmt->execute();
}
}
 ?>
