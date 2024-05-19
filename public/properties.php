<?php include 'header.php'; ?>
<div class="container">
    <div class="top-right-buttons">
        <button id="addPropertyButton">Add Property</button>
        <button id="logoutButton">Logout</button>
    </div>
    <h2>Properties List</h2>
    <div id="propertiesList" class="properties-list"></div>
</div>

<div id="addPropertyModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Add Property</h2>
        <form id="addPropertyForm">
            <input type="text" id="propertyName" placeholder="Property Name" required><br>
            <textarea id="propertyDescription" placeholder="Property Description" required></textarea><br>
            <input type="number" id="propertyPrice" placeholder="Property Price" required><br>
            <input type="text" id="propertyLocation" placeholder="Property Location" required><br>
            <button type="submit">Add</button>
        </form>
    </div>
</div>

<script src="assets/js/scripts.js"></script>
<?php include 'footer.php'; ?>
