import Vue from 'vue'
//Import View Router
import VueRouter from 'vue-router'

import Index from './components/Index.vue'
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
          component:Index,
          meta: {
            auth: undefined
          }
      },
      {
          path:'/home',
          name:'Home',
          component:Home,
          meta: {
            auth: true
          }
      },
      {
        path:'/categories/search',
        name:'categories.search',
        component:CategoriesSearch,
        meta: {
          auth: undefined
        }
      },
      {
        path:'/item/:categoryid/search',
        name:'items.search',
        component:ItemsSearch,
        meta: {
          auth: undefined
        }
      }
    ]
})

export default router
