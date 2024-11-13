<template>
  <div>

    <nav class="navbar navbar-expand-lg navbar-dark  ">
      <div class="container-fluid">
        <router-link :to="{ name: 'addCategory' }" class="btn btn-info">
          New Category
        </router-link>
      </div>
    </nav>


    <div class="py-6">
      <table class="table table-striped shadow">
        <thead>
          <tr>
            <td>Image</td>
            <td>Nom catégorie</td>
            <td>Modifier</td>
            <td>Supprimer</td>
          </tr>
        </thead>
        <tbody>
          <tr v-for="cat in categories" :key="cat.id">
            <td><img :src="cat.imagecategorie" width="200" height="200" /> </td>
            <td>{{ cat.nomcategorie }}</td>
            <td>
              <router-link :to="{ name: 'editCategory', params: { id: cat.id } }" class="btn btn-warning mx-2">
                Modifier
              </router-link>
            </td>
            <td>
              <button class="btn btn-danger mx-2" @click="deletecategorie(cat.id)">
                Supprimer
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();
const categories = ref([]);

const getcategories = async () => {
  try {
    const response = await axios.get("http://localhost:8000/api/categories");
    categories.value = response.data;
    console.log(categories.value);
  } catch (error) {
    console.error(error);
  }
};

const deletecategorie = async (id) => {
  try {
    await axios.delete(`http://localhost:8000/api/categories/${id}`);
    console.log(`Category with ID ${id} deleted`);
    getcategories();
  } catch (error) {
    console.error(error);
  }
};

onMounted(() => {
  getcategories();
});
</script>

<style lang="scss" scoped>
/* Your scoped styles go here */
</style>
