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

function showSelectedCombo($value_a, $value_b)
{
  if ($value_a == $value_b) {
    $view = "selected";
  } else {
    $view = "";
  }

  return $view;
}

if (isset($_GET['id_kegiatan'])) {
  $id_kegiatan = $_GET['id_kegiatan'];
  $result = "SELECT * FROM tb_kegiatan WHERE id_kegiatan = " . $id_kegiatan;

  $query = mysqli_query($conn, $result);
  $data = mysqli_fetch_array($query);

  $penulis = $data['penulis'];
  $judul_kegiatan = $data['judul_kegiatan'];
  $tanggal_kegiatan = $data['tanggal_kegiatan'];
  $lokasi_kegiatan = $data['lokasi_kegiatan'];
  $deskripsi_kegiatan = $data['deskripsi_kegiatan'];
  $dokumentasi_kegiatan = $data['dokumentasi_kegiatan'];
  $status_logbook = $data['status_logbook'];
  $gambar_kegiatan = $data['gambar_kegiatan'];
} else {
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en" class="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>Edit - Admin Dashboard</title>

  <!-- Tailwind is included -->
  <link rel="stylesheet" href="css/main.css?v=1652870200386">
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Icon -->
  <link rel="shortcut icon" href="../../assets/img/pmm-2.png" type="image/x-icon">

  <!-- Include SweetAlert scripts -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <!-- Animate CSS -->
  <link href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css" rel="stylesheet">

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
              <div class="is-user-name">
                <?php echo $user['fullname']; ?>
              </div>
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
          <li class="--set-active-index-html">
            <a href="index.php">
              <span class="icon"><i class="mdi mdi-desktop-mac"></i></span>
              <span class="menu-item-label">Dashboard</span>
            </a>
          </li>

          <li>
            <a href="index.php">
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
          <li>Dashboard</li>
          <li>Edit</li>
        </ul>
      </div>
    </section>

    <section class="section main-section">
      <div class="card mb-6">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-ballot"></i></span>
            Forms
          </p>
        </header>
        <div class="card-content">
          <form action="edit.php" method="post" enctype="multipart/form-data">
            <div class="field flex-col items-center">
              <label class="label mb-2">Picture</label>
              <img src="uploads/<?php echo $gambar_kegiatan; ?>" alt="" width="200px" class="mb-4">
              <div class="field-body mb-2">
                <label class="block">
                  <input type="file" class="block w-full text-sm text-gray-500
                      file:me-4 file:py-2 file:px-4
                      file:rounded-lg file:border-0
                      file:text-sm file:font-semibold
                      file:bg-blue-600 file:text-white
                      hover:file:bg-blue-700
                      file:disabled:opacity-50 file:disabled:pointer-events-none
                      dark:file:bg-blue-500
                      dark:hover:file:bg-blue-400
                    " name="gambar_kegiatan" id="gambar_kegiatan" accept="image/*"">
                  </label>
              </div>
              <p class=" help">
                  Just skip it if you don't want to change the image
                  </p>
              </div>

              <hr>

              <?php
              // Cek apakah pengguna adalah admin
              $isAdmin = ($username === "admin");

              // Ambil data kegiatan sesuai dengan peran pengguna
              if ($isAdmin) {
                ?>
                <div class=" field">
                  <label class="label">Author</label>
                  <div class="control">
                    <div class="select">
                      <select name="penulis" id="penulis"
                        class="peer h-full w-full rounded-[7px]  !border  !border-gray-300 border-t-transparent bg-transparent bg-white px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700  shadow-sm shadow-gray-900/5 outline outline-0 ring-4 ring-transparent transition-all placeholder:text-gray-500 placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2  focus:!border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 focus:ring-gray-900/10 disabled:border-0 disabled:bg-blue-gray-50"
                        required>
                        <?php
                        $query = "SELECT * FROM tb_login";
                        $dataUser = mysqli_query($conn, $query);
                        ?>
                        <!--<option value="Azharangga Kusuma" <?php //echo showSelectedCombo("Azharangga Kusuma", $penulis); ?>>
                          Azharangga Kusuma</option>
                        <option value="Arya Gunawan" <?php //echo showSelectedCombo("Arya Gunawan", $penulis); ?>>Arya
                          Gunawan
                        </option>-->

                        <!-- Looping through the data to generate options -->
                        <?php while ($user = mysqli_fetch_assoc($dataUser)): ?>
                          <option value="<?php echo $user['fullname']; ?>" <?php echo showSelectedCombo($user['fullname'], $penulis); ?>>
                            <?php echo $user['fullname']; ?>
                          </option>
                        <?php endwhile; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <?php
              } else {
                ?>
                <div class="field">
                  <label class="label">Author</label>
                  <div class="control">
                    <input name="penulis" id="penulis"
                      class="input peer h-full w-full rounded-[7px] !border !border-gray-300 border-t-transparent bg-transparent bg-white px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 shadow-sm shadow-gray-900/5 outline outline-0 ring-4 ring-transparent transition-all placeholder:text-gray-500 placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:!border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 focus:ring-gray-900/10 disabled:border-0 disabled:bg-blue-gray-50"
                      type="text" value="<?php echo $user['fullname'] ?>" readonly required>
                  </div>
                </div>
                <?php
              }
              ?>

              <!--<div class="field">
                <label class="label">Author</label>
                <div class="control">
                  <input name="penulis" id="penulis"
                    class="input peer h-full w-full rounded-[7px] !border !border-gray-300 border-t-transparent bg-transparent bg-white px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 shadow-sm shadow-gray-900/5 outline outline-0 ring-4 ring-transparent transition-all placeholder:text-gray-500 placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:!border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 focus:ring-gray-900/10 disabled:border-0 disabled:bg-blue-gray-50"
                    type="text" value="<?php //echo $username; ?>" readonly required>
                </div>
              </div>-->

              <!--<div class=" field">
                <label class="label">Author</label>
                <div class="control">
                  <div class="select">
                    <select name="penulis" id="penulis"
                      class="peer h-full w-full rounded-[7px]  !border  !border-gray-300 border-t-transparent bg-transparent bg-white px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700  shadow-sm shadow-gray-900/5 outline outline-0 ring-4 ring-transparent transition-all placeholder:text-gray-500 placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2  focus:!border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 focus:ring-gray-900/10 disabled:border-0 disabled:bg-blue-gray-50"
                      required>
                      <option value="Anonymous" <?php //echo showSelectedCombo("Anonymous", $penulis); ?>>Anonymous
                      </option>
                      <option value="Azharangga Kusuma" <?php //echo showSelectedCombo("Azharangga Kusuma", $penulis); ?>>
                        Azharangga Kusuma</option>
                      <option value="Arya Gunawan" <?php //echo showSelectedCombo("Arya Gunawan", $penulis); ?>>Arya
                        Gunawan
                      </option>
                    </select>
                  </div>
                </div>
              </div>-->

              <div class="field">
                <label class="label">Title</label>
                <div class="control">
                  <div class="select">
                    <select name="judul_kegiatan" id="judul_kegiatan"
                      class="peer h-full w-full rounded-[7px]  !border  !border-gray-300 border-t-transparent bg-transparent bg-white px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700  shadow-sm shadow-gray-900/5 outline outline-0 ring-4 ring-transparent transition-all placeholder:text-gray-500 placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2  focus:!border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 focus:ring-gray-900/10 disabled:border-0 disabled:bg-blue-gray-50"
                      required>
                      <option value="Keberangkatan" <?php echo showSelectedCombo("Keberangkatan", $judul_kegiatan); ?>>
                        Keberangkatan</option>
                      <option value="Penyambutan" <?php echo showSelectedCombo("Penyambutan", $judul_kegiatan); ?>>
                        Penyambutan</option>
                      <option value="Minggu Ke-1" <?php echo showSelectedCombo("Minggu Ke-1", $judul_kegiatan); ?>>
                        Minggu Ke-1</option>
                      <option value="Minggu Ke-2" <?php echo showSelectedCombo("Minggu Ke-2", $judul_kegiatan); ?>>
                        Minggu Ke-2</option>
                      <option value="Minggu Ke-3" <?php echo showSelectedCombo("Minggu Ke-3", $judul_kegiatan); ?>>
                        Minggu Ke-3</option>
                      <option value="Minggu Ke-4" <?php echo showSelectedCombo("Minggu Ke-4", $judul_kegiatan); ?>>
                        Minggu Ke-4</option>
                      <option value="Minggu Ke-5" <?php echo showSelectedCombo("Minggu Ke-5", $judul_kegiatan); ?>>
                        Minggu Ke-5</option>
                      <option value="Minggu Ke-6" <?php echo showSelectedCombo("Minggu Ke-6", $judul_kegiatan); ?>>
                        Minggu Ke-6</option>
                      <option value="Minggu Ke-7" <?php echo showSelectedCombo("Minggu Ke-7", $judul_kegiatan); ?>>
                        Minggu Ke-7</option>
                      <option value="Minggu Ke-8" <?php echo showSelectedCombo("Minggu Ke-8", $judul_kegiatan); ?>>
                        Minggu Ke-8</option>
                      <option value="Minggu Ke-9" <?php echo showSelectedCombo("Minggu Ke-9", $judul_kegiatan); ?>>
                        Minggu Ke-9</option>
                      <option value="Minggu Ke-10" <?php echo showSelectedCombo("Minggu Ke-10", $judul_kegiatan); ?>>
                        Minggu Ke-10</option>
                      <option value="Minggu Ke-11" <?php echo showSelectedCombo("Minggu Ke-11", $judul_kegiatan); ?>>
                        Minggu Ke-11</option>
                      <option value="Minggu Ke-12" <?php echo showSelectedCombo("Minggu Ke-12", $judul_kegiatan); ?>>
                        Minggu Ke-12</option>
                      <option value="Minggu Ke-13" <?php echo showSelectedCombo("Minggu Ke-13", $judul_kegiatan); ?>>
                        Minggu Ke-13</option>
                      <option value="Minggu Ke-14" <?php echo showSelectedCombo("Minggu Ke-14", $judul_kegiatan); ?>>
                        Minggu Ke-14</option>
                      <option value="Minggu Ke-15" <?php echo showSelectedCombo("Minggu Ke-15", $judul_kegiatan); ?>>
                        Minggu Ke-15</option>
                      <option value="Minggu Ke-16" <?php echo showSelectedCombo("Minggu Ke-16", $judul_kegiatan); ?>>
                        Minggu Ke-16</option>
                    </select>
                  </div>
                </div>
              </div>

              <?php
              date_default_timezone_set('Asia/Jakarta');

              // Jika ada data waktu postingan sebelumnya, gunakan itu, jika tidak, gunakan waktu sekarang
              $created_at = isset($post['created_at']) ? $post['created_at'] : date('Y-m-d H:i:s');
              ?>
              
              <input type="hidden" id="created_at" name="created_at" value="<?php echo $created_at; ?>">

              <div class="field">
                <label class="label">Date</label>
                <div class="control">
                  <input name="tanggal_kegiatan" id="tanggal_kegiatan"
                    class="input peer h-full w-full rounded-[7px]  !border  !border-gray-300 border-t-transparent bg-transparent bg-white px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700  shadow-sm shadow-gray-900/5 outline outline-0 ring-4 ring-transparent transition-all placeholder:text-gray-500 placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2  focus:!border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 focus:ring-gray-900/10 disabled:border-0 disabled:bg-blue-gray-50"
                    type="date" value="<?php echo $tanggal_kegiatan; ?>">
                </div>
              </div>

              <div class="field">
                <label class="label">Location</label>
                <div class="control">
                  <input name="lokasi_kegiatan" id="lokasi_kegiatan"
                    class="input peer h-full w-full rounded-[7px]  !border  !border-gray-300 border-t-transparent bg-transparent bg-white px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700  shadow-sm shadow-gray-900/5 outline outline-0 ring-4 ring-transparent transition-all placeholder:text-gray-500 placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2  focus:!border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 focus:ring-gray-900/10 disabled:border-0 disabled:bg-blue-gray-50"
                    type="text" value="<?php echo $lokasi_kegiatan; ?>">
                </div>
              </div>

              <div class="field">
                <label class="label">Description</label>
                <div class="control">
                  <textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan"
                    class="textarea peer h-40 w-full rounded-[7px]  !border  !border-gray-300 border-t-transparent bg-transparent bg-white px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700  shadow-sm shadow-gray-900/5 outline outline-0 ring-4 ring-transparent transition-all placeholder:text-gray-500 placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2  focus:!border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 focus:ring-gray-900/10 disabled:border-0 disabled:bg-blue-gray-50"><?php echo $deskripsi_kegiatan; ?></textarea>
                </div>
                <p class="help">
                  Click the following button if you want to add a new paragraph/line. <span
                    onclick="addLineBreak()"><b>Add Line/Paragraph</b></span>
                </p>
              </div>

              <script>
                function addLineBreak() {
                  var textarea = document.getElementById("deskripsi_kegiatan");
                  var start = textarea.selectionStart;
                  var end = textarea.selectionEnd;
                  var text = textarea.value;

                  // Jika ada teks yang dipilih, tambahkan <br> setelahnya
                  if (start !== end) {
                    textarea.value = text.substring(0, start) + "<br>" + text.substring(end);
                    textarea.setSelectionRange(end + 4, end + 4);
                  } else {
                    // Jika tidak ada teks yang dipilih, tambahkan <br> di posisi kursor saat ini
                    textarea.value = text.substring(0, start) + "<br>" + text.substring(start);
                    textarea.setSelectionRange(start + 4, start + 4);
                  }
                } 
              </script>

              <div class="field">
                <label class="label">Documentation</label>
                <div class="control">
                  <input name="dokumentasi_kegiatan" id="dokumentasi_kegiatan"
                    class="input peer h-full w-full rounded-[7px]  !border  !border-gray-300 border-t-transparent bg-transparent bg-white px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700  shadow-sm shadow-gray-900/5 outline outline-0 ring-4 ring-transparent transition-all placeholder:text-gray-500 placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2  focus:!border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 focus:ring-gray-900/10 disabled:border-0 disabled:bg-blue-gray-50"
                    type="text" value="<?php echo $dokumentasi_kegiatan; ?>">
                </div>
              </div>

              <div class="field">
                <label class="label">Status Log Book</label>
                <div class="control">
                  <div class="select">
                    <select name="status_logbook" id="status_logbook"
                      class="peer h-full w-full rounded-[7px]  !border  !border-gray-300 border-t-transparent bg-transparent bg-white px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700  shadow-sm shadow-gray-900/5 outline outline-0 ring-4 ring-transparent transition-all placeholder:text-gray-500 placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2  focus:!border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 focus:ring-gray-900/10 disabled:border-0 disabled:bg-blue-gray-50"
                      required>
                      <option value="Not Started" <?php echo showSelectedCombo("Not Started", $status_logbook); ?>>Not
                        Started</option>
                      <option value="In Progress" <?php echo showSelectedCombo("In Progress", $status_logbook); ?>>In
                        Progress</option>
                      <option value="Pending" <?php echo showSelectedCombo("Pending", $status_logbook); ?>>Pending
                      </option>
                      <option value="Completed" <?php echo showSelectedCombo("Completed", $status_logbook); ?>>Completed
                      </option>
                      <option value="Nothing" <?php echo showSelectedCombo("Nothing", $status_logbook); ?>>Nothing
                      </option>
                    </select>
                  </div>
                </div>
              </div>
              <hr>

              <div class="field grouped">
                <div class="control">
                  <input type="hidden" name="id_kegiatan" value="<?php echo $id_kegiatan; ?>">
                  <input type="submit" value="Update"
                    class="button green middle none rounded-lg bg-gray-900 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                </div>
                <div class="control">
                  <a href="index.php"
                    class="button red middle none rounded-lg bg-gray-900 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                    Back
                  </a>
                </div>
              </div>
          </form>
        </div>
      </div>
    </section>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');

        if (status === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Data updated successfully.',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false
          }).then(function () {
            window.location.href = 'index.php';
          });
        } else if (status === 'error') {
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Failed to update data.',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false
          }).then(function () {
            window.location.href = 'index.php';
          });
        }
      });
    </script>

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
  </div>

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

  <!-- Scripts below are for demo only -->
  <script type="text/javascript" src="js/main.min.js?v=1652870200386"></script>

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