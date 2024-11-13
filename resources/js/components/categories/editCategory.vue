<template>
    <div>
      <h3 class="text-center">Edit Category</h3>
      <div class="row">
        <div class="col-md-6">
          <form @submit.prevent="updateCategorie">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" v-model="categorie.nomcategorie">
            </div>
            <div class="form-group">
              <label>Image</label>
              <input type="text" class="form-control" v-model="categorie.imagecategorie">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import axios from 'axios';
  import { useRouter, useRoute } from 'vue-router';
  import { ref, onMounted } from 'vue';
  
  const router = useRouter();
  const route = useRoute();
  const categorie = ref({});
  
  const fetchCategorie = async () => {
    try {
      const res = await axios.get(`http://localhost:8000/api/categories/${route.params.id}`);
      categorie.value = res.data;
    } catch (error) {
      console.error(error);
    }
  };
  
  const updateCategorie = async () => {
    try {
      await axios.patch(`http://localhost:8000/api/categories/${route.params.id}`, categorie.value);
      router.push({ name: 'viewCategory' });
    } catch (error) {
      console.error(error);
      // Handle the error as needed (e.g., show a notification to the user)
    }
  };
  
  onMounted(async () => {
    await fetchCategorie();
  });
  </script>
  