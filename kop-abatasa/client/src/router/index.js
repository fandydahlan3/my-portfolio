import { createRouter, createWebHashHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import Login from '../pages/login/Login'
import PageNotFound from '../pages/PageNotFound'
import AdminPage from '../pages/admin/Admin'
import DashboardPage from '../pages/admin/Dashboard'
import GuruPage from '../pages/admin/master/Guru'
import TahunPelajaranPage from '../pages/admin/master/TahunPelajaran'
import SiswaPage from '../pages/admin/master/Siswa'
import IconsPage from '../pages/Icons/IconsPage'

const routes = [
  { path: '/', component: Login },
  {
        path: '/admin',
        name: 'Admin',
        component: AdminPage,
        meta: { requiresToken: true },
        children: [
            {
                path: '',
                name: 'dashboard',
                component: DashboardPage,
                // meta: { requiresToken: true }
            },
            {
                path: 'tahunpelajaran',
                name: 'TahunPelajaran',
                component: TahunPelajaranPage,
                meta: { requiresToken: true }
            },
            {
                path: 'siswa',
                name: 'Siswa',
                component: SiswaPage,
                meta: { requiresToken: true }
            },
            {
                path: 'guru',
                name: 'Guru',
                component: GuruPage,
                meta: { requiresToken: true }
            },
            {
                path: 'icons',
                name: 'Icons',
                component: IconsPage
            },
            /*
            {
              path: 'mal',
              name: 'mal',
              component: MalAdmin,
              meta: { requiresToken: true }
            },
            {
              path: 'infaq',
              name: 'infaq',
              component: InfaqAdmin,
              meta: { requiresToken: true }
            },
            {
              path: 'mustahik',
              name: 'mustahik',
              component: Mustahik,
              meta: { requiresToken: true }
            },
            {
              path: 'mustahik/:id',
              name: 'mustahikDetail',
              component: MustahikDetail,
              meta: { requiresToken: true }
            },
            {
              path: 'transaksi/zakat',
              name: 'transaksiZakat',
              component: TransaksiZakat,
              meta: { requiresToken: true }
            },
            {
              path: 'transaksi/infaq',
              name: 'transaksiInfaq',
              component: TransaksiInfaq,
              meta: { requiresToken: true }
            },
            {
              path: 'admins',
              name: 'admins',
              component: Admins,
              meta: { requiresToken: true }
            },
            */
        ]
    },
    { path: '/:pathMatch(.*)*', component: PageNotFound }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
