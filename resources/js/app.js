import {createApp} from 'vue'
import {store} from './store'
import HomeMain from "./views/main/HomeMain";
import HomeAdmin from "./views/admin/HomeAdmin";
import Register from "./auth/Register";
import Login from "./auth/Login";
import TheHeader from "./components/TheHeader";
import TheFooter from "./components/TheFooter";
import TheSubscribe from "./components/TheSubscribe";

import TheHeaderAdmin from "./components/TheHeaderAdmin";
import TheSidebarAdmin from "./components/TheSidebarAdmin";
import CategoriesAdmin from "./views/admin/CategoriesAdmin";
import OrdersAdmin from "./views/admin/OrdersAdmin";
import OneClickOrdersAdmin from "./views/admin/OneClickOrdersAdmin";
import ProductsAdmin from "./views/admin/ProductsAdmin";
import TagsAdmin from "./views/admin/TagsAdmin";
import UsersAdmin from "./views/admin/UsersAdmin";

import AccountMain from "./views/main/AccountMain";
import CategoryMain from "./views/main/CategoryMain";
import InfoMain from "./views/main/InfoMain";
import OrderingMain from "./views/main/OrderingMain";
import ProductMain from "./views/main/ProductMain";
import SearchResultMain from "./views/main/SearchResultMain";
import TagMain from "./views/main/TagMain";

import Unicon from 'vue-unicons'
import {
  uniSearch,
  uniShoppingCart,
  uniUser,
  uniInstagramAlt,
  uniFacebookF,
  uniMapMarker,
  uniEnvelope,
  uniPhone,
  uniClock,
  uniTrashAlt,
  uniEditAlt,
  uniArrowDown,
  uniArrowUp,
  uniAngleDoubleUp,
  uniAngleDoubleDown,
  uniTimes,
  uniArrowCircleLeft,
  uniArrowCircleRight,
  uniAngleLeftB,
  uniAngleRightB,
  uniArrowLeft,
  uniArrowRight
} from 'vue-unicons/dist/icons';

Unicon.add([uniSearch, uniShoppingCart, uniUser, uniInstagramAlt, uniFacebookF, uniMapMarker, uniEnvelope, uniPhone, uniClock, uniTrashAlt, uniEditAlt, uniArrowDown, uniArrowUp, uniAngleDoubleUp, uniAngleDoubleDown, uniTimes, uniArrowCircleLeft, uniArrowCircleRight, uniAngleLeftB, uniAngleRightB, uniArrowLeft, uniArrowRight]);

const app = createApp({
  components: {
    'home-main': HomeMain,

    'register': Register,
    'login': Login,
    'the-header': TheHeader,
    'the-footer': TheFooter,
    'the-subscribe': TheSubscribe,

    'the-header-admin': TheHeaderAdmin,
    'the-sidebar-admin': TheSidebarAdmin,
    'home-admin': HomeAdmin,
    'categories-admin': CategoriesAdmin,
    'orders-admin': OrdersAdmin,
    'one-click-orders-admin': OneClickOrdersAdmin,
    'products-admin': ProductsAdmin,
    'tags-admin': TagsAdmin,
    'users-admin': UsersAdmin,

    'account-main': AccountMain,
    'category-main': CategoryMain,
    'info-main': InfoMain,
    'ordering-main': OrderingMain,
    'product-main': ProductMain,
    'search-result-main': SearchResultMain,
    'tag-main': TagMain,

  }

});

app
  .use(store)
  .use(Unicon)
  .mount('#app');

require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
