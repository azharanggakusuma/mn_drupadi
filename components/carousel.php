<div class="relative font-inter antialiased">
  <main class="relative flex flex-col justify-center bg-white overflow-hidden">
    <div class="w-full max-w-5xl mx-auto px-4 md:px-6 py-12">
      <div class="text-center">
        <!--<h1 class="text-2xl font-bold md:text-2xl md:leading-tight dark:text-white mb-8">Our Team PMM 4</h1>-->
        <!-- Logo Carousel animation -->
        <div x-data="{}" x-init="$nextTick(() => {
                    let ul = $refs.logos;
                    ul.insertAdjacentHTML('afterend', ul.outerHTML);
                    ul.nextSibling.setAttribute('aria-hidden', 'true');
                })"
          class="w-full inline-flex flex-nowrap overflow-hidden [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(100%-128px),transparent_100%)]">
          <ul x-ref="logos"
            class="flex items-center justify-center md:justify-start [&_li]:mx-4 [&_img]:max-w-none animate-infinite-scroll">
            <?php
            include "campuses.php";
            foreach ($campuses as $campus) {
              echo '<li>';
              echo '<img src="assets/img/logo_kampus/' . $campus['logo'] . '" alt="" width="' . $campus['width'] . '" />';
              echo '</li>';
            }
            ?>
          </ul>
        </div>
        <!-- End: Logo Carousel animation -->
      </div>
    </div>
  </main>
</div>