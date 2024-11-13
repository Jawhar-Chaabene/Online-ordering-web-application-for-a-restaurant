<template>
    <div>
        <h3 class="text-center">Edit Category</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateCategorie">
                    <div class="mb-3">
                        <label for="name" class="form-label">Menu Name</label>
                        <input type="text" class="form-control" v-model="menu.name">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" v-model="menu.description">
                    </div>
                    <div class="mb-3">
                        <label for="images" class="form-label">Menu Image URL</label>
                        <input type="text" class="form-control" v-model="menu.images">
                    </div>


                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" v-model="menu.price">
                    </div>

                    <div class="mb-3">
                        <label for="availability" class="form-label">Availability</label>
                        <select class="form-select" v-model="menu.availability">
                            <option value="1">Available</option>
                            <option value="0">Not Available</option>
                        </select>
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
const menu = ref({});

const fetchmenu = async () => {
    try {
        const res = await axios.get(`http://localhost:8000/api/menus/${route.params.id}`);
        menu.value = res.data;
    } catch (error) {
        console.error(error);
    }
};

const updateCategorie = async () => {
    try {
        await axios.patch(`http://localhost:8000/api/menus/${route.params.id}`, menu.value);
        router.push({ name: 'viewMenu' });
    } catch (error) {
        console.error(error);
        // Handle the error as needed (e.g., show a notification to the user)
    }
};

onMounted(async () => {
    await fetchmenu();
});
</script>
  