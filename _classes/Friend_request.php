<?php

class Friend_request{
    public $invitation_id;

    public function __construct()
    {
        global $db;
    }

    /**
     * @param $id_me
     * @param $id_user
     * @return bool
     */
    static function sendRequest($id_me, $id_user)
    {
        global $db;
        $stmt = $db->prepare("INSERT INTO friend_request (sender, receiver) VALUES ('$id_me','$id_user')");
        $result = $stmt->execute();
        return $result;
    }

    /**
     * @param $myId
     * @return array
     */
    public function getInvitation($myId)
    {
        global $db;
        $result = $db->query("SELECT *
                        FROM user
                        JOIN friend_request ON user_id = sender
                        WHERE checker = '0' AND receiver = $myId;");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}