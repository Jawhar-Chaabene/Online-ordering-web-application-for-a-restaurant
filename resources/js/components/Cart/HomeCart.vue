<template>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar flex-column">
        <div class="position-sticky">
          <div class="list-group list-group-flush mx-3 mt-4">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="list-group-item list-group-item-action py-2 ripple" @click="filterMenu('all')">All</a>
              </li>
              <li class="nav-item" v-for="category in categories" :key="category.id">
                <a class="list-group-item list-group-item-action py-2 ripple" @click="filterMenu(category.nomcategorie)">
                  {{ category.nomcategorie }}
                </a>
              </li>
            </ul>

          </div>
        </div>
      </nav>
      <!-- Sidebar
      <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
        <div class="position-sticky">

          <ul class="nav flex-column">
            <li class="nav-item">
              <button class="nav-link" @click="filterMenu('all')">All</button>
            </li>
            <li class="nav-item" v-for="category in categories" :key="category.id">
              <button class="nav-link" @click="filterMenu(category.nomcategorie)">
                {{ category.nomcategorie }}
              </button>
            </li>
          </ul>
        </div>
      </nav> -->

      <!-- Content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
          class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Menu</h1>
        </div>

        <div class="row">
          <div class="col-md-12" style="display:flex;flex-wrap:wrap;justify-content:center">
            <div class="card" style="width: 18rem; margin:6px" v-for="prod in filteredMenus" :key="prod.id">
              <img :src="prod.images" :alt="prod.name" width="200" height="200">
              <div class="card-body">
                <h5 class="card-title" v-if="prod.name">{{ prod.name.substr(0, 20) }}</h5>
                <div style="text-align:center">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">Description: {{ prod.description }} </li>
                  </ul>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">Category: {{ getCategoryName(prod) }} </li>
                  </ul>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">Price: {{ prod.price }} TND</li>
                  </ul>
                  <button class="btn btn-outline-primary" @click="addToCart(prod)" v-if="prod.availability == 1">
                    Add to Cart
                  </button>
                  <button class="btn btn-danger" v-if="prod.availability == 0">OUT OF STOCK</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import axios from "../config/api";
import store from '../../store'

import { ref, onMounted } from 'vue';

const menus = ref([]);
const isLoading = ref(true);
const selectedCategory = ref('');

onMounted(() => {
  getArticles();
});

const getArticles = (page = 1) => {
  axios.get('/api/menus/')
    .then(response => {
      menus.value = response.data;
      fetchCategories();
      filterMenu('all');
      isLoading.value = false;
    })
    .catch(error => {
      console.error(error);
      isLoading.value = false;
    });
}

const addToCart = (prod) => {
  store.commit("Articlestore/addCart", { product: prod, qty: 1 });
}

const categories = ref([]);
const fetchCategories = async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/categories');
    categories.value = response.data;
  } catch (error) {
    console.error(error);
  }
};

const getCategoryName = (prod) => {
  const categoryId = prod.categorie_id;
  const category = categories.value.find(cat => cat.id === categoryId);
  return category ? category.nomcategorie : 'N/A';
};

const filteredMenus = ref([]);

const filterMenu = (category = "all") => {
  selectedCategory.value = category;
  if (category === 'all') {
    filteredMenus.value = menus.value;
  } else {
    filteredMenus.value = menus.value.filter(menu => getCategoryName(menu) === category);
  }
};

</script>

<style scoped>
#sidebar {
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 230px;
  padding-top: 20px;
  z-index: 1;
}

#sidebar .nav-link {
  padding: 10px;
  text-align: left;
}

.main {
  margin-left: 230px;
}
</style>
