<!DOCTYPE html>
<html lang="en" class="form-screen">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>Login - Admin Dashboard</title>

  <!-- Icon -->
  <link rel="shortcut icon" href="../../../assets/img/logo-pmm-2.png" type="image/x-icon">

  <!-- Tailwind is included -->
  <link rel="stylesheet" href="../css/main.css?v=1652870200386">

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
            Login
          </p>
        </header>

        <div class="card-content">
          <form action="login.php" method="post">
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
              </p>
              <p class="help">
                Please enter your password
              </p>
            </div>

            <!--<div class="field spaced">
              <div class="control">
                <label class="checkbox"><input type="checkbox" name="remember" value="1" checked>
                  <span class="check"></span>
                  <span class="control-label">Remember</span>
                </label>
              </div>
            </div>-->

            <hr>

            <div class="field grouped">
              <div class="control">
                <button type="submit" class="button blue">
                  Login
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
      <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"
        stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"
        class="animate-spin w-8 h-8 stroke-slate-500">
        <path
          d="M12 3v3m6.366-.366-2.12 2.12M21 12h-3m.366 6.366-2.12-2.12M12 21v-3m-6.366.366 2.12-2.12M3 12h3m-.366-6.366 2.12 2.12">
        </path>
      </svg>
    </div>
    <span class="text-lg font-medium text-slate-500">Loading...</span>
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

        fetch('login.php', {
          method: 'POST',
          body: formData
        })
          .then(response => response.json())
          .then(data => {
            if (data.status === 'success') {
              Swal.fire({
                icon: 'success',
                title: 'Login Successful',
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
                title: 'Login Failed',
                text: data.message,
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 2000
              }).then(function () {
                window.location.href = 'form_login.php';
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