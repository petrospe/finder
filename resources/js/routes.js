import Vue from 'vue'
//Import View Router
import VueRouter from 'vue-router'

import Index from './views/Index.vue'
import Login from './views/Login.vue'
import Home from './views/Home.vue'
import CategoriesSearch from './views/CategoriesSearch'

Vue.use(VueRouter)

//Register Routes
const router = new VueRouter({
    mode: 'history',
    routes:[
      {
          path:'/',
          name:'Index',
          component:Index
      },
      {
          path:'/login',
          name:'Login',
          component:Login
      },
      {
          path:'/home',
          name:'Home',
          component:Home
      },
      {
        path:'/categories/search',
        name:'categories.search',
        component:CategoriesSearch
      }
    ]
})

export default router
