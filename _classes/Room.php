<?php
class Room {
    private $room_id;
    private $room_name;
    private $creator;
    private $is_deleted;

    public function __construct($room_name, $creator, $is_deleted = 0) {

        $this->room_name = $room_name;
        $this->creator = $creator;
        $this->is_deleted = $is_deleted;
    }

    // Getters and setters for class properties
    public function getRoomId() {
        return $this->room_id;
    }

    public function getRoomName() {
        return $this->room_name;
    }

    public function setRoomName($room_name) {
        $this->room_name = $room_name;
    }

    public function getCreator() {
        return $this->creator;
    }

    public function setCreator($creator) {
        $this->creator = $creator;
    }

    public function getIsDeleted() {
        return $this->is_deleted;
    }

    public function setIsDeleted($is_deleted) {
        $this->is_deleted = $is_deleted;
    }

    public function AddRoom($db) {
        global $db;

        $stmt = $db->prepare("INSERT INTO room (room_name, creator, is_deleted) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $this->room_name, $this->creator, $this->is_deleted);
        $stmt->execute();
        $stmt->close();
    }

    /**
     * @param $roomName
     * @param $creator
     * @param $members
     * @param $db
     * @return void
     */
    public static function insertRoom($roomName, $creator, $members, $db) {
        $sql = "INSERT INTO room (room_name, creator) VALUES (?, ?)";

        // Use prepared statements with error handling
        $stmt = $db->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ss", $roomName, $creator);

            if ($stmt->execute()) {
                $roomId = $db->insert_id;

                // Insert creator and members
                self::insertMember($roomId, $creator, $db);
                foreach ($members as $member) {
                    self::insertMember($roomId, $member, $db);
                }

                $stmt->close();
                // Note: Avoid closing the connection here; let the calling code manage the connection lifecycle
            } else {
                // Handle execute error
                echo "Error executing SQL statement: " . $stmt->error;
            }
        } else {
            // Handle prepare error
            echo "Error preparing SQL statement: " . $db->error;
        }
    }



    /**
     * @param $roomId
     * @param $member
     * @param $db
     * @return void
     */
    public static function insertMember($roomId, $member, $db) {
        $sql = "INSERT INTO room_member (room_id, user_id) VALUES (?, ?)";

        // Use prepared statements with error handling
        $stmt = $db->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ii", $roomId, $member);

            if ($stmt->execute()) {
                // Successful execution
                $stmt->close();
            } else {
                // Handle execute error
                echo "Error executing SQL statement: " . $stmt->error;
            }
        } else {
            // Handle prepare error
            echo "Error preparing SQL statement: " . $db->error;
        }
    }


    /**
     * @param $roomId
     * @param $db
     * @return array
     */
    public static function getMembersForRoom($roomId, $db) {
        $members = array();

        // Prepare and execute a query to retrieve members for the specified room
        $query = "SELECT user.* FROM room_member
              JOIN user ON room_member.user_id = user.user_id
              WHERE room_member.room_id = ?";
        $stmt = $db->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $roomId);

            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result) {
                    // Fetch each row and add it to the $members array
                    while ($row = $result->fetch_assoc()) {
                        $members[] = $row;
                    }

                    $stmt->close();
                }
            } else {
                // Handle execute error
                echo "Error executing SQL statement: " . $stmt->error;
            }
        } else {
            // Handle prepare error
            echo "Error preparing SQL statement: " . $db->error;
        }

        return $members;
    }





    /**
     * @return array|void
     */
    static function getAll()
    {
        global $db;
        $result = $db->query("SELECT * FROM room");
        if ($result)
            return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * @param $userId
     * @return array|false
     */
    public static function getRoomCreated($userId)
    {
        global $db;

        $query = "SELECT * FROM room WHERE creator = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            $rooms = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();

            return $rooms;
        } else {

            $stmt->close();
            return false;
        }
    }

    ////////////////////////////            get message           /////////////////////////////////////////

    /**
     * @param $roomId
     * @param $db
     * @return false|mixed
     */
    public static function getMessagesForRoom($roomId, $db) {
        // Prepare and execute a query to retrieve messages for the specified room
        $query = "SELECT m.*, u.username, u.picture FROM message m
                  JOIN user u ON m.user_id = u.user_id
                  WHERE m.room_id = ? 
                  ORDER BY m.date ASC";

        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $roomId);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result) {
                $messages = $result->fetch_all(MYSQLI_ASSOC);
                $stmt->close();

                return $messages;
            }
        }

        $stmt->close();
        //return false;
    }


    /**
     * @param $roomId
     * @param $userId
     * @param $messageContent
     * @param $db
     * @return mixed
     */
    public static function addMessage($roomId, $userId, $messageContent, $db) {
        $query = "INSERT INTO message (message, room_id, user_id, date) VALUES (?, ?, ?, CURRENT_TIMESTAMP)";
        $stmt = $db->prepare($query);

        // Check if the prepare was successful
        if ($stmt) {
            $stmt->bind_param("sii", $messageContent, $roomId, $userId);

            $success = $stmt->execute();

            if ($success) {
                $stmt->close();
                return true;
            } else {
                echo "Error: " . $stmt->error;
                $stmt->close();
                return false;
            }
        } else {
           echo "Error: " . $db->error;
            return false;
        }
    }


    public static function banMember($room, $member)
    {
        global $db;

        // Delete from room_member table
        $deleteRoomMemberSql = "DELETE FROM room_member WHERE room_id=? AND user_id=?";
        $deleteRoomMemberStmt = mysqli_stmt_init($db);
        mysqli_stmt_prepare($deleteRoomMemberStmt, $deleteRoomMemberSql);
        mysqli_stmt_bind_param($deleteRoomMemberStmt, 'ii', $room, $member);
        mysqli_stmt_execute($deleteRoomMemberStmt);
        mysqli_stmt_close($deleteRoomMemberStmt);

        // Delete from message table
        $deleteMessageSql = "DELETE FROM message WHERE user_id=? AND room_id=?";
        $deleteMessageStmt = mysqli_stmt_init($db);
        mysqli_stmt_prepare($deleteMessageStmt, $deleteMessageSql);
        mysqli_stmt_bind_param($deleteMessageStmt, 'ii', $member, $room);
        mysqli_stmt_execute($deleteMessageStmt);
        mysqli_stmt_close($deleteMessageStmt);
    }





}
