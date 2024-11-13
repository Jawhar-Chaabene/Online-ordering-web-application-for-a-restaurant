<template>
    <div class="d-flex justify-content-center align-items-center min-vh-100">
      <form @submit.prevent="handleSubmit">
        <div class="card" style="width: 50rem;">
          <div class="card-body">
            <h5 class="card-title">Montant à payer : {{ amount }} TND</h5>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Enter your email" v-model="email" required />
            </div>
            <div id="card-element" class="mb-3"></div>
            <button type="submit" class="btn btn-success">Procéder au paiement</button>
          </div>
        </div>
      </form>
    </div>
  </template>
  
  <script setup>
  import { onMounted, ref } from 'vue';
  import { loadStripe } from '@stripe/stripe-js';
  import store from '../../store';
  import api from '../config/api.js';
  import { useRouter } from 'vue-router';
  
  const router = useRouter();
  const stripePromise = loadStripe('pk_test_51OMsgQDC9NKCZWAQMZl0a7Oo83rt7az6o0Uu5u7b1rQZDJ6feE1qT8WIWPuuCDNOYHqsyKTYxRXOJpZNWwEOK5jk00dZE7me6N');
  const stripe = ref(null);
  let cardElement;
  let amount = ref(0);
  let email = ref('');
  
  onMounted(async () => {
    amount.value = store.state.Articlestore.cartTotal;
    stripe.value = await stripePromise;
    const elements = stripe.value.elements();
    cardElement = elements.create('card');
    cardElement.mount('#card-element');
  });
  
  const handleSubmit = async () => {
    const { token, error } = await stripe.value.createToken(cardElement);
  
    if (error) {
      console.error(error);
    } else {
      const response = await api.post('/api/createpayment', {
        token: token.id,
        amount: amount.value * 100,
      });
  
      if (response.data.message) {
        alert(response.data.message);
        store.commit('Articlestore/clearCart');
        router.push('/shopping');
      } else {
        console.error(response.data.error);
      }
    }
  };
  </script>
  