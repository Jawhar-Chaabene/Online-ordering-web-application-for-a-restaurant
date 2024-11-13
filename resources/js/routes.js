import viewCategory from './components/categories/viewCategory.vue';
import addCategorie from "./components/categories/addCategory.vue";
import editCategory from './components/categories/editCategory.vue';
import viewMenu from './components/Menus/viewMenu.vue';
import addMenu from './components/Menus/addMenu.vue';
import ViewOrder from "./components/Orders/viewOrder.vue";
import ViewUtilisateur from './components/Utilisateurs/viewUtilisateur.vue';
import EditUtilisateur from './components/Utilisateurs/editUtilisateur.vue';
import Login from './components/authentification/Login.vue';
import Register from './components/authentification/Register.vue';
import HomeCart from './components/Cart/HomeCart.vue';
import Cart from './components/Cart/Cart.vue';
import Payment from './components/cart/Payment.vue';
import editMenu from './components/Menus/editMenu.vue';

export const routes = [

  {
    name: "viewCategory",
    path: '/listcat',
    component: viewCategory,
  },
  {
    name: "addCategory",
    path: "/addcat",
    component: addCategorie,
  },
  {
    path: '/shopping',
    name: 'HomeCart',
    component: HomeCart,
  },
  {
    path: '/carti',
    name: 'Cart',
    component: Cart,
  },
  {
    path: '/nika',
    name: 'Payment',
    component: Payment,

  },
  {
    name: 'editCategory',
    path: '/editCategory/:id',
    component: editCategory,
  },
  {
    name: 'viewMenu',
    path: '/Menu',
    component: viewMenu,
  },
  {
    name: 'addMenu',
    path: '/addMenu',
    component: addMenu,
  },
  {
    name: 'Editmenu',
    path: '/editmenu/:id',
    component: editMenu,
  },
  {
    name: 'ViewOrder',
    path: '/Order',
    component: ViewOrder,
  },
  {
    name: 'ViewUtilisateur',
    path: '/utili',
    component: ViewUtilisateur,
  },
  {
    name: "login",
    path: "/",
    component: Login,

  },
  {
    name: "register",
    path: "/register",
    component: Register,

  },

  {
    name: 'EditUtilisateur',
    path: '/editutili',
    component: EditUtilisateur,
  }

];
