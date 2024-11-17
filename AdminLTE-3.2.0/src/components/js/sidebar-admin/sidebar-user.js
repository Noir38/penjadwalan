document.addEventListener("DOMContentLoaded", function () {
    // Sidebar
    fetch("../../components/sidebar/sidebar-user.html") // Arahkan ke path absolut
        .then(response => response.text())
        .then(data => document.getElementById("sidebar").innerHTML = data)
        .catch(error => console.error("Error:", error));

    // Navbar
    fetch("../../components/navbar/navbar.html") // Arahkan ke path absolut
        .then(response => response.text())
        .then(data => document.getElementById("navbar").innerHTML = data)
        .catch(error => console.error("Error:", error));
});

document.addEventListener("DOMContentLoaded", function () {
    const id = localStorage.getItem("id"); // Ambil id dari localStorage
  
    if (id) {
      // Fetch user data from API
      fetch(`http://127.0.0.1:8000/api/user/${id}`)
        .then(response => response.json())
        .then(data => {
          if (data && data.name) {
            document.getElementById("username").textContent = data.name;
            document.getElementById("userEmail").textContent = data.email;
           
          }
        })
        .catch(error => {
          console.error("Error fetching user data:", error);
          document.getElementById("username").textContent = "Error";
        });
    } else {
      console.error("User ID not found in localStorage");
    }
  });