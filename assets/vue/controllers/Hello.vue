<template>
  <h1>Bienvenue {{ name }} dans Symfony + Vue.js 🚀</h1>
</template>

<script setup>
defineProps({
  name: String
});
</script>