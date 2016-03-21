import Vue from 'vue'
import App from './App'
import VueResource from 'vue-resource'
import VueRouter from 'vue-router'

Vue.use(VueResource)
Vue.use(VueRouter)
Vue.http.options.emulateJSON = true;

var router = new VueRouter()

import browseMode from './components/browse-mode.vue'
import blogList from './components/blog-list.vue'
import blogArticle from './components/blog-article.vue'
import writePanel from './components/write-panel.vue'

router.map({
    '/': {
      component: browseMode,
      subRoutes: {
        '/': {
          component: blogList
        },
        '/details/:artId': {
          component: blogArticle
        }
      }
    },
    '/edit/:mode': {
      component: writePanel
    },
    '/search/tag/:tag': {
      component: browseMode,
      subRoutes: {
        '/': {
          component: blogList
        }
      }
    },
    '/search/time/:time': {
      component: browseMode,
      subRoutes: {
        '/': {
          component: blogList
        }
      }
    },
    '/search/title/:title': {
      component: browseMode,
      subRoutes: {
        '/': {
          component: blogList
        }
      }
    },
})
router.start(App, 'app')

