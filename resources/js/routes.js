import Vue from 'vue'
//Import View Router
import VueRouter from 'vue-router'

import Index from './components/Index.vue'
import Login from './components/Login.vue'
import Home from './components/Home.vue'
import CategoriesSearch from './components/CategoriesSearch'
import ItemsSearch from './components/ItemsSearch'

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
      },
      {
        path:'/item/:categoryid/search',
        name:'items.search',
        component:ItemsSearch
      }
    ]
})

export default router
