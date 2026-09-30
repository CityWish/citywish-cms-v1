<?php

class SessionManager
{
    public ?string $sessionId;
    public ?int $playerId;

    public function __construct()
    {
        $this->sessionId = $_SESSION['userId'] ?? null;
        $this->playerId = 0;

        if($this->sessionId !== null) {
            $sql = db->connect()->prepare('SELECT id FROM members WHERE id = ?');
            $sql->execute([$this->sessionId]);
            if($sql->rowCount() > 0) {
                $this->playerId = $this->sessionId;
            }
        }

    }

    public function isOnline(): bool
    {
        return $this->playerId != 0;
    }
}