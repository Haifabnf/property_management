document.addEventListener("DOMContentLoaded", function() {
    const token = localStorage.getItem("token");

    if (token && (window.location.pathname === "/login.php" || window.location.pathname === "/signup.php")) {
        window.location.href = "properties.php";
    }

    if (!token && window.location.pathname === "/properties.php") {
        window.location.href = "login.php";
    }

    const logoutButton = document.getElementById("logoutButton");
    if (logoutButton) {
        logoutButton.addEventListener("click", function() {
            localStorage.removeItem("token");
            window.location.href = "login.php";
        });
    }

    const addPropertyButton = document.getElementById('addPropertyButton');
    if (addPropertyButton && !addPropertyButton.hasAttribute('data-event-listener')) {
        addPropertyButton.setAttribute('data-event-listener', 'true');
        addPropertyButton.addEventListener('click', function() {
            document.getElementById('addPropertyModal').style.display = 'block';
        });
    }

    const closeButton = document.querySelector('#addPropertyModal .close');
    if (closeButton && !closeButton.hasAttribute('data-event-listener')) {
        closeButton.setAttribute('data-event-listener', 'true');
        closeButton.addEventListener('click', function() {
            document.getElementById('addPropertyForm').reset();
            document.getElementById('addPropertyModal').style.display = 'none';
        });
    }

    const addPropertyForm = document.getElementById('addPropertyForm');
    if (addPropertyForm && !addPropertyForm.hasAttribute('data-event-listener')) {
        addPropertyForm.setAttribute('data-event-listener', 'true');
        addPropertyForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const name = document.getElementById('propertyName').value;
            const description = document.getElementById('propertyDescription').value;
            const price = document.getElementById('propertyPrice').value;
            const location = document.getElementById('propertyLocation').value;

            fetch("api/properties", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    "Authorization": `Bearer ${localStorage.getItem("token")}`
                },
                body: JSON.stringify({ name: name, description: description, price: price, location: location })
            })
                .then(response => response.json())
                .then(data => {
                    fetchProperties();
                    document.getElementById('addPropertyModal').style.display = 'none';
                });
        });
    }

    fetchProperties();
});

function fetchProperties() {
    fetch("api/properties", {
        headers: {
            "Authorization": `Bearer ${localStorage.getItem("token")}`
        }
    })
        .then(response => response.json())
        .then(data => {
            const propertiesList = document.getElementById("propertiesList");
            propertiesList.innerHTML = data.properties.map(property => `
            <div>
                <h3>${property.name}</h3>
                <p>${property.description}</p>
                <button class="deleteButton" data-property-id="${property.id}">Delete</button>
            </div>
        `).join('');

            const deleteButtons = document.querySelectorAll('.deleteButton');
            deleteButtons.forEach(button => {
                if (!button.hasAttribute('data-event-listener')) {
                    button.setAttribute('data-event-listener', 'true');
                    button.addEventListener('click', function() {
                        const propertyId = this.getAttribute('data-property-id');
                        deleteProperty(propertyId);
                    });
                }
            });
        });
}

function deleteProperty(propertyId) {
    fetch("api/properties", {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            "Authorization": `Bearer ${localStorage.getItem("token")}`
        },
        body: JSON.stringify({ propertyId: propertyId })
    })
        .then(response => response.json())
        .then(data => {
            fetchProperties();
        });
}
document.addEventListener("DOMContentLoaded", function() {
    const token = localStorage.getItem("token");
    const navbar = document.getElementById("navbar");
    const loginBtn = document.getElementById("loginBtn");
    const signupBtn = document.getElementById("signupBtn");
    const propertiesBtn = document.getElementById("propertiesBtn");

    if (token) {
        loginBtn.style.display = "none";
        signupBtn.style.display = "none";
    } else {
        loginBtn.style.display = "block";
        signupBtn.style.display = "block";
    }

    if (!token && window.location.pathname === "/properties.php") {
        propertiesBtn.style.display = "none";
    }
});
