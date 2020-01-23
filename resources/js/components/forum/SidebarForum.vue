<template>

  <v-card
    class="mx-auto"
    max-width="400"
    tile
  >

    <v-toolbar dense>

      <v-toolbar-title>Category</v-toolbar-title>

    </v-toolbar>

    <v-list-item v-for="category in categories" :key="category.id">
      <v-list-item-content>
        <v-list-item-title>{{category.name}}</v-list-item-title>
      </v-list-item-content>
    </v-list-item>

  </v-card>
</template>



<script>
  export default {
      data(){
          return{
               categories:{}
          }
      },
      created(){
          axios.get('api/category')
          .then((result) => {
              this.categories = result.data.data
          }).catch((err) => {
              console.log(err)
          });
      }

  }
</script>

<style lang="scss" scoped>

</style>
