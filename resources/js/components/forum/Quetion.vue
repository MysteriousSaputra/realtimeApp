<template>
 <div>
      <v-card
    class="mx-auto"
    max-width="90%"
  >

    <v-card-title>
        <router-link :to="data.path">
            {{data.title}}
        </router-link>
    </v-card-title>

    <v-card-subtitle>
       <div>{{data.user}} said {{data.created_at}}</div>
    </v-card-subtitle>

    <v-card-actions>
      <v-btn
        color="orange"
        text
      >
        Share
      </v-btn>

      <v-btn
        color="orange"
        text
      >
        Explore
      </v-btn>
    </v-card-actions>
  </v-card><br>
 </div>
</template>

<script>
    export default {
        props:['data']
    }
</script>

<style lang="scss" scoped>

</style>
