import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import { isSignedIn, signOut} from '../auth'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      beforeEnter: (_, __, next) => {
        if (isSignedIn()) {
          next()
          return
        }
        next('/login')
      }
    },
    {
      path: '/sellers',
      name: 'sellers',
      component: () => import('../views/SellersView.vue'),
      beforeEnter: (_, __, next) => {
        if (isSignedIn()) {
          next()
          return
        }
        next('/login')
      }
    },
    {
      path: '/createSeller',
      name: 'createSeller',
      component: () => import('../views/SellerEditorView.vue'),
      beforeEnter: (_, __, next) => {
        if (isSignedIn()) {
          next()
          return
        }
        next('/login')
      }
    },
    {
      path: '/sales',
      name: 'sales',
      component: () => import('../views/SalesView.vue'),
      beforeEnter: (_, __, next) => {
        if (isSignedIn()) {
          next()
          return
        }
        next('/login')
      }
    },
    {
      path: '/createSale',
      name: 'createSale',
      component: () => import('../views/SalesEditorView.vue'),
      beforeEnter: (_, __, next) => {
        if (isSignedIn()) {
          next()
          return
        }
        next('/login')
      }
    },
    {
      path: '/login',
      component: () => import('../components/LoginForm.vue')
    },
    {
      path: '/logout',
      component: () => import('../components/LoginForm.vue'),
      beforeEnter: (_, __, next) => {
        signOut()
        next('/')
      }
    }
  ]
})

export default router
