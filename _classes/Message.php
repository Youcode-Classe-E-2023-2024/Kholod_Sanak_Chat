<?php

class Message {
    private $message_id;
    private $message;
    private $room_id;
    private $user_id;
    private $date;

    public function __construct($message_id) {
        global $db;

        $result = $db->query("SELECT * FROM message WHERE message_id = '$message_id'");

        if ($result && $result->num_rows > 0) {
            $messageData = $result->fetch_assoc();

            $this->message_id = $messageData['message_id'];
            $this->message = $messageData['message'];
            $this->room_id = $messageData['room_id'];
            $this->user_id = $messageData['user_id'];
            $this->date = $messageData['date'];
        }
    }

    // Getters and setters for class properties
    public function getMessageId() {
        return $this->message_id;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function getRoomId() {
        return $this->room_id;
    }

    public function setRoomId($room_id) {
        $this->room_id = $room_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function AddMessage($db) {
        global $db;
        $stmt = $db->prepare("INSERT INTO message (message, room_id, user_id, date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siss", $this->message, $this->room_id, $this->user_id, $this->date);
        $stmt->execute();
        $stmt->close();
    }
}
