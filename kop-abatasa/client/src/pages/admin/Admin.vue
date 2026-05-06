<template>
  <div id="db-wrapper">
    <sidebar-view></sidebar-view>
    <div id="page-content">
      <div class="header @@classList">
        <!-- navbar -->
        <nav class="navbar-classic navbar navbar-expand-lg">
          <a id="nav-toggle" href="">
            <vue-feather type="menu" class="nav-icon me-2 icon-xs"></vue-feather>
          </a>
          <div class="ms-lg-3 d-lg-block">
            Thn. Pelajaran
          </div>

          <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
            <li class="ms-lg-2 d-none d-md-none d-lg-block">
              <form class="d-flex align-items-center me-3">
                <input type="search" class="form-control" placeholder="Search" />
              </form>
            </li>
            <li class="dropdown stopevent">
              <a class="btn btn-light btn-icon rounded-circle indicator
          indicator-primary text-muted" href="#" role="button"
                 id="dropdownNotification" data-bs-toggle="dropdown" aria-haspopup="true"
                 aria-expanded="false">
                <vue-feather class="icon-xs" type="bell"></vue-feather>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end"
                   aria-labelledby="dropdownNotification">
                <div>
                  <div class="border-bottom px-3 pt-2 pb-3 d-flex
              justify-content-between align-items-center">
                    <p class="mb-0 text-dark fw-medium fs-4">Notifications</p>
                    <a href="#" class="text-muted">
                <span>
                  <vue-feather class="me-1 icon-xxs" type="settings"></vue-feather>
                </span>
                    </a>
                  </div>
                  <!-- List group -->
                  <ul class="list-group list-group-flush notification-list-scroll">
                    <!-- List group item -->
                    <li class="list-group-item bg-light">


                      <a href="#" class="text-muted">
                        <h5 class=" mb-1">Rishi Chopra</h5>
                        <p class="mb-0">
                          Mauris blandit erat id nunc blandit, ac eleifend dolor pretium.
                        </p>
                      </a>



                    </li>
                    <!-- List group item -->
                    <li class="list-group-item">


                      <a href="#" class="text-muted">
                        <h5 class=" mb-1">Neha Kannned</h5>
                        <p class="mb-0">
                          Proin at elit vel est condimentum elementum id in ante. Maecenas et sapien metus.
                        </p>
                      </a>



                    </li>
                    <!-- List group item -->
                    <li class="list-group-item">


                      <a href="#" class="text-muted">
                        <h5 class=" mb-1">Nirmala Chauhan</h5>
                        <p class="mb-0">
                          Morbi maximus urna lobortis elit sollicitudin sollicitudieget elit vel pretium.
                        </p>
                      </a>



                    </li>
                    <!-- List group item -->
                    <li class="list-group-item">


                      <a href="#" class="text-muted">
                        <h5 class=" mb-1">Sina Ray</h5>
                        <p class="mb-0">
                          Sed aliquam augue sit amet mauris volutpat hendrerit sed nunc eu diam.
                        </p>
                      </a>



                    </li>
                  </ul>
                  <div class="border-top px-3 py-2 text-center">
                    <a href="#" class="text-inherit fw-semi-bold">
                      View all Notifications
                    </a>
                  </div>
                </div>
              </div>
            </li>
            <!-- List -->
            <li class="dropdown ms-2">
              <a class="rounded-circle" href="#" role="button" id="dropdownUser"
                 data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-md avatar-indicators avatar-online">
                  <img alt="avatar" src="@/assets/images/avatar/avatar-1.jpg"
                       class="rounded-circle" />
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end"
                   aria-labelledby="dropdownUser">
                <div class="px-4 pb-0 pt-2">


                  <div class="lh-1 ">
                    <h5 class="mb-1"> John E. Grainger</h5>
                    <a href="#" class="text-inherit fs-6">View my profile</a>
                  </div>
                  <div class=" dropdown-divider mt-3 mb-2"></div>
                </div>

                <ul class="list-unstyled">

                  <li>
                    <a class="dropdown-item" href="#">
                      <vue-feather class="me-2 icon-xxs dropdown-item-icon" type="user"></vue-feather>Edit
                      Profile
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item"
                       href="#">
                      <vue-feather class="me-2 icon-xxs dropdown-item-icon"
                         type="activity"></vue-feather>Activity Log
                    </a>


                  </li>

                  <li>
                    <a class="dropdown-item text-primary" href="#">
                      <vue-feather class="me-2 icon-xxs text-primary dropdown-item-icon"
                         type="star"></vue-feather>Go Pro
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <vue-feather class="me-2 icon-xxs dropdown-item-icon"
                         type="settings"></vue-feather>Account Settings
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="@/index.html">
                      <vue-feather class="me-2 icon-xxs dropdown-item-icon"
                         type="power"></vue-feather>Sign Out
                    </a>
                  </li>
                </ul>

              </div>
            </li>
          </ul>
        </nav>
      </div>
      <!-- Container fluid -->
      <div v-show="$route.name==='dashboard'" class="bg-primary pt-10 pb-21"></div>
      <div class="container-fluid mt-n22">
        <router-view />
      </div>
    </div>
  </div>
</template>

<script>
    import SidebarView from "../../components/SidebarView";
    export default {
        name: "AdminPage",
      components: {SidebarView}
    }
</script>

<style scoped>

</style>
