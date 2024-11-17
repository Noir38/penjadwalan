document.addEventListener("DOMContentLoaded", function () {
    // Sidebar
    fetch("../../components/sidebar/sidebar-admin.html") // Arahkan ke path absolut
        .then(response => response.text())
        .then(data => document.getElementById("sidebar").innerHTML = data)
        .catch(error => console.error("Error:", error));

    // Navbar
    fetch("../../components/navbar/navbar.html") // Arahkan ke path absolut
        .then(response => response.text())
        .then(data => document.getElementById("navbar").innerHTML = data)
        .catch(error => console.error("Error:", error));
});

async function fetchUserData() {
  try {
    // Kirim permintaan ke endpoint /user-data
    const response = await fetch('http://localhost:8000/user-data', {
      method: 'GET',
      headers: {
        'Accept': 'application/json',
        'Authorization': `Bearer ${localStorage.getItem('token')}` // Sertakan token jika diperlukan
      },
      credentials: 'include' // Sertakan cookie untuk sesi Laravel jika login dengan sesi
    });

    // Jika status respon tidak 200, tampilkan error
    if (!response.ok) {
      console.error('User not authenticated or other error');
      return;
    }

    // Parse respon menjadi JSON
    const data = await response.json();

    // Periksa status dan isi data pengguna jika ada
    if (data.status === 'success') {
      document.getElementById('userName').textContent = data.data.name;
      document.getElementById('userEmail').textContent = data.data.email;
    } else {
      console.error(data.message);
    }
  } catch (error) {
    console.error('Error fetching user data:', error);
  }
}

// Panggil fungsi fetchUserData saat halaman dimuat
window.addEventListener('load', fetchUserData);

  