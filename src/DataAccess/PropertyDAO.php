<?php

require_once '../src/config/config.php';
require_once '../src/Models/Property.php';

class PropertyDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllProperties() {
        $result = $this->conn->query("SELECT * FROM properties");
        $properties = [];
        while ($row = $result->fetch_assoc()) {
            $properties[] = new Property($row['id'], $row['name'], $row['description'], $row['price'], $row['location']);
        }
        return $properties;
    }

    public function save(Property $property) {
        $name = $property->getName();
        $description = $property->getDescription();
        $price = $property->getPrice();
        $location = $property->getLocation();

        $sql = "INSERT INTO properties (name, description, price, location) VALUES (?, ?, ?, ?)";
        $statement = $this->conn->prepare($sql);
        $statement->bind_param("ssds", $name, $description, $price, $location);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($propertyId) {
        $sql = "DELETE FROM properties WHERE id = ?";
        $statement = $this->conn->prepare($sql);
        $statement->bind_param("i", $propertyId);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
