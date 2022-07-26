<?php

class Media
{
    private $dbh;

    public function setDriver(\PDO $dbh)
    {
        $this->dbh = $dbh;
    }

    public function save(
        $date, $explanation, $hdurl, $media_type, $service_version, $title, $url
        )
    {
        $sql = "
            INSERT INTO `media`

            (date, explanation, hdurl, media_type, service_version, title, url)

            VALUES

            (:date, :explanation, :hdurl, :media_type, :service_version, :title, :url);";

        $sth = $this->dbh->prepare($sql);

        return $sth->execute(array(
            ':date' => $date,
            ':explanation' => $explanation,
            ':hdurl' => $hdurl,
            ':media_type' => $media_type,
            ':service_version' => $service_version,
            ':title' => $title,
            ':url' => $url
        ));
    }

    public function findIdRandom(){
        $sql = "SELECT ROUND(RAND() * (SELECT MAX(id) FROM media)) AS id";
        do{
            $sth = $this->dbh->query($sql);
        }while(!$sth->rowCount());        
        $found = $sth->fetch(PDO::FETCH_ASSOC);
        return $found['id'];
    }

    public function findURLById(){
        $id = $this->findIdRandom();
        $sql = "SELECT url FROM `media` WHERE id = $id";
        $sth = $this->dbh->query($sql);
        $urlFound = $sth->fetch(PDO::FETCH_ASSOC);
        return $urlFound['url'];
    }
}