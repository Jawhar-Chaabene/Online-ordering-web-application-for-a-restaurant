<template>
  <div>
    <h1>Add Menu</h1>
    <form @submit.prevent="addMenu">
      <div class="mb-3">
        <label for="name" class="form-label">Menu Name</label>
        <input type="text" class="form-control" v-model="menu.name" required>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control" v-model="menu.description" required>
      </div>

      <div class="mb-3">
        <label for="images" class="form-label">Menu Image URL</label>
        <input type="text" class="form-control" v-model="menu.images" required>
      </div>

      <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select class="form-control" v-model="menu.categorie_id" required>
          <option v-for="category in categories" :key="category.id" :value="category.id">
            {{ category.nomcategorie }}
          </option>
        </select>
      </div>

      <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control" v-model="menu.price" required>
      </div>

      <div class="mb-3">
        <label for="availability" class="form-label">Availability</label>
        <select class="form-select" v-model="menu.availability" required>
          <option value="1">Available</option>
          <option value="0">Not Available</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Add Menu</button>
      <p v-if="errorMessage" class="text-danger mt-3">{{ errorMessage }}</p>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../config/api.js';
import { useRouter } from 'vue-router';

const router = useRouter();

const menu = ref({
  name: '',
  description: '',
  images: '',
  categorie_id: '',
  price: '',
  availability: 1,
});

const categories = ref([]);
const errorMessage = ref('');

const fetchCategories = async () => {
  try {
    const response = await api.get('/api/categories'); // Use a relative URL
    categories.value = response.data;
  } catch (error) {
    console.error('Error fetching categories:', error.message);
    errorMessage.value = 'Failed to fetch categories. Please try again.';
  }
};

const addMenu = async () => {
  try {
    await api.post('/api/menus/', menu.value);
    router.push({ name: 'viewMenu' });
  } catch (error) {
    console.error('Error adding menu:', error.message);
    errorMessage.value = 'Failed to add the menu. Please try again.';
  }
};

onMounted(() => {
  fetchCategories();
});
</script>
