<template>
    <div>
      <div class="py-6">
        <table class="table table-striped shadow">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Menu</th>
              <th>Payment Reference</th>
              <th>Amount</th>
              <th>Delivery Date</th>
              <th>Actions</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="order in orders" :key="order.id">
              <td>{{ order.id }}</td>
              <td>{{ order.menu.name }}</td>
              <td>{{ order.payref }}</td>
              <td>{{ order.amount }}</td>
              <td>{{ order.delivery_date }}</td>
              <td>{{ order.actions }}</td>
              <td>
                <button class="btn btn-warning mx-2">Edit</button>
              </td>
              <td>
                <button class="btn btn-danger mx-2" @click="deleteOrder(order.id)">Delete</button>
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
  
  const orders = ref([]);
  
  const fetchOrders = async () => {
    try {
      const response = await axios.get("http://localhost:8000/api/orders");
      orders.value = response.data;
    } catch (error) {
      console.error(error);
    }
  };
  
  const deleteOrder = async (id) => {
    try {
      await axios.delete(`http://localhost:8000/api/orders/${id}`);
      fetchOrders();
    } catch (error) {
      console.error(error);
    }
  };
  
  onMounted(() => {
    fetchOrders();
  });
  </script>
  
  <style lang="scss" scoped>
    /* Your scoped styles go here */
  </style>
  