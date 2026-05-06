<template>
  <nav class="navbar-vertical light navbar">
    <div class="nav-scroller">
      <!-- Brand logo -->
      <div class="navbar-brand">
        <img src="../assets/images/garuda_circle.png" alt="" /> GarudaCBT
      </div>
      <hr>
      <!-- Navbar nav -->
      <ul class="navbar-nav light flex-column" id="sideNavbar">
        <li class="nav-item">
          <router-link :to="{ name: 'dashboard'}" class="nav-link has-arrow" :class="$route.name === 'dashboard' ? 'active' : ''">
            <vue-feather type="home" class="nav-icon icon-xs me-2"></vue-feather>  Dashboard
          </router-link>
        </li>
        <!-- Master -->
        <li class="nav-item">
          <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navMaster" aria-expanded="false" aria-controls="navMaster">
            <vue-feather type="layers"
              class="nav-icon icon-xs me-2">
            </vue-feather> Data Umum
          </a>

          <div id="navMaster" class="collapse ">
            <ul class="nav light flex-column">
              <li class="nav-item">
                <router-link :to="{ name: 'TahunPelajaran'}" class="nav-link" :class="$route.name === 'TahunPelajaran' ? 'active' : ''">
                  <vue-feather type="calendar" class="nav-icon icon-xs me-2"></vue-feather> Tahun Pelajaran
                </router-link>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="#" :class="$route.name === 'MataPelajaran' ? 'active' : ''">
                  Mata Pelajaran
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link has-arrow"  href="#" :class="$route.name === 'Jurusan' ? 'active' : ''">
                  Jurusan
                </a>
              </li>
              <li class="nav-item">
                <router-link :to="{ name: 'Siswa'}" class="nav-link" :class="$route.name === 'Siswa' ? 'active' : ''">
                  <vue-feather type="users" class="nav-icon icon-xs me-2"></vue-feather> Siswa
                </router-link>
              </li>
              <li class="nav-item">
                <router-link :to="{ name: 'Guru'}" class="nav-link" :class="$route.name === 'Guru' ? 'active' : ''">
                  <vue-feather type="users" class="nav-icon icon-xs me-2"></vue-feather> Guru
                </router-link>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="#" :class="$route.name === 'dashboard' ? 'active' : ''">
                  Kelas
                </a>
              </li>
            </ul>
          </div>
        </li>

        <!-- Nav item -->
        <li class="nav-item">
          <div class="navbar-heading">Layouts & Pages</div>
        </li>
        <!-- Nav item -->
        <li class="nav-item">
          <a class="nav-link has-arrow  collapsed" href="#!" data-bs-toggle="collapse" data-bs-target="#navPages" aria-expanded="false" aria-controls="navPages">
            <vue-feather
              type="layers"
              class="nav-icon icon-xs me-2">
            </vue-feather> Pages
          </a>
          <div id="navPages" class="collapse ">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link " href="#" :class="$route.name === 'Profile' ? 'active' : ''">
                  Profile
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link has-arrow"  href="#" :class="$route.name === 'Setting' ? 'active' : ''">
                  Settings
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" :class="$route.name === 'Billing' ? 'active' : ''">
                  Billing
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" :class="$route.name === 'Procong' ? 'active' : ''">
                  Pricing
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" :class="$route.name === '404' ? 'active' : ''">
                  404 Error
                </a>
              </li>
            </ul>
          </div>
        </li>
        <!-- Nav item -->
        <li class="nav-item">
          <router-link :to="{name: 'Icons'}" class="nav-link" :class="$route.name === 'Icons' ? 'active' : ''">
            <vue-feather type="image" class="nav-icon icon-xs me-2"></vue-feather> Icons
          </router-link>
        </li>
        <li class="nav-item">
          <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navAuthentication" aria-expanded="false" aria-controls="navAuthentication">
            <vue-feather type="lock" class="nav-icon icon-xs me-2">
            </vue-feather> Authentication
          </a>
          <div id="navAuthentication" class="collapse " data-bs-parent="#sideNavbar">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="#" :class="$route.name === 'Login' ? 'active' : ''"> Sign In</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" :class="$route.name === 'Register' ? 'active' : ''"> Sign Up</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" :class="$route.name === 'ForgetPassword' ? 'active' : ''">
                  Forget Password
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" :class="$route.name === 'Layouts' ? 'active' : ''">
            <vue-feather type="sidebar" class="nav-icon icon-xs me-2"></vue-feather>Layouts
          </a>
        </li>
        <!-- Nav item -->
        <li class="nav-item">
          <div class="navbar-heading">UI Components</div>
        </li>
        <!-- Nav item -->
        <li class="nav-item">
          <a class="nav-link has-arrow" href="#" :class="$route.name === 'Components' ? 'active' : ''">
            <vue-feather type="package" class="nav-icon icon-xs me-2" >
            </vue-feather>  Components
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navMenuLevel" aria-expanded="false" aria-controls="navMenuLevel">
            <vue-feather type="corner-left-down"
              class="nav-icon icon-xs me-2">
            </vue-feather> Menu Level
          </a>
          <div id="navMenuLevel" class="collapse " data-bs-parent="#sideNavbar">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link has-arrow " href="#!" data-bs-toggle="collapse" data-bs-target="#navMenuLevelSecond" aria-expanded="false" aria-controls="navMenuLevelSecond">
                  Two Level
                </a>
                <div id="navMenuLevelSecond" class="collapse" data-bs-parent="#navMenuLevel">
                  <ul class="nav flex-column">
                    <li class="nav-item">
                      <a class="nav-link " href="#!">  NavItem 1</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link " href="#!">  NavItem 2</a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link has-arrow  collapsed  " href="#!" data-bs-toggle="collapse" data-bs-target="#navMenuLevelThree" aria-expanded="false" aria-controls="navMenuLevelThree">
                  Three Level
                </a>
                <div id="navMenuLevelThree" class="collapse " data-bs-parent="#navMenuLevel">
                  <ul class="nav flex-column">
                    <li class="nav-item">
                      <a class="nav-link  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navMenuLevelThreeOne" aria-expanded="false" aria-controls="navMenuLevelThreeOne">
                        NavItem 1
                      </a>
                      <div id="navMenuLevelThreeOne" class="collapse collapse " data-bs-parent="#navMenuLevelThree">
                        <ul class="nav flex-column">
                          <li class="nav-item">
                            <a class="nav-link " href="#!">
                              NavChild Item 1
                            </a>
                          </li>
                        </ul>
                      </div>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link " href="#!">  Nav Item 2</a>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </li>
        <!-- Nav item -->
        <li class="nav-item">
          <div class="navbar-heading">Documentation</div>
        </li>
        <!-- Nav item -->
        <li class="nav-item">
          <a class="nav-link has-arrow " href="../docs/index.html" >
            <vue-feather type="clipboard" class="nav-icon icon-xs me-2" >
            </vue-feather>  Docs
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link has-arrow " href="../docs/changelog.html" >
            <vue-feather type="git-pull-request" class="nav-icon icon-xs me-2" >
            </vue-feather>  Changelog
          </a>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
  export default {
    mounted() {
      if ($(".nav-scroller").length) {
        $(".nav-scroller").slimScroll({
          height: "97%",
        });
      }
      // Notification dropdown scroll List
      if ($('.notification-list-scroll').length) {
        $(".notification-list-scroll").slimScroll({
          height: 300,
        });
      }
    },
    name: "SidebarView"
  }
</script>

<style scoped>

</style>
