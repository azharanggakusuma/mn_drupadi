<nav class="navbar bg-base-100 fixed top-0 z-[1000] shadow-md backdrop-blur">
  <div class="navbar-start">
    <div class="dropdown" id="menuDropdown">
      <div tabindex="0" role="button" class="btn btn-ghost btn-circle" onclick="toggleDropdown('menuDropdown')">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
        </svg>
      </div>
      <ul
        class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52 hidden transition-all duration-300"
        id="menuDropdownContent">
        <li><a href="../index.php">Beranda</a></li>
        <li><a href="../index.php">Tentang PMM</a></li>
        <li><a href="../index.php">Modul Nusantara</a></li>
        <li><a href="../index.php">Our Team</a></li>
        <li><a href="../index.php">FAQ</a></li>
        <li><a href="../index.php">Kontak</a></li>
      </ul>
    </div>
  </div>
  <div class="navbar-center">
    <img src="../assets/img/pmm.png" alt="" width="150px" height="150px" />
    <span class="text-black mx-3">|</span>
    <img src="../assets/img/drupadi.jpg" alt="" width="35px" height="35px" />
  </div>
  <div class="navbar-end relative">
    <div>
      <a href="../admin/dist/auth/form_login.php" tabindex="0" class="btn btn-ghost btn-circle" target="_blank">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" fill="none" stroke="currentColor"
          xmlns="http://www.w3.org/2000/svg">
          <path d="M15 4H18C19.1046 4 20 4.89543 20 6V18C20 19.1046 19.1046 20 18 20H15M11 16L15 12M15 12L11 8M15 12H3"
            stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </a>
    </div>
  </div>
</nav>

<script>
  function toggleDropdown(dropdownId) {
    var dropdownContent = document.getElementById(dropdownId + 'Content');
    dropdownContent.classList.toggle('hidden');
  }
</script>