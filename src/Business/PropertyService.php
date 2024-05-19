<?php

require_once '../src/Models/Property.php';
require_once '../src/DataAccess/PropertyDAO.php';

class PropertyService {
    private $propertyDAO;

    public function __construct($propertyDAO) {
        $this->propertyDAO = $propertyDAO;
    }

    public function getAllProperties() {
        return $this->propertyDAO->getAllProperties();
    }

    public function addProperty($name, $description, $price, $location) {
        $property = new Property(0, $name, $description, $price, $location);

        $this->propertyDAO->save($property);

        return $property;
    }

    public function deleteProperty($propertyId) {
        $this->propertyDAO->delete($propertyId);

        return true;
    }
}
?>
