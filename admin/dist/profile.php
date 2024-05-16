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
?>

<!DOCTYPE html>
<html lang="en" class="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile - Administrator</title>

  <!-- Tailwind is included -->
  <link rel="stylesheet" href="css/main.css?v=1652870200386">
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Icon -->
  <link rel="shortcut icon" href="../../assets/img/logo-pmm-2.png" type="image/x-icon">

  <!-- Swalert2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.all.min.js"></script>

  <!-- Animate CSS -->
  <link href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css" rel="stylesheet">

  <!-- Library AOS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

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
              <div class="is-user-name"><span>Administartor</span></div>
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
          <a title="Log out" class="navbar-item desktop-icon-only" onclick="showLogoutConfirmation()">
            <span class="icon"><i class="mdi mdi-logout"></i></span>
            <span>Log out</span>
          </a>
        </div>
      </div>
    </nav>

    <aside class="aside is-placed-left is-expanded">
      <div class="aside-tools">
        <div>
          Admin <b class="font-black">Pro</b>
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
          <li>Profile</li>
        </ul>
      </div>
    </section>

    <section class="section main-section">
      <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 mb-6">
        <div class="card">
          <header class="card-header">
            <p class="card-header-title">
              <span class="icon"><i class="mdi mdi-account-circle"></i></span>
              Edit Profile
            </p>
          </header>
          <div class="card-content">
            <form>
              <div class="field">
                <label class="label">Avatar</label>
                <div class="field-body">
                  <div class="field file">
                    <label class="upload control">
                      <a class="button blue">
                        Upload
                      </a>
                      <input type="file">
                    </label>
                  </div>
                </div>
              </div>
              <hr>
              <div class="field">
                <label class="label">Name</label>
                <div class="field-body">
                  <div class="field">
                    <div class="control">
                      <input type="text" autocomplete="on" name="name" value="<?php echo $fullname ?>" class="input"
                        required>
                    </div>
                    <p class="help">Required. Your name</p>
                  </div>
                </div>
              </div>
              <div class="field">
                <label class="label">Password</label>
                <div class="field-body">
                  <div class="field">
                    <div class="control">
                      <input type="password" autocomplete="on" id="password" name="password"
                        value="<?php echo $password ?>" class="input" required>
                      <button type="button" onclick="togglePasswordVisibility()"
                        class="absolute top-0 end-0 p-3.5 rounded-e-md dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                        <svg class="flex-shrink-0 w-3.5 h-3.5 text-gray-400 dark:text-neutral-600" width="24"
                          height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                          stroke-linecap="round" stroke-linejoin="round">
                          <path class="password-hidden" d="M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                          <path class="password-hidden"
                            d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68" />
                          <path class="password-hidden"
                            d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61" />
                          <line class="password-hidden" x1="2" x2="22" y1="2" y2="22" />
                          <path class="password-shown hidden" d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                          <circle class="password-shown hidden" cx="12" cy="12" r="3" />
                        </svg>
                      </button>
                    </div>
                    <p class="help">Required. Your password</p>
                  </div>
                  <script>
                    function togglePasswordVisibility() {
                      var passwordInput = document.getElementById("password");
                      var passwordIcons = document.querySelectorAll(".password-hidden, .password-shown");

                      if (passwordInput.type === "password") {
                        passwordInput.type = "text";
                        passwordIcons.forEach(icon => icon.classList.remove("hidden"));
                      } else {
                        passwordInput.type = "password";
                        passwordIcons.forEach(icon => icon.classList.add("hidden"));
                      }
                    }
                  </script>
                </div>
              </div>
              <hr>
              <div class="field">
                <div class="control">
                  <button type="submit" class="button green">
                    Submit
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="card">
          <header class="card-header">
            <p class="card-header-title">
              <span class="icon"><i class="mdi mdi-account"></i></span>
              Profile
            </p>
          </header>
          <div class="card-content">
            <div class="image w-48 h-48 mx-auto">
              <img src="../../assets/img/people.png" alt="" class="rounded-full">
            </div>
            <hr>
            <div class="field">
              <label class="label">Name</label>
              <div class="control">
                <input type="text" readonly value="<?php echo $fullname ?>" class="input is-static">
              </div>
            </div>
            <hr>
            <div class="field">
              <label class="label">Password</label>
              <div class="control">
                <input type="text" readonly value="<?php echo $password ?>" class="input">
              </div>
            </div>

          </div>
        </div>
      </div>

      <!--<div class="card">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-lock"></i></span>
          Change Password
        </p>
      </header>
      <div class="card-content">
        <form>
          <div class="field">
            <label class="label">Current password</label>
            <div class="control">
              <input type="password" name="password_current" autocomplete="current-password" class="input" required>
            </div>
            <p class="help">Required. Your current password</p>
          </div>
          <hr>
          <div class="field">
            <label class="label">New password</label>
            <div class="control">
              <input type="password" autocomplete="new-password" name="password" class="input" required>
            </div>
            <p class="help">Required. New password</p>
          </div>
          <div class="field">
            <label class="label">Confirm password</label>
            <div class="control">
              <input type="password" autocomplete="new-password" name="password_confirmation" class="input" required>
            </div>
            <p class="help">Required. New password one more time</p>
          </div>
          <hr>
          <div class="field">
            <div class="control">
              <button type="submit" class="button green">
                Submit
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>-->
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
    AOS.init();
  </script>

  </div>

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