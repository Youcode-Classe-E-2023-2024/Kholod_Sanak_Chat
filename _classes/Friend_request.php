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
                        WHERE checker = 0 AND receiver = $myId;");
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function acceptInvitation($id_me, $id_user)
    {
        global $db;
        $stmtUpdateInvitation = $db->prepare("UPDATE friend_request SET checker = 1 WHERE receiver=? AND sender=?");
        $stmtUpdateInvitation->bind_param('ii', $id_me, $id_user);
        $resultUpdateInvitation = $stmtUpdateInvitation->execute();
        $stmtUpdateInvitation->close();

        if ($resultUpdateInvitation) {
            $stmtInsertFriend = $db->prepare("INSERT INTO friend_list (me, myfriend) VALUES (?, ?)");
            $stmtInsertFriend->bind_param('ii', $id_user, $id_me);
            $resultInsertFriend = $stmtInsertFriend->execute();
            $stmtInsertFriend->close();

//            if ($resultInsertFriend) {
//                $stmtDeleteInvitation = $db->prepare("DELETE FROM friend_request WHERE receiver=? AND sender=? AND checker = 1");
//                $stmtDeleteInvitation->bind_param('ii', $id_me, $id_user);
//                $stmtDeleteInvitation->execute();
//                $stmtDeleteInvitation->close();
//            } else {
//                die("Erreur");
//            }
        }

        return $resultUpdateInvitation;
    }

    public function deleteInvitation($id_me, $id_user)
    {
        global $db;
        $stmt = $db->prepare("DELETE FROM friend_request  WHERE receiver='$id_me' AND sender='$id_user'");
        $result = $stmt->execute();
        return $result;
    }

    public function getFriends($myId)
    {
        global $db;

        $query = "SELECT * FROM user
                WHERE user_id IN (
                    SELECT me FROM friend_list WHERE myfriend = ?
                    UNION
                    SELECT myfriend  FROM friend WHERE me = ?
                )";

        $stmt = $db->prepare($query);
        $stmt->bind_param('ii', $myId, $myId);
        $stmt->execute();

        $result = $stmt->get_result();
        $friends = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $friends;
    }
    public function deleteFriend($id_me, $id_user)
    {
        global $db;
        $stmt = $db->prepare("DELETE FROM friend  WHERE id_user2='$id_me' AND id_user1='$id_user'");
        $result = $stmt->execute();
        return $result;
    }
}