<template>
    <div>
      <form @submit.prevent="editUser">
        <label for="name">Name:</label>
        <input v-model="editedUser.name" type="text" id="name" required />
  
        <label for="email">Email:</label>
        <input v-model="editedUser.email" type="email" id="email" required />
  
        <label for="role">Role:</label>
        <select v-model="editedUser.role" id="role" required>
          <option value="admin">Admin</option>
          <option value="customer">Customer</option>
        </select>
  
        <button type="submit">Save Changes</button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import { useRouter } from 'vue-router';
  
  const editedUser = ref({
    id: null,
    name: '',
    email: '',
    role: 'customer', // Set a default role or fetch it from the API
  });
  
  const router = useRouter();
  
  const fetchUser = async () => {
    const userId = router.currentRoute.value.params.id;
    try {
      const response = await axios.get(`http://localhost:8000/api/utilisateurs/${userId}`);
      editedUser.value = response.data;
    } catch (error) {
      console.error(error);
    }
  };
  
  const editUser = async () => {
    try {
      await axios.put(`http://localhost:8000/api/utilisateurs/${editedUser.value.id}`, editedUser.value);
      router.push({ name: 'ViewUsers' }); // Redirect to the users list after editing
    } catch (error) {
      console.error(error);
    }
  };
  
  onMounted(() => {
    fetchUser();
  });
  </script>
  
  <style lang="scss" scoped>
    /* Your scoped styles go here */
  </style>
  