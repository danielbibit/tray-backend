import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import { isSignedIn } from '../auth'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      beforeEnter: (_, __, next) => {
        if(isSignedIn()) {
          next();
          return;
        }
        next('/login')
      }
    },
    {
      path: '/sellers',
      name: 'sellers',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/SellersView.vue'),
      beforeEnter: (_, __, next) => {
        if(isSignedIn()) {
          next();
          return;
        }
        next('/login')
      }
    },
    {
      path: '/login',
      component: () => import('../components/LoginForm.vue')
    }
  ]
})

export default router
