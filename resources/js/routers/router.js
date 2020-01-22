import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Login from '../components/auth/Login';
import SignUp from '../components/auth/SignUp';
import Logout from '../components/auth/Logout';
import Forum from '../components/forum/Forum';
import ReadQuetion from '../components/forum/ReadQuetion';
import CreateQuetion from '../components/forum/CreateQuetion';

const routes = [
    { path: '/login', component: Login, name:'login' },
    { path: '/logout', component: Logout, name:'logout' },
    { path: '/signup', component: SignUp, name: 'signup' },
    { path: '/forum', component: Forum, name: 'forum' },
    { path: '/ask', component: CreateQuetion, name: 'askQuetion'},
    { path: '/quetion/:slug', component: ReadQuetion},
]

const router = new VueRouter({
    routes, // short for `routes: routes`,
    mode: 'history',
    hasbang: false
})

export default router;
