<template>
  <div>
    <div class="py-6">
      <nav class="navbar navbar-expand-lg navbar-dark ">
        <div class="container-fluid">
          <router-link :to="{ name: 'addMenu' }" class="btn btn-info">
            New Menu
          </router-link>
        </div>
      </nav>
      <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
        <div v-for="menu in menus" :key="menu.id" class="col">
          <div class="card shadow" style="width: 20rem; height: 35rem;">
            <img :src="menu.images" class="card-img-top" alt="Menu Image" width="500" height="250" />
            <div class="card-body">
              <h5 class="card-title">{{ menu.name }}</h5>
              <p class="card-text">Description: {{ menu.description }}</p>
              <p class="card-text">
                Category: {{ getCategoryName(menu) }}
              </p>
              <p class="card-text">Price: {{ menu.price }}</p>
              <p class="card-text">
                Availability: {{ menu.availability ? 'Available' : 'Not Available' }}
              </p>
              <div class="d-flex justify-content-between">
                <button class="btn btn-danger" @click="deleteMenu(menu.id)">
                  Supprimer
                </button>
                <router-link :to="{ name: 'Editmenu', params: { id: menu.id } }" class="btn btn-primary">
                  Modifier
                </router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const menus = ref([]);
const categories = ref([]);

const getMenus = async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/menus');
    menus.value = response.data;
    fetchCategories(); // Fetch categories after menus
  } catch (error) {
    console.error(error);
  }
};

const deleteMenu = async (id) => {
  try {
    await axios.delete(`http://localhost:8000/api/menus/${id}`);
    getMenus();
  } catch (error) {
    console.error(error);
  }
};

const fetchCategories = async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/categories');
    categories.value = response.data;
  } catch (error) {
    console.error(error);
  }
};

const getCategoryName = (menu) => {
  const categoryId = menu.categorie_id;
  const category = categories.value.find(cat => cat.id === categoryId);
  return category ? category.nomcategorie : 'N/A';
};

onMounted(() => {
  getMenus();
});
</script>

<style scoped>
.card {
  transition: transform 0.3s;
}

.card:hover {
  transform: scale(1.05);
}
</style>