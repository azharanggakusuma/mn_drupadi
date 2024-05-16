<?php
include "../../conn.php";

session_start();

if (!isset($_SESSION['username'])) {
  header("location: auth/form_login.php");
  exit();
}

$username = $_SESSION['username'];

$login = "SELECT * FROM tb_login WHERE username = '$username'";
$dataLogin = mysqli_query($conn, $login);
$user = mysqli_fetch_assoc($dataLogin);

// Mengambil informasi spesifik
$username = $user['username'];
$password = $user['password'];
$fullname = $user['fullname'];
$id = $user['id'];

// Jika username adalah "admin", izinkan akses ke semua data
if ($username === "admin") {
  // Ambil semua data kegiatan
  $sql = "SELECT * FROM tb_kegiatan";
} else {
  // Dapatkan ID pengguna dari database
  $query = "SELECT id FROM tb_login WHERE username = '$username'";
  $result = $conn->query($query);
  $row = $result->fetch_assoc();
  $user_id = $row['id'];

  // Ambil data kegiatan yang hanya dimiliki oleh pengguna yang sedang login
  $sql = "SELECT * FROM tb_kegiatan WHERE user_id = '$user_id'";
}

$dataKegiatan = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en" class="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>Dashboard - Administrator</title>

  <!-- Tailwind is included -->
  <link rel="stylesheet" href="css/main.css?v=1652870200386">
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Icon -->
  <link rel="shortcut icon" href="../../assets/img/pmm-2.png" type="image/x-icon">

  <!-- Swalert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <!-- Animate CSS -->
  <link href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css" />

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130795909-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());
    gtag('config', 'UA-130795909-1');
  </script>

  <style>
    #loading {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 9999;
      /* Pastikan z-index lebih tinggi dari konten lain */
    }
  </style>
</head>

