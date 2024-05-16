<!DOCTYPE html>
<html lang="en" class="form-screen">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>Sign Up - Admin Dashboard</title>

  <!-- Icon -->
  <link rel="shortcut icon" href="../../../assets/img/logo-pmm-2.png" type="image/x-icon">

  <!-- Tailwind is included -->
  <link rel="stylesheet" href="../css/main.css?v=1652870200386">
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Swalert 2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    <section class="section main-section">
      <div class="card">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-lock"></i></span>
            Sign Up
          </p>
        </header>

        <div class="card-content">
          <form action="Register.php" method="post">
            <div class="field spaced">
              <label class="label">Full Name</label>
              <div class="control icons-left">
                <input class="input" id="fullname" name="fullname" type="text" placeholder="Full name"
                  autocomplete="username" required>
                <span class="icon is-small left"><i class="mdi mdi-account"></i></span>
              </div>
              <p class="help">
                Please enter your full name
              </p>
            </div>

            <div class="field spaced">
              <label class="label">Username</label>
              <div class="control icons-left">
                <input class="input" d="username" name="username" type="text" placeholder="Username"
                  autocomplete="username" required>
                <span class="icon is-small left"><i class="mdi mdi-account"></i></span>
              </div>
              <p class="help">
                Please enter your username
              </p>
            </div>

            <div class="field spaced">
              <label class="label">Password</label>
              <p class="control icons-left">
                <input class="input" id="password" name="password" type="password" placeholder="Password"
                  autocomplete="current-password" required>
                <span class="icon is-small left"><i class="mdi mdi-asterisk"></i></span>
                <button type="button" onclick="togglePasswordVisibility()"
                  class="absolute top-0 end-0 p-3.5 rounded-e-md dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                  <svg class="flex-shrink-0 w-3.5 h-3.5 text-gray-400 dark:text-neutral-600" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
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
              </p>
              <p class="help">
                Please enter your password
              </p>
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

            <!--<div class="field spaced">
              <div class="control">
                <label class="checkbox"><input type="checkbox" name="remember" value="1" checked>
                  <span class="check"></span>
                  <span class="control-label">Remember</span>
                </label>
              </div>
            </div>-->

            <div class="mt-4">
              <span class="text-sm text-gray-600">Already have an account? <a href="form_login.php"
                  class="text-blue-600 hover:text-blue-700">Log In</a></span>
            </div>

            <hr>

            <div class="field grouped">
              <div class="control">
                <button type="submit" class="button blue">
                  Sign Up
                </button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </section>
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

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const form = document.querySelector('form');

      form.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(form);

        fetch('register.php', {
          method: 'POST',
          body: formData
        })
          .then(response => response.json())
          .then(data => {
            if (data.status === 'success') {
              Swal.fire({
                icon: 'success',
                title: 'Register Successful',
                text: data.message,
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 2000
              }).then(function () {
                window.location.href = '../index.php';
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Register Failed',
                text: data.message,
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 2000
              }).then(function () {
                window.location.href = 'form_register.php';
              });
            }
          })
          .catch(error => console.error('Error:', error));
      });
    });
  </script>

  <!-- Scripts below are for demo only -->
  <script type="text/javascript" src="../js/main.min.js?v=1652870200386"></script>

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