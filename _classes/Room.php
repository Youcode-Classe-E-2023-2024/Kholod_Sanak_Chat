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


}
