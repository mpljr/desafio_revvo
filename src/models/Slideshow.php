<?php
class Slideshow {
    private $conn;
    private $table_name = "slideshow";

    public $id;
    public $title;
    public $description;
    public $image_url;
    public $button_text;
    public $button_link;
    public $order_position;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                 (title, description, image_url, button_text, button_link, order_position)
                 VALUES (:title, :description, :image_url, :button_text, :button_link, :order_position)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":image_url", $this->image_url);
        $stmt->bindParam(":button_text", $this->button_text);
        $stmt->bindParam(":button_link", $this->button_link);
        $stmt->bindParam(":order_position", $this->order_position);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY order_position ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . "
                 SET title = :title,
                     description = :description,
                     image_url = :image_url,
                     button_text = :button_text,
                     button_link = :button_link,
                     order_position = :order_position
                 WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":image_url", $this->image_url);
        $stmt->bindParam(":button_text", $this->button_text);
        $stmt->bindParam(":button_link", $this->button_link);
        $stmt->bindParam(":order_position", $this->order_position);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}