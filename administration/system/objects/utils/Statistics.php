<?php

class Statistics
{
    public function countMembers(): int
    {
        $req = db->connect()->prepare('SELECT COUNT(*) as nb FROM members');
        $req->execute();
        return $req->fetch()['nb'];
    }

    public function countViews(): int
    {
        $req = db->connect()->prepare('SELECT COUNT(*) as nb FROM view_article');
        $req->execute();
        return $req->fetch()['nb'];
    }

    public function countComments(): int
    {
        $req = db->connect()->prepare('SELECT COUNT(*) as nb FROM commentaires');
        $req->execute();
        return $req->fetch()['nb'];
    }

    public function countArticles(): int
    {
        $req = db->connect()->prepare('SELECT COUNT(*) as nb FROM news');
        $req->execute();
        return $req->fetch()['nb'];
    }

    public function countStaffs(): int
    {
        $req = db->connect()->prepare('SELECT COUNT(*) as nb FROM members WHERE rang > 1');
        $req->execute();
        return $req->fetch()['nb'];
    }

    public function countBanned(): int
    {
        $req = db->connect()->prepare('SELECT COUNT(*) as nb FROM banip');
        $req->execute();
        return $req->fetch()['nb'];
    }

    public function countDedicaces(): int
    {
        $req = db->connect()->prepare('SELECT COUNT(*) as nb FROM dedi');
        $req->execute();
        return $req->fetch()['nb'];
    }

    public function countFlux(): int
    {
        $req = db->connect()->prepare('SELECT COUNT(*) as nb FROM flux');
        $req->execute();
        return $req->fetch()['nb'];
    }
}