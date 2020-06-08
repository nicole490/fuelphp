import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import TodoList from './components/pages/TodoList.vue'
import TodoDetail from './components/pages/TodoDetail.vue'
import TodoRegister from './components/pages/TodoRegister.vue'
import SystemError from './components/pages/SystemError.vue'
import NotFound from './components/pages/NotFound.vue'
import FormInput from './components/pages/FormInput.vue'

// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter)

// パスとコンポーネントのマッピング
const routes = [
  {
    path: '/',
    component: TodoList
  },
  {
    path: '/todos/:id(\\d+)',
    component: TodoDetail,
    props: true
  },
  {
    path: '/register',
    component: TodoRegister
  },
  {
    path: '/form',
    component: FormInput
  },
  {
    path: '/500',
    component: SystemError
  },
  {
    path: '*',
    component: NotFound
  }
]

// VueRouterインスタンスを作成する
const router = new VueRouter({
  mode: 'history',
  routes
})

// VueRouterインスタンスをエクスポートする
// app.jsでインポートするため
export default router