<body>

  <div id="app" class="hidden animate__animated animate__fadeIn animate__delay-0.5s">

    <nav id="navbar-main" class="navbar is-fixed-top">
      <div class="navbar-brand">
        <a class="navbar-item mobile-aside-button">
          <span class="icon"><i class="mdi mdi-forwardburger mdi-24px"></i></span>
        </a>
        <div class="navbar-item">
          <div class="control"><input placeholder="Search everywhere..." class="input"></div>
        </div>
      </div>
      <div class="navbar-brand is-right">
        <a class="navbar-item --jb-navbar-menu-toggle" data-target="navbar-menu">
          <span class="icon"><i class="mdi mdi-dots-vertical mdi-24px"></i></span>
        </a>
      </div>
      <div class="navbar-menu" id="navbar-menu">
        <div class="navbar-end">
          <div class="navbar-item dropdown has-divider has-user-avatar">
            <a class="navbar-link">
              <div class="user-avatar">
                <img src="../../assets/img/people.png" alt="Administartor" class="rounded-full">
              </div>
              <div class="is-user-name"><span>
                  <?php echo $user['fullname']; ?>
                </span></div>
              <span class="icon"><i class="mdi mdi-chevron-down"></i></span>
            </a>
            <div class="navbar-dropdown">
              <a href="profile.html" class="navbar-item">
                <span class="icon"><i class="mdi mdi-account"></i></span>
                <span>My Profile</span>
              </a>
              <a class="navbar-item">
                <span class="icon"><i class="mdi mdi-settings"></i></span>
                <span>Settings</span>
              </a>
              <a class="navbar-item">
                <span class="icon"><i class="mdi mdi-email"></i></span>
                <span>Messages</span>
              </a>
              <hr class="navbar-divider">
              <a class="navbar-item" onclick="showLogoutConfirmation()">
                <span class="icon"><i class="mdi mdi-logout"></i></span>
                <span>Log Out</span>
              </a>
            </div>
          </div>
          <a href="https://justboil.me/tailwind-admin-templates/free-dashboard/"
            class="navbar-item has-divider desktop-icon-only">
            <span class="icon"><i class="mdi mdi-help-circle-outline"></i></span>
            <span>About</span>
          </a>
          <a href="https://github.com/azharanggakusuma" class="navbar-item has-divider desktop-icon-only">
            <span class="icon"><i class="mdi mdi-github-circle"></i></span>
            <span>GitHub</span>
          </a>
          <a title="Log out" id="logout" class="navbar-item desktop-icon-only" onclick="showLogoutConfirmation()">
            <span class="icon"><i class="mdi mdi-logout"></i></span>
            <span>Log out</span>
          </a>
        </div>
      </div>
    </nav>

    <aside class="aside is-placed-left is-expanded">
      <div class="aside-tools">
        <div>
          ADMIN <b class="font-black">PANEL</b>
        </div>
      </div>
      <div class="menu is-menu-main">
        <p class="menu-label">General</p>
        <ul class="menu-list">
          <li class="active">
            <a href="index.php">
              <span class="icon"><i class="mdi mdi-desktop-mac"></i></span>
              <span class="menu-item-label">Dashboard</span>
            </a>
          </li>

          <li>
            <a href="profile.php">
              <span class="icon"><i class="mdi mdi-account-circle"></i></span>
              <span class="menu-item-label">Profile</span>
            </a>
          </li>
        </ul>
        <p class="menu-label">About</p>
        <ul class="menu-list">
          <li>
            <a href="https://justboil.me/tailwind-admin-templates/free-dashboard/" class="has-icon">
              <span class="icon"><i class="mdi mdi-help-circle"></i></span>
              <span class="menu-item-label">About</span>
            </a>
          </li>
          <li>
            <a href="https://github.com/azharanggakusuma" class="has-icon">
              <span class="icon"><i class="mdi mdi-github-circle"></i></span>
              <span class="menu-item-label">GitHub</span>
            </a>
          </li>
        </ul>
      </div>
    </aside>

    <section class="is-title-bar">
      <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
        <ul>
          <li>Admin</li>
          <li>Dashboard</li>
        </ul>

        <?php
        // Memeriksa apakah pengguna adalah admin
        if ($username === "admin") {
          // Ambil nilai saat ini dari database
          $queryCurrentStatus = "SELECT status_maintenance FROM tb_maintenance";
          $resultCurrentStatus = mysqli_query($conn, $queryCurrentStatus);

          if ($resultCurrentStatus) {
            $row = mysqli_fetch_assoc($resultCurrentStatus);
            $currentMaintenanceStatus = $row['status_maintenance'];
          } else {
            // Penanganan kesalahan jika tidak dapat mengambil status dari database
            $currentMaintenanceStatus = 0; // Atur default ke 0 jika ada kesalahan
            echo "Gagal mendapatkan nilai saat ini: " . mysqli_error($conn);
          }
          ?>
          <!-- Fitur Maintenance -->
          <button id="maintenanceButton"
            class="flex items-center button <?php echo $currentMaintenanceStatus == 1 ? 'red' : 'blue'; ?> middle none rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
            onclick="toggleMaintenance()">
            <span class="icon"><i class="mdi mdi-settings"></i></span>
            <span id="maintenanceButtonText" class="ml-1">
              <?php echo $currentMaintenanceStatus == 1 ? 'End Maintenance' : 'Maintenance'; ?>
            </span>
          </button>
          <?php
        }
        ?>

        <script>
          function toggleMaintenance() {
            // Redirect to update_maintenance.php without action parameter
            fetch('update_maintenance.php')
              .then(response => response.text())
              .then(data => {
                console.log(data);

                // Display SweetAlert on successful maintenance status update
                Swal.fire({
                  icon: 'success',
                  title: 'Success!',
                  text: data,
                  timer: 2000,
                  timerProgressBar: true,
                  showConfirmButton: false,
                  didDestroy: () => {
                    // Reload the page after the SweetAlert has disappeared
                    location.reload(true);
                  }
                });
              })
              .catch(error => {
                console.error('Error:', error);

                // Display SweetAlert if an error occurs
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'An error occurred. Please try again.',
                  timer: 2000,
                  timerProgressBar: true,
                  showConfirmButton: false,
                  didDestroy: () => {
                    // Reload the page after the SweetAlert has disappeared
                    location.reload(true);
                  }
                });
              });
          }
        </script>
      </div>
    </section>

    <section class="section main-section">
      <div class="grid gap-6 grid-cols-1 md:grid-cols-3 mb-6">
        <div class="card">
          <div class="card-content">
            <div class="flex items-center justify-between">
              <?php
              // Tanggal mulai
              $tanggal_mulai = strtotime('2024-02-10');

              // Tanggal sekarang
              $tanggal_sekarang = time(); // Waktu saat ini dalam detik
              
              // Cek apakah Not Started
              if ($tanggal_sekarang < $tanggal_mulai) {
                $status_pesan = 'Not Started';
                $ukuran_teks = 'font-size: large;'; // Ubah ukuran teks menjadi lebih kecil
              } else {
                // Hitung selisih waktu dalam minggu
                $selisih_waktu = $tanggal_sekarang - $tanggal_mulai;
                $total_minggu = floor($selisih_waktu / (60 * 60 * 24 * 7));
                $status_pesan = $total_minggu;
                $ukuran_teks = ''; // Biarkan ukuran teks seperti biasa
              }

              // Tampilkan total minggu atau pesan "Not Started" dengan ukuran teks yang sesuai
              echo '<div class="widget-label">
                    <h3>
                      Week
                    </h3>
                    <h1 style="' . $ukuran_teks . '">
                      ' . $status_pesan . '
                    </h1>
                  </div>';
              ?>

              <span class="icon widget-icon text-green-500"><i class="mdi mdi-calendar mdi-48px"></i></span>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-content">
            <div class="flex items-center justify-between">
              <div class="widget-label">
                <?php
                // Mendapatkan jumlah data kegiatan
                if ($username === "admin") {
                  // Jika admin, hitung total kegiatan tanpa memperhatikan user_id
                  $query = "SELECT COUNT(*) AS total_activity FROM tb_kegiatan";
                } else {
                  // Jika bukan admin, hitung total kegiatan berdasarkan user_id
                  $query = "SELECT COUNT(*) AS total_activity FROM tb_kegiatan WHERE user_id = '$user_id'";
                }
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                $total_activity = $row['total_activity'] ?? 0; // Jika tidak ada data, atur default ke 0
                ?>
                <h3>
                  Activity
                </h3>
                <h1>
                  <?php echo $total_activity; ?>
                </h1>
              </div>
              <span class="icon widget-icon text-blue-500"><i class="mdi mdi-clock-outline mdi-48px"></i></span>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-content">
            <div class="flex items-center justify-between">
              <div class="widget-label">
                <?php
                // Mendapatkan jumlah data
                $query = "SELECT COUNT(*) AS total_pengunjung FROM tb_pengunjung";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                $total_pengunjung = $row['total_pengunjung'];
                ?>
                <h3>
                  Visitors
                </h3>
                <h1>
                  <?php echo $total_pengunjung; ?>
                </h1>
              </div>
              <span class="icon widget-icon text-red-500"><i class="mdi mdi-account-group mdi-48px"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="notification blue">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
          <div>
            <span class="icon"><i class="mdi mdi-buffer"></i></span>
            <b>Activity Table</b>
          </div>
          <button type="button" class="bg-white button small textual --jb-notification-dismiss">Dismiss</button>
        </div>
      </div>

      <div class="card has-table">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-earth"></i></span>
            Modul Nusantara
          </p>
          <a href="form_add.php" id="add" class="card-header-icon">
            <span class="icon"><i class="mdi mdi-plus"></i></span>
          </a>
        </header>
        <div class="card-content">
          <table>
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th>Picture</th>
                <th>Author</th>
                <th>Title</th>
                <th>Date</th>
                <th>Location</th>
                <th>Log Book</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($dataKegiatan as $data) { ?>
                <tr>
                  <td class="text-center">
                    <?php echo $no++ ?>
                  </td>
                  <td><img src="uploads/<?php echo $data['gambar_kegiatan'] ?>" width="40px" height="40px"
                      class="rounded">
                  </td>
                  <td>
                    <?php echo $data['penulis'] ?>
                  </td>
                  <td>
                    <?php echo $data['judul_kegiatan'] ?>
                  </td>
                  <td>
                    <span class="text-sm text-gray-500">
                      <?php
                      // Ambil nilai tanggal dari $kegiatan['tanggal_kegiatan']
                      $tanggal_kegiatan = $data['tanggal_kegiatan'];

                      // Ubah format tanggal
                      $tanggal_format = date("d F Y", strtotime($tanggal_kegiatan));

                      echo $tanggal_format;
                      ?>
                    </span>

                  </td>
                  <td>
                    <?php echo $data['lokasi_kegiatan'] ?>
                  </td>
                  <td>
                    <?php
                    switch ($data['status_logbook']) {
                      case 'In Progress':
                        echo '<span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full dark:bg-blue-500/10 dark:text-blue-500">
                        <svg class="flex-shrink-0 w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="2" y2="6"/><line x1="12" x2="12" y1="18" y2="22"/><line x1="4.93" x2="7.76" y1="4.93" y2="7.76"/><line x1="16.24" x2="19.07" y1="16.24" y2="19.07"/><line x1="2" x2="6" y1="12" y2="12"/><line x1="18" x2="22" y1="12" y2="12"/><line x1="4.93" x2="7.76" y1="19.07" y2="16.24"/><line x1="16.24" x2="19.07" y1="7.76" y2="4.93"/></svg>
                        In Progress
                      </span>';
                        break;

                      case 'Completed':
                        echo '<span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-green-100 text-green-800 rounded-full dark:bg-green-500/10 dark:text-green-500">
                        <svg class="flex-shrink-0 w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                          <polyline points="22 4 12 14.01 9 11.01" />
                        </svg>
                        Completed
                      </span>';
                        break;

                      case 'Pending':
                        echo '<span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full dark:bg-yellow-500/10 dark:text-yellow-500">
                        <svg class="flex-shrink-0 w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <circle cx="12" cy="12" r="10" />
                          <line x1="12" y1="8" x2="12" y2="12" />
                          <line x1="12" y1="16" x2="12" y2="16" />
                        </svg>
                        Pending
                      </span>';
                        break;

                      case 'Not Started':
                        echo '<span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-red-100 text-red-800 rounded-full dark:bg-red-500/10 dark:text-red-500">
                        <svg class="flex-shrink-0 w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                          <path d="M12 9v4" />
                          <path d="M12 17h.01" />
                        </svg>
                        Not Started
                      </span>';
                        break;

                      case 'Nothing':
                        echo '<span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs bg-gray-100 text-gray-800 rounded-full dark:bg-slate-500/20 dark:text-slate-400">
  <svg class="flex-shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"/><line x1="12" x2="12" y1="2" y2="12"/></svg>
  Nothing
</span>';
                        break;

                      default:
                        break;
                    }
                    ?>
                  </td>
                  <td class="actions-cell">
                    <div class="buttons right nowrap">
                      <a href="form_edit.php?id_kegiatan=<?php echo $data['id_kegiatan']; ?>" id="edit"
                        class="button small blue middle none rounded-lg bg-gray-900 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        type="button">
                        <span class="icon"><i class="mdi mdi-pencil"></i></span>
                      </a>

                      <button id="delete"
                        class="button small red middle none rounded-lg bg-gray-900 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        onclick="confirmDelete(<?php echo $data['id_kegiatan']; ?>)">
                        <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                      </button>
                    </div>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>

          <?php
          // Number of records per page
          $recordsPerPage = 10;

          // Current page
          if (isset($_GET['page']) && is_numeric($_GET['page'])) {
            $currentPage = $_GET['page'];
          } else {
            $currentPage = 1;
          }

          // Calculate the starting record for the current page
          $startFrom = ($currentPage - 1) * $recordsPerPage;

          // Query to fetch data from tb_kegiatan with pagination
          $query = "SELECT * FROM tb_kegiatan LIMIT $startFrom, $recordsPerPage";
          $result = mysqli_query($conn, $query);

          // Query to count total records
          $totalRecordsQuery = "SELECT COUNT(*) as total FROM tb_kegiatan";
          $totalRecordsResult = mysqli_query($conn, $totalRecordsQuery);
          $totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];

          // Calculate the total number of pages
          $totalPages = ceil($totalRecords / $recordsPerPage);
          ?>

          <!-- Pagination HTML -->
          <div class="table-pagination">
            <div class="flex items-center justify-between">
              <div class="buttons">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                  <button type="button" class="button <?php echo ($i == $currentPage) ? 'active' : ''; ?>"
                    onclick="window.location.href='?page=<?php echo $i; ?>'">
                    <?php echo $i; ?>
                  </button>
                <?php endfor; ?>
              </div>
              <small>Page
                <?php echo $currentPage; ?> of
                <?php echo $totalPages; ?>
              </small>
            </div>
          </div>

        </div>
      </div>
    </section>

    <footer class="footer">
      <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
        <div class="flex items-center justify-start space-x-3">
          <div>
            © 2024, PMM Undiksha
          </div>
          <a href="https://github.com/azharanggakusuma" style="height: 20px">
            <img src="https://img.shields.io/github/v/release/justboil/admin-one-tailwind?color=%23999">
          </a>
        </div>
      </div>
    </footer>

    <!--<div id="logout-modal" class="modal">
      <div class="modal-background --jb-modal-close"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title font-bold">Log Out</p>
        </header>
        <section class="modal-card-body">
          <p><b>Important Notice:</b> Deleting activities will result in the loss of associated data. Please consider
            this consequence before proceeding with deletion. All information related to the deleted activities, notes,
            or entries may be irreversibly lost. Ensure to make copies or backups of necessary data before proceeding
            with the deletion process.</p>
        </section>
        <footer class="modal-card-foot">
          <button class="button --jb-modal-close">Cancel</button>
          <a href="auth/logout.php" class="button red --jb-modal-close">Logout</a>
        </footer>
      </div>
    </div>-->

    <!--<div id="delete-modal" class="modal">
      <div class="modal-background --jb-modal-close"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title font-bold">Delete Activity</p>
        </header>
        <section class="modal-card-body">
          <p><b>Important Notice:</b> Deleting activities will result in the loss of associated data. Please consider
            this consequence before proceeding with deletion. All information related to the deleted activities, notes,
            or entries may be irreversibly lost. Ensure to make copies or backups of necessary data before proceeding
            with the deletion process.</p>
        </section>
        <footer class="modal-card-foot">
          <button class="button --jb-modal-close">Cancel</button>
          <a href="#" class="button red --jb-modal-close"
            onclick="deleteData(<?php //echo $data['id_kegiatan']; ?>); return false;">Delete</a>
        </footer>
      </div>
    </div>-->
  </div>

  <script>
    function showLogoutConfirmation() {
      Swal.fire({
        title: 'Log Out',
        text: 'Are you sure you want to log out?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Logout'
      }).then((result) => {
        if (result.isConfirmed) {
          // Menampilkan pesan sukses sebelum redirect
          Swal.fire({
            title: 'Success',
            text: 'Logout successful!',
            icon: 'success',
            timer: 2000, // Set timer untuk menutup otomatis dalam 2 detik
            timerProgressBar: true,
            showConfirmButton: false
          }).then(() => {
            // Redirect to logout script
            window.location.href = 'auth/logout.php';
          });
        } else {
          // Menampilkan pesan ketika logout dibatalkan
          Swal.fire({
            title: 'Cancelled',
            text: 'Logout operation has been cancelled.',
            icon: 'info'
          });
        }
      });
    }
  </script>

  <script>
    function confirmDelete(id) {
      Swal.fire({
        title: 'Delete Activity',
        html: '<b>Important Notice:</b> Deleting activities will result in the loss of associated data. Please consider this consequence before proceeding with deletion. All information related to the deleted activities, notes, or entries may be irreversibly lost. Ensure to make copies or backups of necessary data before proceeding with the deletion process.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Delete'
      }).then((result) => {
        if (result.isConfirmed) {
          // User konfirmasi untuk menghapus
          deleteData(id);
        } else {
          // Menampilkan pesan ketika delete dibatalkan
          Swal.fire({
            title: 'Cancelled',
            text: 'Delete operation has been cancelled.',
            icon: 'info'
          });
        }
      });
    }

    function deleteData(id) {
      fetch(`delete.php?id_kegiatan=${id}`)
        .then(response => {
          if (response.ok) {
            // Data dihapus sukses
            showSuccessAlert();
          } else {
            // Gagal menghapus data
            showErrorAlert();
          }
        })
        .catch(error => {
          // Terjadi kesalahan dalam pengiriman request
          console.error('Error:', error);
          showErrorAlert();
        })
        .finally(() => {
          // Setelah SweetAlert2 hilang, refresh halaman
          setTimeout(() => {
            location.reload();
          }, 2000); // Waktu delay sebelum refresh (dalam milidetik)
        });
    }

    function showSuccessAlert() {
      Swal.fire({
        title: 'Success',
        text: 'Data has been deleted successfully!',
        icon: 'success',
        timer: 2000,
        timerProgressBar: true,
        showConfirmButton: false
      });
    }

    function showErrorAlert() {
      Swal.fire({
        title: 'Error',
        text: 'Failed to delete data. Please try again later.',
        icon: 'error',
        timer: 2000,
        timerProgressBar: true,
        showConfirmButton: false
      });
    }
  </script>

  <div id="loading" class="flex items-center space-x-2 hidden">
    <div aria-label="Loading..." role="status">
      <!--<svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"
        stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"
        class="animate-spin w-8 h-8 stroke-slate-500">
        <path
          d="M12 3v3m6.366-.366-2.12 2.12M21 12h-3m.366 6.366-2.12-2.12M12 21v-3m-6.366.366 2.12-2.12M3 12h3m-.366-6.366 2.12 2.12">
        </path>
      </svg>-->
      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        class="animate-spin w-16 h-16 stroke-slate-500" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
        <circle cx="50" cy="50" r="32" stroke-width="8" stroke="#0E5FE9"
          stroke-dasharray="50.26548245743669 50.26548245743669" fill="none" stroke-linecap="round">
          <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" keyTimes="0;1"
            values="0 50 50;360 50 50"></animateTransform>
        </circle>
      </svg>
    </div>
    <!--<span class="text-lg font-medium text-slate-500">Loading...</span>-->
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const loadingElement = document.getElementById('loading');

      // Tampilkan loading saat halaman dimuat
      loadingElement.classList.remove('hidden');

      // Sembunyikan loading setelah halaman selesai dimuat
      window.addEventListener('load', function () {
        loadingElement.classList.add('hidden');

        // Tampilkan konten setelah loading selesai
        document.getElementById('app').classList.remove('hidden');
      });
    });
  </script>

  <script>
    const driver = window.driver.js.driver;

    // Fungsi untuk memeriksa apakah tur telah ditampilkan sebelumnya
    function isTourShown() {
      return localStorage.getItem('tourShown') === 'true';
    }

    // Jika tur belum ditampilkan sebelumnya, maka tampilkan tur
    if (!isTourShown()) {
      const driverObj = driver({
        showProgress: true,
        steps: [
          { popover: { title: 'Selamat Datang', description: 'Selamat datang di aplikasi kami! Ini adalah tur sederhana yang memperkenalkan fitur-fitur utama.' } },
          { element: '#logout', popover: { title: 'Tombol Logout', description: 'Tombol ini digunakan untuk keluar dari sesi pengguna saat ini.', side: "bottom", align: 'center' } },
          { element: '#maintenanceButton', popover: { title: 'Maintenance', description: 'Tombol ini digunakan untuk mengaktifkan atau menonaktifkan mode maintenance pada halaman.', side: "bottom", align: 'center' } },
          { element: '.grid-cols-1', popover: { title: 'Kartu Informasi', description: 'Kartu untuk menampilkan informasi.', side: "bottom", align: 'center' } },
          { element: '.card:nth-child(1)', popover: { title: 'Informasi Minggu', description: 'Informasi tentang minggu akan ditampilkan di sini.', side: "right", align: 'middle' } },
          { element: '.card:nth-child(2)', popover: { title: 'Informasi Aktivitas', description: 'Informasi tentang aktivitas akan ditampilkan di sini.', side: "right", align: 'middle' } },
          { element: '.card:nth-child(3)', popover: { title: 'Informasi Pengunjung', description: 'Informasi tentang pengunjung akan ditampilkan di sini.', side: "right", align: 'middle' } },
          { element: '#add', popover: { title: 'Tambah Data', description: 'Ini adalah tombol untuk menambahkan data baru ke dalam aplikasi.', side: "left", align: 'start' } },
          { element: '#edit', popover: { title: 'Edit Data', description: ' Ini adalah tombol untuk mengedit data yang sudah ada dalam aplikasi.', side: "bottom", align: 'start' } },
          { element: '#delete', popover: { title: 'Hapus Data', description: 'Ini adalah tombol untuk menghapus data yang sudah ada dalam aplikasi.', side: "bottom", align: 'start' } },
        ]
      });

      driverObj.drive();

      // Set status tur sebagai ditampilkan dalam penyimpanan lokal
      localStorage.setItem('tourShown', 'true');
    }
  </script>

  <!-- Scripts below are for demo only -->
  <script type="text/javascript" src="js/main.min.js?v=1652870200386"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
  <script type="text/javascript" src="js/chart.sample.min.js"></script>

  <script>
    !function (f, b, e, v, n, t, s) {
      if (f.fbq) return; n = f.fbq = function () {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
      n.queue = []; t = b.createElement(e); t.async = !0;
      t.src = v; s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
      'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '658339141622648');
    fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
      src="https://www.facebook.com/tr?id=658339141622648&ev=PageView&noscript=1" /></noscript>

  <!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

</body>

</html>