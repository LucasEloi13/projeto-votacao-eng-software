<template>
  <div>
    <h1>FastAPI + Vue + MySQL</h1>
    <p>{{ message }}</p>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      message: 'Loading...'
    }
  },
  mounted() {
    axios.get('http://localhost:8000/api/hello')
      .then(response => {
        this.message = response.data.message
      })
      .catch(() => {
        this.message = 'Error fetching data'
      })
  }
}
</script>
