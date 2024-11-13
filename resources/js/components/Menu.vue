<template>
  <nav v-if="showMenu" class="navbar navbar-expand-lg navbar-dark bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
      <router-link class="navbar-brand" to="/">Restau</router-link>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
        aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <router-link class="nav-link" to="/listcat">Catégories</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/Menu">Menu</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/shopping">Shopping Cart</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/Order">Order</router-link>
          </li>
          <li class="nav-item">
            <button @click="logout" class="btn btn-danger">Logout</button>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search">
          <button class="btn btn-secondary" type="submit">Search</button>
        </form>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item me-3">
            <router-link class="nav-link position-relative" :class="$route.name == 'Carti' ? 'active' : ''"
              :to="{ name: 'Cart' }">
              <i class="fa-solid fa-cart-shopping fa-lg" style="color: #ffffff;"></i>
              <span v-if="$store.state.Articlestore.cart.length > 0"
                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $store.state.Articlestore.cart.length }}
              </span>
            </router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script setup>
import axios from 'axios';
import { useRouter } from 'vue-router';
import { ref, onBeforeMount } from 'vue';
import { useRoute } from 'vue-router';

const showMenu = ref(false);
const route = useRoute();
const router = useRouter();

onBeforeMount(() => {
  // Check if the current route is the login page
  showMenu.value = route.name !== 'login';
});

const logout = async () => {
  const token = localStorage.getItem('token');
  try {
    await axios.post('http://localhost:8000/api/logout', null, {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    });
    localStorage.removeItem('token');
    localStorage.removeItem('user');
    router.push("/");
  } catch (error) {
    console.error(error);
    alert(error);
  }
};
</script>

<style scoped>
/* Add your component-specific styles here */
</style>
