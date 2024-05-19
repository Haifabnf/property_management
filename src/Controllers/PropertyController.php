<?php

require_once '../src/Business/PropertyService.php';
require_once '../src/DataAccess/PropertyDAO.php';
require_once '../src/config/config.php';

$propertyDAO = new PropertyDAO($conn);
$propertyService = new PropertyService($propertyDAO);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $properties = $propertyService->getAllProperties();

    $propertiesArray = array_map(function($property) {
        return [
            'id' => $property->getId(),
            'name' => $property->getName(),
            'description' => $property->getDescription(),
            'price' => $property->getPrice(),
            'location' => $property->getLocation()
        ];
    }, $properties);

    echo json_encode(['properties' => $propertiesArray]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $name = $data['name'];
    $description = $data['description'];
    $price = $data['price'];
    $location = $data['location'];

    $propertyService->addProperty($name, $description, $price, $location);
    echo json_encode(['message' => 'Property added successfully']);
}  elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);
    $propertyId = $data['propertyId'];

    $propertyService->deleteProperty($propertyId);
    echo json_encode(['message' => 'Property deleted successfully']);
}
?>
