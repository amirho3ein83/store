<template>
    <div class="rating">
      <h3>Please rate:</h3>
      <div class="stars">
        <span
          v-for="index in 5"
          :key="index"
          @click="rate(index)"
          :class="{ 'star-filled': index <= selectedRating, 'star-unfilled': index > selectedRating }"
        >
          ★
        </span>
      </div>
      <button @click="submitRating">Submit</button>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  const selectedRating = ref(0);
  
  const rate = (index) => {
    selectedRating.value = index;
  };
  
  const submitRating = () => {
    // You can perform the submission logic here
    alert(selectedRating.value)
    console.log(`Rating submitted: ${selectedRating.value}`);
  };
  </script>
  
  <style scoped>
  .rating {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 20px;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
  }
  
  .stars {
    margin: 20px 0;
    font-size: 24px;
  }
  
  .star-filled {
    color: gold;
    cursor: pointer;
  }
  
  .star-unfilled {
    color: #ccc;
    cursor: pointer;
  }
  
  button {
    padding: 10px 20px;
    background-color: #4caf50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
  }
  
  button:hover {
    background-color: #45a049;
  }
  </style>
  