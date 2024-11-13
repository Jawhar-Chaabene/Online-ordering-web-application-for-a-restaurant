<template>
    <div>
      <div class="py-6">
        <table class="table table-striped shadow">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Actions</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in users" :key="user.id">
              <td>{{ user.id }}</td>
              <td>{{ user.name }}</td>
              <td>{{ user.email }}</td>
              <td>{{ user.role }}</td>
              <td>{{ user.actions }}</td>
              <td>
                <button class="btn btn-warning mx-2">Edit</button>
              </td>
              <td>
                <button class="btn btn-danger mx-2" @click="deleteUser(user.id)">Delete</button>
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
  
  const users = ref([]);
  
  const fetchUsers = async () => {
    try {
      const response = await axios.get("http://localhost:8000/api/utilisateurs");
      users.value = response.data;
    } catch (error) {
      console.error(error);
    }
  };
  
  const deleteUser = async (id) => {
    try {
      await axios.delete(`http://localhost:8000/api/utilisateurs/${id}`);
      fetchUsers();
    } catch (error) {
      console.error(error);
    }
  };
  
  onMounted(() => {
    fetchUsers();
  });
  </script>
  
  <style lang="scss" scoped>
    /* Your scoped styles go here */
  </style>
  